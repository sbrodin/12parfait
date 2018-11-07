<?php
/**
 * Score helper file
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
 * Cette fonction permet de calculer le score fait par un joueur en fonction de
 * ses bets pour une journée
 *
 * @param integer $fixture_id Id de la journée
 *
 * @return Bool Retourne true si la mise à jour s'est bien effectuée.
 */
function Score_calculator($fixture_id)
{
    if (!defined('BON_RESULTAT')) {
        define('BON_RESULTAT', 4);
    }
    if (!defined('BON_SCORE_EQUIPE_1')) {
        define('BON_SCORE_EQUIPE_1', 3);
    }
    if (!defined('BON_SCORE_EQUIPE_2')) {
        define('BON_SCORE_EQUIPE_2', 3);
    }
    if (!defined('DIFFERENCE_2_EQUIPES')) {
        define('DIFFERENCE_2_EQUIPES', 2);
    }

    $CI =& get_instance();

    // On récupère les bets pour la journée
    $select = 'bet_id,
               user_id,
               bet.match_id,
               bet.date AS bet_date,
               bet.result AS bet_result,
               bet.team1_score AS bet_team1_score,
               bet.team2_score AS bet_team2_score,
               bet.status AS bet_status,
               match.result AS match_result,
               match.team1_score AS match_team1_score,
               match.team2_score AS match_team2_score,
               match.date AS match_date';
    $where = array(
        'fixture_id' => $fixture_id,
        'bet.status' => 'open',
        'match.result !=' => null,
    );
    $fixture_bets = $CI->db->select($select)
        ->from($CI->config->item('bet', 'table'))
        ->join('match', 'bet.match_id = match.match_id', 'left')
        ->where($where)
        ->get()
        ->result();
    if (empty($fixture_bets)) {
        return true;
    }

    // Calcul du score pour chaque bet
    $user_score = array();
    foreach ($fixture_bets as $key => $fixture_bet) {
        $score = 0;
        $bet_team1_score = $fixture_bet->bet_team1_score;
        $bet_team2_score = $fixture_bet->bet_team2_score;
        $bet_team_diff = $bet_team1_score - $bet_team2_score;
        $match_team1_score = $fixture_bet->match_team1_score;
        $match_team2_score = $fixture_bet->match_team2_score;
        $match_team_diff = $match_team1_score - $match_team2_score;
        if ($fixture_bet->bet_result == $fixture_bet->match_result) {
            $score+= BON_RESULTAT;
        }
        if ($bet_team1_score == $match_team1_score) {
            $score+= BON_SCORE_EQUIPE_1;
        }
        if ($bet_team2_score == $match_team2_score) {
            $score+= BON_SCORE_EQUIPE_2;
        }
        if ($bet_team_diff == $match_team_diff) {
            $score+= DIFFERENCE_2_EQUIPES;
        }
        // Mise à jour du score et du statut des bets
        $where = array('bet_id' => $fixture_bet->bet_id);
        $donnees_echapees = array(
            // 'status' => 'checked',
            'score' => $score,
        );
        $CI->db->set($donnees_echapees)
            ->where($where)
            ->update($CI->config->item('bet', 'table'));
    }
    return true;
}

/**
 * Cette fonction permet de récupérer les scores de chaque joueur
 *
 * @return Bool Retourne les scores de chaque joueur.
 */
function Users_Score_calculator()
{
    $CI =& get_instance();

    // On récupère les bets pour la journée
    $select = 'user.user_id, SUM(b.score) as score';
    $users_scores = $CI->db->select($select)
        ->from($CI->config->item('user', 'table'))
        ->join('bet b', 'user.user_id = b.user_id', 'left')
        ->group_by('b.user_id')
        ->get()
        ->result();
    if (empty($users_scores)) {
        return false;
    } else {
        $scores = array();
        foreach ($users_scores as $key => $user_score) {
            $scores[$user_score->user_id] = $user_score->score;
        }
        return $scores;
    }
}