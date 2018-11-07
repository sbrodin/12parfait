<?php
/**
 * Log helper file
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
 * Cette fonction vérifie qu'une équipe appartient à un championnat.
 *
 * @param Integer $team_id         Équipe à vérifier
 * @param Integer $championship_id Championnnat à vérifier
 *
 * @return Bool Booléen pour savoir si l'équipe appartient au championnat
 */
function Is_Team_In_championship($team_id, $championship_id)
{
    $CI =& get_instance();
    $where = array(
        'team_id' => $team_id,
        'championship_id' => $championship_id,
    );
    $team_championship = $CI->db->select('1')
        ->from($CI->config->item('championship_team', 'table'))
        ->where($where)
        ->get()
        ->result();
    return empty($team_championship) ? false : true;
}