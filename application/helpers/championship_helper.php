<?php
/**
 * Championship helper file
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
 * Cette fonction vérifie qu'un championnat a des équipes qui évoluent
 * (coupe, tournoi).
 *
 * @param Integer $championship_id championnnat à vérifier
 *
 * @return Bool Booléen pour savoir si les équipes du championnat évoluent
 */
function Championship_Teams_evolve($championship_id)
{
    $CI =& get_instance();
    $where = array(
        'championship_id' => $championship_id,
    );
    $championship_teams_evolve = $CI->db->select('teams_evolve')
        ->from($CI->config->item('championship', 'table'))
        ->where($where)
        ->get()
        ->result();
    return ($championship_teams_evolve[0]->teams_evolve == 0) ? false : true;
}