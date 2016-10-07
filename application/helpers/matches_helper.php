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
                   t1.team_id AS t1_id,
                   t2.team_id AS t2_id,
                   t1.short_name AS team1,
                   t2.short_name AS team2,
                   team1_score,
                   team2_score,
                   DATE_FORMAT(date,
                   "%H:%i") as match_time';
        $where = array(
            'date >' => date('Y-m-d 00:00:00', $date),
            'date <' => date('Y-m-d 23:59:59', $date),
        );
        $order = 'date ASC';
        $matches_of_day = $CI->db->select($select)
                                ->from($CI->config->item('match', 'table'))
                                ->join('team t1', 'match.team1_id = t1.team_id', 'inner')
                                ->join('team t2', 'match.team2_id = t2.team_id', 'inner')
                                ->where($where)
                                ->order_by($order)
                                ->get()
                                ->result();
        return empty($matches_of_day) ? FALSE : $matches_of_day;
    }
