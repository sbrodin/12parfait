<?php
/**
 * User challenge helper file
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
 * Cette fonction vérifie qu'un utilisateur a les droits permettant
 * de voir un challenge.
 *
 * @param array $challenges Tableau de challenges pour lesquels on souhaite
 *                          vérifier l'accès
 *
 * @return Bool Booléen pour savoir si le challenge est accessible
 */
function User_Can_View_challenge($challenges)
{
    $user_id = get_instance()->session->userdata('user')->user_id;
    $join = 'user_challenge.challenge_id = challenge.challenge_id';

    $select = '*';
    $where = array('user_id' => $user_id);
    $data = get_instance()->db->select($select)
        ->from('user_challenge')
        ->join('challenge', $join)
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
            // Dès qu'on tombe sur un élément du tableau qui n'est pas dans les
            // challenges possibles, on renvoie false
            if (!in_array($challenge, $user_challenges)) {
                return false;
            }
        }
        return true;
    }
    return in_array($challenges, $user_challenges);
}