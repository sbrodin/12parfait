<?php

/**
  * Cette classe définit les règles pour l'affichage d'un match
  */
class Match extends MY_Controller {

    /**
    * Constructeur qui appelle les models utilisés par le controller
    */
    public function __construct() {
        parent::__construct();
        $this->load->model('bet_model');
        $this->load->model('log_model');
        $this->load->model('match_model');
    }

    /**
    * Fonction d'affichage de la page de profil.
    */
    public function index($match_id = 0) {
        Save_log('match', 'index', 'Affichage des stats du match : '.$match_id);

        if ($match_id === 0) {
            Save_log('match', 'index', 'Tentative d\'accès aux stats du match : '.$match_id);
            show_404();
        }

        $data = array();

        // Liste des paris du match
        $select = 'match.match_id,
                   match.date,
                   match.result AS match_result,
                   match.team1_score AS match_team1score,
                   match.team2_score AS match_team2score,
                   DATE_FORMAT(match.date, "%d/%m/%Y à %Hh%i") AS formated_date,
                   fixture.name AS fixture_name,
                   championship.name AS championship_name,
                   t1.team_id AS t1_id,
                   t2.team_id AS t2_id,
                   t1.name AS team1_name,
                   t2.name AS team2_name,
                   t1.short_name AS team1_shortname,
                   t2.short_name AS team2_shortname,
                   bet.user_id,
                   bet.result AS bet_result,
                   bet.team1_score AS bet_team1score,
                   bet.team2_score AS bet_team2score,
                   IF (championship.name NOT LIKE "%Ligue 1%", "no-logo", "") as no_logo';
        $where = array(
            'match.match_id' => $match_id,
        );
        $nb = null;
        $debut = null;
        $order = 'user_id ASC';
        $match_infos = $this->db->select($select)
                                ->from($this->config->item('match', 'table'))
                                ->join('team t1', 'match.team1_id = t1.team_id', 'inner')
                                ->join('team t2', 'match.team2_id = t2.team_id', 'inner')
                                ->join('bet', 'match.match_id = bet.match_id', 'left')
                                ->join('fixture', 'match.fixture_id = fixture.fixture_id', 'left')
                                ->join('championship', 'fixture.championship_id = championship.championship_id', 'left')
                                ->where($where)
                                ->limit($nb, $debut)
                                ->order_by($order)
                                ->get()
                                ->result();

        $data['bets_number'] = count($match_infos);

        if (isset($match_infos[0])) {
            // Par défaut on affiche des stats de base
            $data['match_infos'] = array(
                'date' => $match_infos[0]->formated_date,
                'team1' => $match_infos[0]->team1_name,
                'team2' => $match_infos[0]->team2_name,
                'team1_shortname' => $match_infos[0]->team1_shortname,
                'team2_shortname' => $match_infos[0]->team2_shortname,
                'championship_name' => $match_infos[0]->championship_name,
                'fixture_name' => $match_infos[0]->fixture_name,
                'no_logo' => $match_infos[0]->no_logo,
            );
            // Message si le match n'a pas commencé
            if ($match_infos[0]->date > date('Y-m-d H:i:s')) {
                $data['info'] = $this->lang->line('match_has_not_started');
                // S'il n'y a pas de paris pour cette journée, on affiche un message
                if ($data['bets_number'] === 1 && $match_infos[0]->user_id === null) {
                    $data['bets_info'] = $this->lang->line('no_bet_yet');
                } else {
                    $data['bets_info'] = sprintf($this->lang->line('x_bets_placed'), $data['bets_number']);
                }
            } else {
                // S'il n'y a pas de paris pour cette journée, on affiche un message
                if ($data['bets_number'] === 1 && $match_infos[0]->user_id === null) {
                    $data['info'] = $this->lang->line('no_stats_for_match');
                    $data['bets_number'] = 0;
                } else {
                    $data['result_stats']['1'] = 0;
                    $data['result_stats']['N'] = 0;
                    $data['result_stats']['2'] = 0;
                    $data['goals_for_stats'] = 0;
                    $data['goals_against_stats'] = 0;
                    foreach ($match_infos as $match_info) {
                        ++$data['result_stats'][$match_info->bet_result];
                        $data['goals_for_stats']+= $match_info->bet_team1score;
                        $data['goals_against_stats']+= $match_info->bet_team2score;
                    }
                }
            }
        } else {
            Save_log('match', 'index', 'Tentative d\'accès aux stats du match : '.$match_id);
            show_404();
        }
        $data['title'] = $this->lang->line('match_stats').' : '.$data['match_infos']['team1'].' - '.$data['match_infos']['team2'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('match/stats', $data);
        $this->load->view('templates/footer');
    }
}