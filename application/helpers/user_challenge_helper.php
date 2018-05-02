<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction vérifie qu'un utilisateur a les droits permettants de voir un challenge.
  *
  * @param $challenges Tableau de challenges pour lesquels on souhaite vérifier l'accès
  * @return Booléen pour savoir si le challenge est accessible
  */
function user_can_view_challenge($challenges) {
    $select = '*';
    $where = array('user_id' => get_instance()->session->userdata('user')->user_id);
    $data = get_instance()->db->select($select)
                                         ->from('user_challenge')
                                         ->join('challenge', 'user_challenge.challenge_id = challenge.challenge_id')
                                         ->where($where)
                                         ->get()
                                         ->result();
    $user_challenges = array();
    foreach ($data as $key => $user_challenge) {
        $user_challenges[$user_challenge->hash] = $user_challenge;
    }
    echo '<pre>';
    print_r($challenges);
    print_r($user_challenges);
    echo '</pre>';
    exit;

    if (is_array($challenges)) {
        foreach ($challenges as $challenge) {
            // Dès qu'on tombe sur un élément du tableau qui n'est pas dans les challenges possibles, on renvoie false
            if (!in_array($challenge, $user_challenges)) {
                return false;
            }
        }
        return true;
    }
    return in_array($challenges, $user_challenges);
}