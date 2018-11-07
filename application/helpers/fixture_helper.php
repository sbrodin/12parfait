<?php
/**
 * Fixture helper file
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
 * Cette fonction renvoie les première et dernière dates d'une journée.
 *
 * @param Integer $fixture_id Identifiant de la journée
 *
 * @return Array Les première et dernière dates de la journée
 */
function Fixture_dates($fixture_id)
{
    $CI =& get_instance();

    // Récupération de la date du premier match de la journée
    $select = 'date, DATE_FORMAT(`date`, "%d/%m/%Y à %Hh%i") as formated_date';
    $order = 'date ASC';
    $limit = 1;
    $first_date = $CI->db->select($select)
        ->from($CI->config->item('match', 'table'))
        ->join('fixture', 'match.fixture_id = fixture.fixture_id')
        ->where('fixture.fixture_id', $fixture_id)
        ->order_by($order)
        ->limit($limit)
        ->get()
        ->result();
    if (!empty($first_date)) {
        $first_date = $first_date[0]->formated_date;
    } else {
        $first_date = null;
    }

    // Récupération de la date du dernier match de la journée
    $select = 'date, DATE_FORMAT(`date`, "%d/%m/%Y à %Hh%i") as formated_date';
    $order = 'date DESC';
    $limit = 1;
    $last_date = $CI->db->select($select)
        ->from($CI->config->item('match', 'table'))
        ->join('fixture', 'match.fixture_id = fixture.fixture_id')
        ->where('fixture.fixture_id', $fixture_id)
        ->order_by($order)
        ->limit($limit)
        ->get()
        ->result();
    if (!empty($last_date)) {
        $last_date = $last_date[0]->formated_date;
    } else {
        $last_date = null;
    }

    return array(
        'first' => $first_date,
        'last' => $last_date,
    );
}