<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction renvoie les première et dernière dates d'une journée.
  *
  * @param $fixture_id identifiant de la journée
  * @return les première et dernière dates de la journée
  */
function fixture_dates($fixture_id) {
    $CI =& get_instance();

    // Récupération de la date du premier match de la journée
    $select = 'DATE_FORMAT(`date`, "%d/%m/%Y à %Hh%i") as date';
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
    $first_date = $first_date[0]->date;


    // Récupération de la date du dernier match de la journée
    $select = 'DATE_FORMAT(`date`, "%d/%m/%Y à %Hh%i") as date';
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
    $last_date = $last_date[0]->date;

    return array(
        'first' => $first_date,
        'last' => $last_date,
    );
}