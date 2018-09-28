<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction renvoie les matchs d'un jour passé en paramètre.
  *
  * @param $date date des matchs à récupérer au format JJ/MM/AAAA
  * @return FALSE si aucun match n'est trouvé, ou les matchs du jour passé en paramètre
  */
function matches_of_day($date = NULL) {
    if ($date === NULL) {
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
               fixture.status as status';
    $where = array(
        'date >' => date('Y-m-d 00:00:00', $date),
        'date <' => date('Y-m-d 23:59:59', $date),
        'championship.status' => 'open',
    );
    $order = 'date ASC';
    $matches_of_day = $CI->db->select($select)
                             ->from($CI->config->item('match', 'table'))
                             ->join('team t1', 'match.team1_id = t1.team_id', 'inner')
                             ->join('team t2', 'match.team2_id = t2.team_id', 'inner')
                             ->join('fixture', 'match.fixture_id = fixture.fixture_id', 'inner')
                             ->join('championship', 'fixture.championship_id = championship.championship_id', 'inner')
                             ->where($where)
                             ->order_by($order)
                             ->get()
                             ->result();
    return empty($matches_of_day) ? NULL : array('matches' => $matches_of_day, 'date' => date('d/m/Y', $date));
}

/**
  * Cette fonction renvoie les derniers matchs joués.
  *
  * @return les derniers matchs joués
  */
function last_matches() {
    $CI =& get_instance();

    // Récupération de la date des derniers matchs
    $select = 'date, DATE_FORMAT(`date`, "%d/%m/%Y") as formated_date';
    $where1 = 'date <= NOW()';
    $where2 = array('championship.status' => 'open');
    $order = 'date DESC';
    $limit = 1;
    $date_last_matches = $CI->db->select($select)
                                ->from($CI->config->item('match', 'table'))
                                ->join('fixture', 'match.fixture_id = fixture.fixture_id', 'inner')
                                ->join('championship', 'fixture.championship_id = championship.championship_id', 'inner')
                                ->where($where1)
                                ->where($where2)
                                ->order_by($order)
                                ->limit($limit)
                                ->get()
                                ->result();
    if ($date_last_matches) {
        return matches_of_day($date_last_matches[0]->formated_date);
    } else {
        return null;
    }
}

/**
  * Cette fonction renvoie les prochains matchs à jouer.
  *
  * @return les prochains matchs à jouer
  */
function next_matches() {
    $CI =& get_instance();

    // Récupération de la date des prochains matchs
    $select = 'date, DATE_FORMAT(`date`, "%d/%m/%Y") as formated_date';
    $where1 = 'date >= NOW()';
    $where2 = array('championship.status' => 'open');
    $order = 'date ASC';
    $limit = 1;
    $date_next_matches = $CI->db->select($select)
                                ->from($CI->config->item('match', 'table'))
                                ->join('fixture', 'match.fixture_id = fixture.fixture_id', 'inner')
                                ->join('championship', 'fixture.championship_id = championship.championship_id', 'inner')
                                ->where($where1)
                                ->where($where2)
                                ->order_by($order)
                                ->limit($limit)
                                ->get()
                                ->result();
    if ($date_next_matches) {
        return matches_of_day($date_next_matches[0]->formated_date);
    } else {
        return null;
    }
}