<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction permet de calculer le score fait par un joueur en fonction de ses bets pour une journée
  * @param $fixture_id     Id de la journée
  * @return Bool Retourne TRUE si la mise à jour s'est bien effectuée.
  */
if (!function_exists('score_calculator')) {
    function score_calculator($fixture_id) {
        define('BON_RESULTAT', 4);
        define('BON_SCORE_EQUIPE_1', 3);
        define('BON_SCORE_EQUIPE_2', 3);
        define('BONUS_BONS_SCORES_2_EQUIPES', 2);

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
            'match.result !=' => 'null',
        );
        $fixture_bets = $CI->db->select($select)
                               ->from($CI->config->item('bet', 'table'))
                               ->join('match', 'bet.match_id = match.match_id', 'left')
                               ->where($where)
                               ->get()
                               ->result();
        if (empty($fixture_bets)) {
            return TRUE;
        }

        // Calcul du score pour chaque bet
        $user_score = array();
        foreach ($fixture_bets as $key => $fixture_bet) {
            $score = 0;
            if ($fixture_bet->bet_result == $fixture_bet->match_result) {
                $score+= BON_RESULTAT;
            }
            if ($fixture_bet->bet_team1_score == $fixture_bet->match_team1_score) {
                $score+= BON_SCORE_EQUIPE_1;
            }
            if ($fixture_bet->bet_team2_score == $fixture_bet->match_team2_score) {
                $score+= BON_SCORE_EQUIPE_2;
            }
            if ($fixture_bet->bet_team1_score == $fixture_bet->match_team1_score &&
                $fixture_bet->bet_team2_score == $fixture_bet->match_team2_score) {
                $score+= BONUS_BONS_SCORES_2_EQUIPES;
            }
            if ($score!==0) {
                $user_score[$fixture_bet->user_id]+= $score;
            }
            // Mise à jour du statut des bets
            $where = array('bet_id' => $fixture_bet->bet_id);
            $donnees_echapees = array(
                'status' => 'checked',
            );
            $CI->db->set($donnees_echapees)
                   ->where($where)
                   ->update($CI->config->item('bet', 'table'));
        }

        // Récupération des scores non actualisés de chaque joueur
        $select = 'user_id, score';
        $user_current_scores = $CI->db->select($select)
                                      ->from($CI->config->item('user', 'table'))
                                      ->where_in('user_id', array_keys($user_score))
                                      ->get()
                                      ->result();

        // Mise à jour du score de chaque joueur
        foreach ($user_current_scores as $key => $user_current_score) {
            if (isset($user_score[$user_current_score->user_id])) {
                $where = array('user_id' => $user_current_score->user_id);
                $donnees_echapees = array(
                    'score' => $user_current_score->score + $user_score[$user_current_score->user_id],
                );
                $CI->db->set($donnees_echapees, NULL, FALSE)
                       ->where($where)
                       ->update($CI->config->item('user', 'table'));
            }
        }

        foreach ($user_current_scores as $key => $user_current_score) {
            if (isset($user_score[$user_current_score->user_id])) {
                $where = array('user_id' => $user_current_score->user_id);
                $donnees_echapees = array(
                    'score' => $user_current_score->score + $user_score[$user_current_score->user_id],
                );
                $CI->db->set($donnees_echapees)
                       ->where($where)
                       ->update($CI->config->item('user', 'table'));
            }
        }
        return TRUE;
    }
}