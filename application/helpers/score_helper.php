<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction permet de calculer le score fait par un joueur en fonction de ses bets pour une journée
  * @param $fixture_id     Id de la journée
  * @return Bool Retourne TRUE si le mail a été accepté pour livraison, FALSE sinon.
  */
if (!function_exists('score_calculator')) {
    function score_calculator($fixture_id) {
        $CI =& get_instance();

        // On récupère les matchs de la journée
        $select = '*';
        $where = array('fixture_id' => $fixture_id);
        $fixture_matches = $CI->db->select($select)
                                  ->from($CI->config->item('match', 'table'))
                                  ->where($where)
                                  ->get()
                                  ->result();
        var_dump($fixture_matches);

        $bets = array();
        // Pour chaque match, on recherche les bets entrés
        foreach ($fixture_matches as $key => $fixture_match) {
            $select = '*';
            $where = array('match_id' => $fixture_match->match_id);
            $bets[$fixture_match->match_id] = $CI->db->select($select)
                                                     ->from($CI->config->item('bet', 'table'))
                                                     ->where($where)
                                                     ->get()
                                                     ->result();
        }
        var_dump($bets);
        exit;

        return mail($recipient, $subject, $message, $headers);
    }
}