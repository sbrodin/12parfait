<?php

class Fixtures extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fixture_model');
    }

    public function index()
    {
        if (!user_can('view_fixtures')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('fixtures_admin');

        $select = 'fixture_id, fixture.name AS fixture_name, championship.name AS championship_name, fixture.status';
        $where = array('championship.status' => 'open');
        $nb = null;
        $debut = null;
        $order = 'championship_name ASC, fixture_id';
        $data['fixtures'] = $this->db->select($select)
                                     ->from($this->config->item('fixture', 'table'))
                                     ->where($where)
                                     ->join('championship', 'championship.championship_id = fixture.championship_id', 'left')
                                     ->limit($nb, $debut)
                                     ->order_by($order)
                                     ->get()
                                     ->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('admin/fixtures/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        if (!user_can('add_fixture')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('add_fixture');

        $this->load->model('championship_model');
        $select = '*';
        $where = array();
        $nb = null;
        $debut = null;
        $order = 'name ASC';
        $data['championships'] = $this->championship_model->read($select, $where, $nb, $debut, $order);

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('admin/fixtures/add', $data);
            $this->load->view('templates/footer');
        } else {
            $rules = array(
                array(
                    'field' => 'championship',
                    'label' => $this->lang->line('championship'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'fixture_name',
                    'label' => $this->lang->line('fixture_name'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('admin/fixtures/add', $data);
                $this->load->view('templates/footer');
            } else {
                $donnees_echapees = array(
                    'name' => $post['fixture_name'],
                    'championship_id' => $post['championship'],
                );
                $this->fixture_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('fixture_successful_creation'));
                if (!empty($this->session->userdata('championship'))) {
                    $this->session->set_userdata('fixture', $this->db->insert_id());
                    redirect(site_url('admin/matches/add'), 'location');
                    exit;
                } else {
                    $this->session->set_userdata('championship', $post['championship']);
                    redirect(site_url('admin/fixtures/add'), 'location');
                    exit;
                }
            }
        }
    }

    public function edit($fixture_id = 0)
    {
        if (!user_can('edit_fixture')) {
            show_404();
        }

        if ($fixture_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('edit_fixture');

        $data['fixture_id'] = $fixture_id;

        // Liste des matchs de la journée
        $select = 'championship.name AS championship_name,
                   fixture.name AS fixture_name,
                   match_id,
                   t1.team_id AS t1_id,
                   t2.team_id AS t2_id,
                   t1.name AS team1,
                   t2.name AS team2,
                   date';
        $where = array(
            'fixture.fixture_id' => $fixture_id,
        );
        $nb = null;
        $debut = null;
        $order = 'date ASC';
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

            // Liste des équipes
            $data['teams'] = array();
            foreach ($data['fixture_matches'] as $key => $fixture_match) {
                $data['teams'][$fixture_match->t1_id] = $fixture_match->team1;
                $data['teams'][$fixture_match->t2_id] = $fixture_match->team2;
            }
            asort($data['teams']);
        } else {
            $data['info'] = $this->lang->line('no_match_for_fixture');
        }

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('admin/fixtures/edit', $data);
            $this->load->view('templates/footer');
        } else {
            // S'il y a des doublons dans les équipes, on affiche un message d'erreur
            if ($post !== array_unique($post)) {
                $data['error_duplicate'] = $this->lang->line('duplicate_teams');
            }
            if (isset($data['error_msg'])) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('admin/fixtures/edit', $data);
                $this->load->view('templates/footer');
            } else {
                // Update des matchs de la journée
                $this->load->model('match_model');
                $matches = array();
                $element = 0;
                foreach ($post as $key => $post_element) {
                    if ($element === 0) {
                        // Si on est sur la date
                        $date = date_create_from_format('d/m/Y H:i', $post_element);
                        $date_formatted = $date->format('Y-m-d H:i');
                        ++$element;
                    } else if ($element === 1) {
                        $team1_id = $post_element;
                        ++$element;
                    } else if ($element === 2) {
                        $team2_id = $post_element;
                        ++$element;
                    } else {
                        $match_id = $post_element;
                        $matches[$match_id] = array(
                            'team1_id' => $team1_id,
                            'team2_id' => $team2_id,
                            'date' => $date_formatted,
                            'fixture_id' => $fixture_id,
                        );
                        $element = 0;
                    }
                }
                foreach ($matches as $match_id => $match_info) {
                    $where = array(
                        'match_id' => $match_id,
                        'fixture_id' => $fixture_id,
                    );
                    $this->match_model->update($where, $match_info);
                }

                $this->session->set_flashdata('success', $this->lang->line('fixture_successful_edition'));
                redirect(site_url('admin/fixtures'), 'location');
                exit;
            }
        }
    }

    public function results($fixture_id = 0)
    {
        if (!user_can('edit_fixture_results')) {
            show_404();
        }

        if ($fixture_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('edit_fixture');

        $data['fixture_id'] = $fixture_id;
        $this->session->set_userdata('fixture', $fixture_id);

        // Liste des matchs de la journée
        $select = 'fixture.championship_id,
                   championship.name AS championship_name,
                   fixture.name AS fixture_name,
                   t1.team_id AS t1_id,
                   t2.team_id AS t2_id,
                   t1.name AS team1,
                   t2.name AS team2,
                   match.date,
                   match.match_id,
                   match.result,
                   match.team1_score,
                   match.team2_score';
        $where = array(
            'fixture.fixture_id' => $fixture_id,
        );
        $nb = null;
        $debut = null;
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
            $data['championship_id'] = $data['fixture_matches'][0]->championship_id;
            $data['fixture_name'] = $data['fixture_matches'][0]->fixture_name;

            // Liste des équipes
            $data['teams'] = array();
            foreach ($data['fixture_matches'] as $key => $fixture_match) {
                $data['teams'][$fixture_match->t1_id] = $fixture_match->team1;
                $data['teams'][$fixture_match->t2_id] = $fixture_match->team2;
            }
            asort($data['teams']);
        } else {
            $data['info'] = $this->lang->line('no_match_for_fixture');
        }

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('admin/fixtures/results', $data);
            $this->load->view('templates/footer');
        } else {
            // Cas du clic sur "Retour"
            if ($post['submit'] == $this->lang->line('back')) {
                redirect(site_url('admin/fixtures'), 'location');
                exit;
            }
            $this->load->model('match_model');
            // Update des résultats des matchs de la journée
            $results = array();
            $element = 0;
            foreach ($post as $key => $post_element) {
                if ($element === 0) {
                    // Id du match modifié
                    $match_id = explode('_', $key)[1];
                    // Score de la première équipe
                    $team1_id = explode('_', $key)[2];
                    $team1_score = ($post_element == '') ? null : $post_element;
                    ++$element;
                } else {
                    // Score de la deuxième équipe
                    $team2_id = explode('_', $key)[2];
                    $team2_score = ($post_element == '') ? null : $post_element;
                    $resultat = null;
                    if ($team1_score > $team2_score) {
                        $resultat = '1';
                    } else if ($team1_score < $team2_score) {
                        $resultat = '2';
                    } else {
                        if (!is_null($team1_score) && !is_null($team1_score)) {
                            $resultat = 'N';
                        }
                    }
                    $results[$match_id] = array(
                        'team1_id' => $team1_id,
                        'team2_id' => $team2_id,
                        'result' => $resultat,
                        'team1_score' => $team1_score,
                        'team2_score' => $team2_score,
                    );
                    $element = 0;
                }
            }
            foreach ($results as $match_id => $result) {
                $where = array('match_id' => $match_id);
                $donnees_echapees = $result;
                $this->match_model->update($where, $donnees_echapees);
            }
            // Mise à jour du statut de la journée à "en cours" (ongoing)
            $donnees_echapees = array('status' => 'ongoing');
            $this->fixture_model->update(array("fixture_id" => $fixture_id), $donnees_echapees);

            // Mise à jour des scores des joueurs
            Score_calculator($fixture_id);

            $this->session->set_flashdata('success', $this->lang->line('fixture_matches_successful_edition'));
            redirect(site_url('admin/fixtures'), 'location');
            exit;
        }
    }

    /**
    * Fonction de fermeture d'une journée.
    * @param $fixture_id Id de la journée à fermer
    */
    public function close_fixture($fixture_id) {
        // Gestion des droits de fermeture
        if (!user_can('close_fixture')) {
            show_404();
        }

        $donnees_echapees = array('status' => 'close');

        $this->fixture_model->update(array("fixture_id" => $fixture_id), $donnees_echapees);

        redirect(site_url('admin/fixtures'), 'location');
        exit;
    }

    /**
    * Fonction d'ouverture d'une journée.
    * @param $fixture_id Id de la journée à ouvrir
    */
    public function open_fixture($fixture_id) {
        // Gestion des droits d'ouverture
        if (!user_can('open_fixture')) {
            show_404();
        }

        $donnees_echapees = array('status' => 'open');

        $this->fixture_model->update(array("fixture_id" => $fixture_id), $donnees_echapees);

        redirect(site_url('admin/fixtures'), 'location');
        exit;
    }
}
