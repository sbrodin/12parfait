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
    if (!defined('FOOT_BON_RESULTAT')) {
        define('FOOT_BON_RESULTAT', 4);
    }
    if (!defined('FOOT_BON_SCORE_EQUIPE_1')) {
        define('FOOT_BON_SCORE_EQUIPE_1', 3);
    }
    if (!defined('FOOT_BON_SCORE_EQUIPE_2')) {
        define('FOOT_BON_SCORE_EQUIPE_2', 3);
    }
    if (!defined('FOOT_DIFFERENCE_2_EQUIPES')) {
        define('FOOT_DIFFERENCE_2_EQUIPES', 2);
    }
    if (!defined('RUGBY_BON_RESULTAT')) {
        define('RUGBY_BON_RESULTAT', 12);
    }
    if (!defined('SPORT_FOOTBALL')) {
        define('SPORT_FOOTBALL', 'football');
    }
    if (!defined('SPORT_RUGBY')) {
        define('SPORT_RUGBY', 'rugby');
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
               match.date AS match_date,
               championship.sport';
    $where = array(
        'match.fixture_id' => $fixture_id,
        'bet.status' => 'open',
        'match.result !=' => null,
    );
    $fixture_bets = $CI->db->select($select)
                           ->from($CI->config->item('bet', 'table'))
                           ->join('match', 'bet.match_id = match.match_id', 'left')
                           ->join('fixture', 'fixture.fixture_id = match.fixture_id', 'left')
                           ->join('championship', 'championship.championship_id = fixture.championship_id', 'left')
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
        $bet_diff = $bet_team1_score - $bet_team2_score;
        $match_team1_score = $fixture_bet->match_team1_score;
        $match_team2_score = $fixture_bet->match_team2_score;
        $match_diff = $match_team1_score - $match_team2_score;
        $sport = $fixture_bet->sport;
        if ($sport === SPORT_FOOTBALL) {
            if ($fixture_bet->bet_result == $fixture_bet->match_result) {
              $score+= FOOT_BON_RESULTAT;
            }
            if ($bet_team1_score == $match_team1_score) {
              $score+= FOOT_BON_SCORE_EQUIPE_1;
            }
            if ($bet_team2_score == $match_team2_score) {
              $score+= FOOT_BON_SCORE_EQUIPE_2;
            }
            if ($bet_diff == $match_diff) {
              $score+= FOOT_DIFFERENCE_2_EQUIPES;
            }
        } else if ($sport === SPORT_RUGBY) {
            // Victoire de l'équipe à domicile
            if ($match_diff > 0 && $bet_diff > 0) {
                $score = RUGBY_BON_RESULTAT;
            }
            // Match nul
            else if ($match_diff === 0 && $bet_diff === 0) {
                $score = RUGBY_BON_RESULTAT;
            }
            // Victoire de l'équipe à l'extérieur
            else if ($match_diff < 0 && $bet_diff < 0) {
                $score = RUGBY_BON_RESULTAT;
            }
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
 * @return Mixed Retourne les scores de chaque joueur.
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