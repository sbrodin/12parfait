<?php
/**
 * Match helper file
 *
 * PHP Version 7.1
 *
 * @category Helpers
 * @package  Helpers
 * @author   Stanislas Brodin <stanislas.brodin@gmail.com>
 * @license  https://opensource.org/licenses/MIT    MIT License
 * @link     https://12parfait.fr
 */

if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
 * Cette fonction renvoie les matchs d'un jour passé en paramètre.
 *
 * @param Mixed $date Date des matchs à récupérer au format JJ/MM/AAAA
 *
 * @return Bool False si aucun match n'est trouvé, ou les matchs du jour passé
 *              en paramètre
 */
function Matches_Of_day($date = null)
{
    if ($date === null) {
        $date = time();
    } else {
        $day_searched = substr($date, 0, 2);
        $month_searched = substr($date, 3, 2);
        $year_searched = substr($date, 6, 4);
        $date = mktime(0, 0, 0, $month_searched, $day_searched, $year_searched);
    }
    $CI =& get_instance();

    $select = 'match_id,
               match.fixture_id,
               t1.team_id AS t1_id,
               t2.team_id AS t2_id,
               t1.name AS team1,
               t2.name AS team2,
               t1.short_name AS short_team1,
               t2.short_name AS short_team2,
               team1_score,
               team2_score,
               DATE_FORMAT(date, "%H:%i") as match_time,
               date,
               fixture.status as status,
               IF (championship.name NOT LIKE "%Ligue 1%", "no-logo", "")
               as no_logo';
    $join1 = 'match.team1_id = t1.team_id';
    $join2 = 'match.team2_id = t2.team_id';
    $join3 = 'match.fixture_id = fixture.fixture_id';
    $join4 = 'fixture.championship_id = championship.championship_id';
    $where = array(
        'date >' => date('Y-m-d 00:00:00', $date),
        'date <' => date('Y-m-d 23:59:59', $date),
        'championship.status' => 'open',
    );
    $order = 'date ASC';
    $matches_of_day = $CI->db->select($select)
        ->from($CI->config->item('match', 'table'))
        ->join('team t1', $join1, 'inner')
        ->join('team t2', $join2, 'inner')
        ->join('fixture', $join3, 'inner')
        ->join('championship', $join4, 'inner')
        ->where($where)
        ->order_by($order)
        ->get()
        ->result();
    if (empty($matches_of_day)) {
        return null;
    } else {
        return array(
            'matches' => $matches_of_day,
            'date' => date('d/m/Y', $date)
        );
    }
}

/**
 * Cette fonction renvoie les derniers matchs joués.
 *
 * @return les derniers matchs joués
 */
function Last_matches()
{
    $CI =& get_instance();

    // Récupération de la date des derniers matchs
    $select = 'date, DATE_FORMAT(`date`, "%d/%m/%Y") as formated_date';
    $join1 = 'match.fixture_id = fixture.fixture_id';
    $join2 = 'fixture.championship_id = championship.championship_id';
    $where1 = 'date <= NOW()';
    $where2 = array('championship.status' => 'open');
    $order = 'date DESC';
    $limit = 1;
    $date_last_matches = $CI->db->select($select)
        ->from($CI->config->item('match', 'table'))
        ->join('fixture', $join1, 'inner')
        ->join('championship', $join2, 'inner')
        ->where($where1)
        ->where($where2)
        ->order_by($order)
        ->limit($limit)
        ->get()
        ->result();
    if ($date_last_matches) {
        return Matches_Of_day($date_last_matches[0]->formated_date);
    } else {
        return null;
    }
}

/**
 * Cette fonction renvoie les prochains matchs à jouer.
 *
 * @return les prochains matchs à jouer
 */
function Next_matches()
{
    $CI =& get_instance();

    // Récupération de la date des prochains matchs
    $select = 'date, DATE_FORMAT(`date`, "%d/%m/%Y") as formated_date';
    $join1 = 'match.fixture_id = fixture.fixture_id';
    $join2 = 'fixture.championship_id = championship.championship_id';
    $where1 = 'date >= NOW()';
    $where2 = array('championship.status' => 'open');
    $order = 'date ASC';
    $limit = 1;
    $date_next_matches = $CI->db->select($select)
        ->from($CI->config->item('match', 'table'))
        ->join('fixture', $join1, 'inner')
        ->join('championship', $join2, 'inner')
        ->where($where1)
        ->where($where2)
        ->order_by($order)
        ->limit($limit)
        ->get()
        ->result();
    if ($date_next_matches) {
        return Matches_Of_day($date_next_matches[0]->formated_date);
    } else {
        return null;
    }
}