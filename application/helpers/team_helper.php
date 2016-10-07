<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction vérifie qu'une équipe appartient à un championnat.
  *
  * @param $team_id équipe à vérifier
  * @param $championship_id championnnat à vérifier
  * @return Booléen pour savoir si l'équipe appartient au championnat
  */
function is_team_in_championship($team_id, $championship_id) {
    $CI =& get_instance();
    $where = array(
        'team_id' => $team_id,
        'championship_id' => $championship_id,
    );
    $team_championship = $CI->db->select('*')
                                ->from($CI->config->item('championship_team', 'table'))
                                ->where($where)
                                ->get()
                                ->result();
    return empty($team_championship) ? FALSE : TRUE;
}