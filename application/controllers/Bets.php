<?php

class Bets extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('bet_model');
        $this->load->model('log_model');
    }

    public function index()
    {
        save_log('bets', 'index');
        if (!user_can('view_bets')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('bets');

        // Récupération des éventuels filtres
        $filters['filters_bets'] = array(
            'championship' => '',
            'fixture' => '',
        );
        if (isset($this->session->filters_bets)) {
            $filters['filters_bets'] = $this->session->filters_bets;
        }
        $post = $this->input->post();
        if (!empty($post)) {
            if ($post['submit'] == $this->lang->line('del_filter')) {
                $filters['filters_bets']['championship'] = '';
                $filters['filters_bets']['fixture'] = '';
            } else {
                $filters['filters_bets']['championship'] = ($post['championship'] == 0) ? '' : $post['championship'];
                $filters['filters_bets']['fixture'] = ($post['fixture'] == 0) ? '' : $post['fixture'];
            }
            $this->session->set_userdata($filters);
        }
        if ($filters['filters_bets']['championship'] !== '' || $filters['filters_bets']['fixture'] !== '') {
            $data['collapse_filters'] = 'in';
        } else {
            $data['collapse_filters'] = '';
        }
        $data['filters_bets'] = $filters['filters_bets'];

        $select = 'fixture_id,
                   fixture.name AS fixture_name,
                   championship.championship_id,
                   championship.name AS championship_name,
                   fixture.status';
        $where = array('championship.status' => 'open');
        if (isset($filters['filters_bets']['championship']) && $filters['filters_bets']['championship']!='') {
            $where = array_merge($where, array('championship.championship_id' => $filters['filters_bets']['championship']));
        }
        if (isset($filters['filters_bets']['fixture']) && $filters['filters_bets']['fixture']!='') {
            $where = array_merge($where, array('fixture.fixture_id' => $filters['filters_bets']['fixture']));
        }
        // $order = 'championship_name ASC, cast(fixture_name AS UNSIGNED) ASC';
        $order = 'championship_name ASC, length(fixture_name), fixture_name';
        $data['fixtures'] = $this->db->select($select)
                                     ->from($this->config->item('fixture', 'table'))
                                     ->where($where)
                                     ->join('championship', 'championship.championship_id = fixture.championship_id', 'left')
                                     ->order_by($order)
                                     ->get()
                                     ->result();
        // Récupération des championnats pour les filtres
        $championship = '';
        $data['championships'] = array();
        foreach ($data['fixtures'] as $key => $fixture_infos) {
            if ($fixture_infos->championship_name !== $championship) {
                $data['championships'][$fixture_infos->championship_id] = $fixture_infos->championship_name;
                $championship = $fixture_infos->championship_name;
            }
        }

        // Récupération du message d'information pour les pronostics
        $language = $this->session->user->language;
        if (empty($language)) {
            $language = 'french';
        }
        $this->load->model('message_model');
        $data['bet_message'] = $this->message_model->get_message('bet-message');
        if ($data['bet_message'] !== '') {
            $data['bet_message'] = $data['bet_message'][0]->{$language.'_content'};
        }
        $data['bet_message'] = html_entity_decode($data['bet_message']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('bets/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit($fixture_id = 0)
    {
        save_log('bets', 'edit');
        if (!user_can('edit_bet')) {
            show_404();
        }

        if ($fixture_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = $this->lang->line('add_edit_bet');

        // Récupération des utilisateurs pour voir leurs paris
        $this->load->model('user_model');
        $where = array(
            'user_id !=' => $this->session->userdata('user_id'),
            'user.active' => 1,
        );
        $nb = NULL;
        $debut = NULL;
        $order = 'user_id ASC';
        $data['users'] = $this->user_model->read('user_id, user_name', $where, $nb, $debut, $order);

        foreach ($data['users'] as $users_item) {
            $users_item->user_name = ($users_item->user_name === '') ? $this->lang->line('anonymous').$users_item->user_id : $users_item->user_name;
        }

        // Récupération des éventuels paris d'autres joueurs
        $filters['bets_of_players'] = array();
        if (isset($this->session->bets_of_players)) {
            $filters['bets_of_players'] = $this->session->bets_of_players;
        }
        $post = $this->input->post();
        if (!empty($post)) {
            if (isset($post['submit-filter']) && $post['submit-filter'] == $this->lang->line('del_filter')) {
                $filters['bets_of_players'] = array();
            } else {
                $filters['bets_of_players'] = (isset($post['users'])) ? $post['users'] : array();
            }
            $this->session->set_userdata($filters);
        }
        if (!empty($filters['bets_of_players'])) {
            $data['collapse_filters'] = 'in';
        } else {
            $data['collapse_filters'] = '';
        }
        $data['bets_of_players'] = $filters['bets_of_players'];

        $data['fixture_id'] = $fixture_id;

        // Liste des matchs de la journée
        $select = 'championship.name AS championship_name,
                   fixture.name AS fixture_name,
                   fixture.status AS fixture_status,
                   t1.team_id AS t1_id,
                   t2.team_id AS t2_id,
                   t1.name AS team1,
                   t2.name AS team2,
                   t1.short_name AS short_team1,
                   t2.short_name AS short_team2,
                   match.date,
                   match.match_id,
                   match.team1_score,
                   match.team2_score';
        $where = array(
            'fixture.fixture_id' => $fixture_id,
        );
        $nb = NULL;
        $debut = NULL;
        $order = 'date ASC, match.match_id';
        $data['fixture_matches'] = $this->db->select($select)
                                            ->from($this->config->item('fixture', 'table'))
                                            ->join('match', 'fixture.fixture_id = match.fixture_id', 'left')
                                            ->join('championship', 'fixture.championship_id = championship.championship_id', 'left')
                                            ->join('team t1', 'match.team1_id = t1.team_id', 'inner')
                                            ->join('team t2', 'match.team2_id = t2.team_id', 'inner')
                                            ->where($where)
                                            ->limit($nb, $debut)
                                            ->order_by($order)
                                            ->get()
                                            ->result();

        if (!empty($data['fixture_matches'])) {
            $data['championship_name'] = $data['fixture_matches'][0]->championship_name;
            $data['fixture_name'] = $data['fixture_matches'][0]->fixture_name;
            $data['fixture_status'] = $data['fixture_matches'][0]->fixture_status;

            // Liste des équipes
            $data['teams'] = array();
            foreach ($data['fixture_matches'] as $key => $fixture_match) {
                $data['teams'][$fixture_match->t1_id] = $fixture_match->team1;
                $data['teams'][$fixture_match->t2_id] = $fixture_match->team2;
            }
            asort($data['teams']);

            // Liste des matchs
            $data['matches'] = array();
            foreach ($data['fixture_matches'] as $key => $fixture_match) {
                $data['matches'][$fixture_match->match_id] = $fixture_match->date;
            }

            // Liste des paris de l'utilisateur pour la journée
            $select = 'user_id,
                       bet.match_id,
                       bet.team1_score,
                       bet.team2_score,
                       bet.score';
            $where = array(
                'bet.user_id' => $this->session->userdata('user_id'),
                'match.fixture_id' => $fixture_id,
            );
            $order = 'match.date ASC, match.match_id';
            $data['my_fixture_bets'] = $this->db->select($select)
                                             ->from($this->config->item('bet', 'table'))
                                             ->join('match', 'bet.match_id = match.match_id', 'left')
                                             ->join('fixture', 'match.fixture_id = fixture.fixture_id', 'left')
                                             ->where($where);
            $data['my_fixture_bets'] = $data['my_fixture_bets']->order_by($order)
                                                         ->get()
                                                         ->result();

            // Liste des paris des autres joueurs pour la journée
            if (!empty($filters['bets_of_players'])) {
                $select = 'bet.user_id,
                           user_name,
                           bet.match_id,
                           bet.team1_score,
                           bet.team2_score,
                           bet.score';
                $order = 'user_id, match.date ASC, match.match_id';
                $data['fixture_bets_players'] = $this->db->select($select)
                                                         ->from($this->config->item('bet', 'table'))
                                                         ->join('match', 'bet.match_id = match.match_id', 'left')
                                                         ->join('fixture', 'match.fixture_id = fixture.fixture_id', 'left')
                                                         ->join('user', 'bet.user_id = user.user_id', 'left')
                                                         ->where_in('bet.user_id', $filters['bets_of_players'])
                                                         ->order_by($order)
                                                         ->get()
                                                         ->result();
                $fixture_bets_players = array();
                $different_players = array();
                $player_id = 0;
                foreach ($data['fixture_bets_players'] as $key => $fixture_bet_players) {
                    if ($fixture_bet_players->user_id != $player_id) {
                        $player_id = $fixture_bet_players->user_id;
                        $different_players[$player_id] = ($fixture_bet_players->user_name === '') ? $this->lang->line('anonymous').$player_id : $fixture_bet_players->user_name;
                    }
                    $fixture_bets_players[$fixture_bet_players->user_id][$fixture_bet_players->match_id] = $fixture_bet_players;
                }
                $data['fixture_bets_players'] = $fixture_bets_players;
            }
            $my_fixture_bets = array();
            foreach ($data['my_fixture_bets'] as $key => $fixture_bet) {
                $my_fixture_bets[$fixture_bet->match_id] = $fixture_bet;
            }
            $data['my_fixture_bets'] = $my_fixture_bets;
            $data['different_players'] = empty($different_players) ? array() : $different_players;
        } else {
            $data['info'] = $this->lang->line('no_match_for_fixture');
        }

        // Récupération du message d'information pour les pronostics des autres joueurs
        $language = $this->session->user->language;
        if (empty($language)) {
            $language = 'french';
        }
        $this->load->model('message_model');
        $data['bet_of_message'] = $this->message_model->get_message('bet-of-message');
        if ($data['bet_of_message'] !== '') {
            $data['bet_of_message'] = $data['bet_of_message'][0]->{$language.'_content'};
        }
        $data['bet_of_message'] = html_entity_decode($data['bet_of_message']);

        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('bets/edit', $data);
            $this->load->view('templates/footer', $data);
        } else if (isset($post['submit-bets'])) {
            // Cas du clic sur "Retour"
            if ($post['submit-bets'] == $this->lang->line('back')) {
                redirect(site_url('bets'), 'location');
                exit;
            }
            // Suppression des paris déjà entrés pour la journée
            $query = 'DELETE bet ';
            $query.= 'FROM `' . $this->config->item('bet', 'table') . '` ';
            $query.= 'JOIN `' . $this->config->item('match', 'table') . '` ON bet.match_id = `match`.match_id ';
            $query.= 'WHERE user_id = ' . $this->session->userdata('user_id') . ' ';
            $query.= 'AND `match`.result IS NULL ';
            $query.= 'AND bet.match_id IN (' . implode(', ', array_keys($data['matches'])) . ')';
            $this->db->query($query);
            // Update des paris de l'utilisateur pour la journée
            $bets = array();
            $element = 0;
            foreach ($post as $key => $post_element) {
                if ($key == 'submit-bets') {
                    continue;
                }
                if ($element === 0) {
                    // Id du match modifié
                    $match_id = explode('_', $key)[1];
                    // Score de la première équipe
                    $team1_score = ($post_element == '') ? NULL : $post_element;
                    ++$element;
                } else {
                    // Score de la deuxième équipe
                    $team2_score = ($post_element == '') ? NULL : $post_element;
                    $resultat = NULL;
                    if (is_null($team1_score) || is_null($team2_score)) {
                        $element = 0;
                        continue;
                    } else if ($team1_score > $team2_score) {
                        $resultat = '1';
                    } else if ($team1_score < $team2_score) {
                        $resultat = '2';
                    } else {
                        if (!is_null($team1_score) && !is_null($team1_score)) {
                            $resultat = 'N';
                        }
                    }
                    // On vérifie que le score a été entré pour les 2 équipes et que la date du match n'est pas passée
                    if (!is_null($resultat) &&
                        date('Y-m-d H:i:s') < $data['matches'][$match_id]) {
                        $bets[] = array(
                            'user_id' => $this->session->userdata('user_id'),
                            'match_id' => $match_id,
                            'result' => $resultat,
                            'team1_score' => $team1_score,
                            'team2_score' => $team2_score,
                            'date' => date('Y-m-d H:i:s'),
                        );
                    }
                    $element = 0;
                }
            }
            if (!empty($bets)) {
                $this->db->insert_batch('bet', $bets);
            }

            $this->session->set_flashdata('success', $this->lang->line('bets_successful_edition'));
            redirect(site_url('bets'), 'location');
            exit;
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('bets/edit', $data);
            $this->load->view('templates/footer', $data);
        }
    }
}
