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
               t1.short_name AS team1,
               t2.short_name AS team2,
               team1_score,
               team2_score,
               DATE_FORMAT(date, "%H:%i") as match_time';
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
    return empty($matches_of_day) ? NULL : array($matches_of_day, date('d/m/Y', $date));
}

/**
  * Cette fonction renvoie les derniers matchs joués.
  *
  * @return les derniers matchs joués
  */
function last_matches() {
    $CI =& get_instance();

    // Récupération de la date des derniers matchs
    $select = 'date';
    $where = 'date <= NOW()';
    $order = 'date DESC';
    $limit = 1;
    $date_last_matches = $CI->db->select($select)
                                ->from($CI->config->item('match', 'table'))
                                ->where($where)
                                ->order_by($order)
                                ->limit($limit)
                                ->get()
                                ->result();
    $date_last_matches = $date_last_matches[0]->date;

    $year_searched = substr($date_last_matches, 0, 4);
    $month_searched = substr($date_last_matches, 5, 2);
    $day_searched = substr($date_last_matches, 8, 2);

    return matches_of_day($day_searched . '/' . $month_searched . '/' . $year_searched);
}

/**
  * Cette fonction renvoie les prochains matchs à jouer.
  *
  * @return les prochains matchs à jouer
  */
function next_matches() {
    $CI =& get_instance();

    // Récupération de la date des derniers matchs
    $select = 'date';
    $where = 'date >= NOW()';
    $order = 'date ASC';
    $limit = 1;
    $date_next_matches = $CI->db->select($select)
                                ->from($CI->config->item('match', 'table'))
                                ->where($where)
                                ->order_by($order)
                                ->limit($limit)
                                ->get()
                                ->result();
    $date_next_matches = $date_next_matches[0]->date;

    $year_searched = substr($date_next_matches, 0, 4);
    $month_searched = substr($date_next_matches, 5, 2);
    $day_searched = substr($date_next_matches, 8, 2);

    return matches_of_day($day_searched . '/' . $month_searched . '/' . $year_searched);
}