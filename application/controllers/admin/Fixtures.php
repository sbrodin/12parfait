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
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Journées';

        $this->session->unset_userdata('championship');

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
        $this->load->view('admin/fixtures/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
        if (!user_can('add_fixture')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Ajouter une journée';

        $this->load->model('championship_model');
        $select = '*';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = 'name ASC';
        $data['championships'] = $this->championship_model->read($select, $where, $nb, $debut, $order);

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/fixtures/add', $data);
            $this->load->view('templates/footer', $data);
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
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/fixtures/add', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $donnees_echapees = array(
                    'fixture_name' => $post['fixture_name'],
                    'fixture_championship_id' => $post['championship'],
                );
                $this->fixture_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('fixture_successful_creation'));
                if (!empty($this->session->userdata['championship'])) {
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
            redirect(site_url(), 'location');
            exit;
        }

        if ($fixture_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Editer une journée';

        $data['fixture_id'] = $fixture_id;

        // Liste des matchs de la journée
        $select = 'championship.name AS championship_name, fixture_name, t1.team_id AS t1_id, t2.team_id AS t2_id, t1.name AS team1, t2.name AS team2, date';
        $where = array(
            'fixture.fixture_id' => $fixture_id,
        );
        $nb = NULL;
        $debut = NULL;
        $order = 'date ASC';
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
        } else {
            $data['info'] = $this->lang->line('complete_fixture');
        }

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/fixtures/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // S'il y a des doublons dans les équipes, on affiche un message d'erreur
            if ($post !== array_unique($post)) {
                $data['error_duplicate'] = $this->lang->line('duplicate_teams');
            }
            // $team = 1;
            // $current_team_id = 0;
            // foreach ($post as $key => $team_id) {
            //     echo $team_id;
            //     // Si on est sur le même match
            //     if ($team === 1) {
            //         $current_team_id = $team_id;
            //         echo ' - ';
            //         ++$team;
            //     } else {
            //         if ($current_team_id == $team_id) {
            //             $data['error_same_team'] = $this->lang->line('error_same_team');
            //         }
            //         echo '<br/>';
            //         $team = 1;
            //     }
            // }
            if (isset($data['error_msg'])) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/fixtures/edit', $data);
                $this->load->view('templates/footer', $data);
            } else {
                foreach ($post as $key => $team_id) {
                    echo $team_id;
                    // Si on est sur le même match
                    if ($team === 1) {
                        $current_team_id = $team_id;
                        echo ' - ';
                        ++$team;
                    } else {
                        if ($current_team_id == $team_id) {
                            $data['error_same_team'] = $this->lang->line('error_same_team');
                        }
                        echo '<br/>';
                        $team = 1;
                    }
                }
                exit;
                $where = array('fixture_id' => $fixture_id);
                $donnees_echapees = array(
                    'name' => $post['fixture_name'],
                );
                $this->fixture_model->update($where, $donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('fixture_successful_creation'));
                redirect(site_url('admin/fixtures'), 'location');
                exit;
            }
        }
    }
}
