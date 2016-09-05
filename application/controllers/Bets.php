<?php

class Bets extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('bet_model');
    }

    public function index()
    {
        if (!user_can('view_bets')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Journées';

        $select = 'fixture_id, fixture_name, championship.name AS championship_name';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = 'championship_name ASC, cast(fixture_name AS UNSIGNED) ASC';
        $data['fixtures'] = $this->db->select($select)
                                     ->from($this->config->item('fixture', 'table'))
                                     ->where($where)
                                     ->join('championship', 'championship.championship_id = fixture.fixture_championship_id', 'left')
                                     ->limit($nb, $debut)
                                     ->order_by($order)
                                     ->get()
                                     ->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('bets/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit($fixture_id = 0)
    {
        if (!user_can('edit_bet')) {
            redirect(site_url(), 'location');
            exit;
        }

        if ($fixture_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = $this->lang->line('add_edit_bet');

        $data['fixture_id'] = $fixture_id;

        // Liste des matchs de la journée
        $select = 'championship.name AS championship_name,
                   fixture_name,
                   t1.team_id AS t1_id,
                   t2.team_id AS t2_id,
                   t1.name AS team1,
                   t2.name AS team2,
                   match.date,
                   match.match_id';
        $where = array(
            'fixture.fixture_id' => $fixture_id,
        );
        $nb = NULL;
        $debut = NULL;
        $order = 'date ASC, match.match_id';
        $data['fixture_matches'] = $this->db->select($select)
                                            ->from($this->config->item('fixture', 'table'))
                                            ->join('match', 'fixture.fixture_id = match.fixture_id', 'left')
                                            ->join('championship', 'fixture.fixture_championship_id = championship.championship_id', 'left')
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
                $data['matches'][] = $fixture_match->match_id;
            }

            // Liste des paris de l'utilisateur pour la journée
            $select = 'bet.match_id,
                       bet.team1_score,
                       bet.team2_score';
            $where = array(
                'bet.user_id' => $this->session->userdata['user']->user_id,
            );
            $nb = NULL;
            $debut = NULL;
            $order = 'match.date ASC, match.match_id';
            $data['fixture_bets'] = $this->db->select($select)
                                             ->from($this->config->item('bet', 'table'))
                                             ->join('match', 'bet.match_id = match.match_id', 'left')
                                             ->join('fixture', 'match.fixture_id = fixture.fixture_id', 'left')
                                             ->where($where)
                                             ->limit($nb, $debut)
                                             ->order_by($order)
                                             ->get()
                                             ->result();
            $fixture_bets = array();
            foreach ($data['fixture_bets'] as $key => $fixture_bet) {
                $fixture_bets[$fixture_bet->match_id] = $fixture_bet;
            }
            $data['fixture_bets'] = $fixture_bets;
        } else {
            $data['info'] = $this->lang->line('no_match_for_fixture');
        }

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('bets/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // Cas du clic sur "Retour"
            if ($post['submit'] == $this->lang->line('back')) {
                redirect(site_url('bets'), 'location');
                exit;
            }
            // Suppression des paris déjà entrés pour la journée
            $where = array(
                'user_id' => $this->session->userdata['user']->user_id,
            );
            $this->db->where($where)
                     ->where_in('match_id', $data['matches'])
                     ->delete($this->config->item('bet', 'table'));
            // Update des paris de l'utilisateur pour la journée
            $bets = array();
            $element = 0;
            foreach ($post as $key => $post_element) {
                if ($key == 'submit') {
                    continue;
                }
                if ($element === 0) {
                    // Id du match modifié
                    $match_id = explode('_', $key)[1];
                    // Résultat de la première équipe
                    $team1_score = ($post_element == '') ? NULL : $post_element;
                    ++$element;
                } else {
                    // Résultat de la deuxième équipe
                    $team2_score = ($post_element == '') ? NULL : $post_element;
                    $resultat = NULL;
                    if (is_null($team1_score) || is_null($team2_score)) {
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
                    if (!is_null($resultat)) {
                        $bets[] = array(
                            'user_id' => $this->session->userdata['user']->user_id,
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

            $this->session->set_flashdata('success', $this->lang->line('fixture_matches_successful_edition'));
            redirect(site_url('bets'), 'location');
            exit;
        }
    }
}
