<?php

class Matches extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('match_model');
    }

    public function index()
    {
        if (!user_can('view_championships')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('matches_admin');

        $this->load->model('championship_model');
        $select = '*';
        $where = array();
        $nb = null;
        $debut = null;
        $order = 'name ASC';
        $data['championships'] = $this->championship_model->read($select, $where, $nb, $debut, $order);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('admin/matches/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        if (!user_can('add_match')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('add_match');

        // Matchs déjà enregistrés pour la journée
        $select = 't1.team_id AS t1_id, t2.team_id AS t2_id, t1.name AS team1, t2.name AS team2, date';
        $where = array(
            'fixture_id' => $this->session->userdata('fixture'),
        );
        $nb = null;
        $debut = null;
        $order = 'date ASC';
        $data['matches_fixture'] = $this->db->select($select)
                                            ->from($this->config->item('match', 'table'))
                                            ->join('team t1', 'match.team1_id = t1.team_id', 'inner')
                                            ->join('team t2', 'match.team2_id = t2.team_id', 'inner')
                                            ->where($where)
                                            ->limit($nb, $debut)
                                            ->order_by($order)
                                            ->get()
                                            ->result();
        // On supprime les équipes déjà utilisées pour cette journée
        $already_set_teams = array();
        if(!empty($data['matches_fixture'])) {
            foreach ($data['matches_fixture'] as $key => $match_fixture) {
                $already_set_teams[] = $match_fixture->t1_id;
                $already_set_teams[] = $match_fixture->t2_id;
            }
        }

        // Equipes pour le choix des confrontations
        $this->load->model('team_model');
        $select = 'team.team_id, team.name AS team_name, championship.name AS championship_name, fixture.name AS fixture_name';
        $where = array(
            'championship_team.championship_id' => $this->session->userdata('championship'),
            'fixture.fixture_id' => $this->session->userdata('fixture'),
        );
        $where_not_in = array(
            'team.team_id', $already_set_teams,
        );
        $nb = null;
        $debut = null;
        $order = '';
        $data['teams'] = $this->db->select($select)
                                  ->from($this->config->item('team', 'table'))
                                  ->join('championship_team', 'championship_team.team_id = team.team_id', 'left')
                                  ->join('championship', 'championship_team.championship_id = championship.championship_id', 'left')
                                  ->join('fixture', 'championship.championship_id = fixture.championship_id', 'left')
                                  ->where($where);
        if (!empty($already_set_teams)) {
            $data['teams'] = $data['teams']->where_not_in('team.team_id', $already_set_teams);
        }
        $data['teams'] = $data['teams']->limit($nb, $debut)
                                       ->order_by($order)
                                       ->distinct()
                                       ->get()
                                       ->result();

        if (!empty($data['teams'])) {
            $data['championship_name'] = $data['teams'][0]->championship_name;
            $data['fixture_name'] = $data['teams'][0]->fixture_name;
        } else {
            $data['info'] = $this->lang->line('complete_fixture');
        }

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('admin/matches/add', $data);
            $this->load->view('templates/footer');
        } else {
            $rules = array(
                array(
                    'field' => 'team1',
                    'label' => $this->lang->line('team1'),
                    'rules' => 'trim|required|differs[team2]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'differs' => $this->lang->line('must_differ_field'),
                    ),
                ),
                array(
                    'field' => 'team2',
                    'label' => $this->lang->line('team2'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'match_date',
                    'label' => $this->lang->line('match_date'),
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
                $this->load->view('admin/matches/add', $data);
                $this->load->view('templates/footer');
            } else {
                $date = date_create_from_format('d/m/Y H:i', $post['match_date']);
                $date_formatted = $date->format('Y-m-d H:i:s');
                $donnees_echapees = array(
                    'team1_id' => $post['team1'],
                    'team2_id' => $post['team2'],
                    'date' => $date_formatted,
                    'fixture_id' => $this->session->userdata('fixture'),
                );
                $this->match_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('match_successful_creation'));
                redirect(site_url('onarie/matches/add'), 'location');
                exit;
            }
        }
    }

    public function championship()
    {
        if (!user_can('add_match')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('add_match');

        $this->load->model('championship_model');
        $select = '*';
        $where = array();
        $nb = null;
        $debut = null;
        $order = 'championship_id DESC';
        $data['championships'] = $this->championship_model->read($select, $where, $nb, $debut, $order);

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('admin/matches/championship', $data);
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
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('admin/matches/championship', $data);
                $this->load->view('templates/footer');
            } else {
                $this->session->set_userdata('championship', $post['championship']);
                redirect(site_url('onarie/matches/fixture'), 'location');
                exit;
            }
        }
    }

    public function fixture()
    {
        if (!user_can('add_match')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('add_match');

        $this->load->model('fixture_model');
        $select = 'fixture_id, fixture.name AS fixture_name, championship.championship_id, championship.name AS championship_name';
        $where = array('championship.championship_id' => $this->session->userdata('championship'));
        $nb = null;
        $debut = null;
        $order = 'championship_name ASC, fixture.fixture_id ASC';
        $data['fixtures'] = $this->db->select($select)
                                     ->from($this->config->item('fixture', 'table'))
                                     ->where($where)
                                     ->join('championship', 'championship.championship_id = fixture.championship_id', 'left')
                                     ->limit($nb, $debut)
                                     ->order_by($order)
                                     ->get()
                                     ->result();

        if (!empty($data['fixtures'])) {
            $data['championship'] = $data['fixtures'][0]->championship_name;
        } else {
            $data['info'] = $this->lang->line('no_fixture_for_championship');
        }

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('admin/matches/fixture', $data);
            $this->load->view('templates/footer');
        } else {
            $rules = array(
                array(
                    'field' => 'fixture',
                    'label' => $this->lang->line('fixture'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('admin/matches/fixture', $data);
                $this->load->view('templates/footer');
            } else {
                $this->session->set_userdata('fixture', $post['fixture']);
                redirect(site_url('onarie/matches/add'), 'location');
                exit;
            }
        }
    }

    public function edit($championship_id = 0)
    {
        if (!user_can('edit_championship')) {
            show_404();
        }

        if ($championship_id === 0) {
            redirect(site_url('onarie/matches'), 'location');
            exit;
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('edit_championship');

        // Matchs enregistrés pour le championnat
        $select = 'championship.championship_id,
                   championship.name AS championship_name,
                   fixture.name AS fixture_name,
                   fixture.fixture_id,
                   t1.team_id AS t1_id,
                   t2.team_id AS t2_id,
                   t1.name AS team1,
                   t2.name AS team2';
        $where = array(
            'championship.championship_id' => $championship_id,
        );
        $nb = null;
        $debut = null;
        $order = 'date ASC';
        $data['matches_fixtures'] = $this->db->select($select)
                                             ->from($this->config->item('championship', 'table'))
                                             ->join('fixture', 'championship.championship_id = fixture.championship_id', 'left')
                                             ->join('match', 'fixture.fixture_id = match.fixture_id', 'left')
                                             ->join('team t1', 'match.team1_id = t1.team_id', 'inner')
                                             ->join('team t2', 'match.team2_id = t2.team_id', 'inner')
                                             ->where($where)
                                             ->limit($nb, $debut)
                                             ->order_by($order)
                                             ->get()
                                             ->result();

        if (!empty($data['matches_fixtures'])) {
            $data['championship_name'] = $data['matches_fixtures'][0]->championship_name;
        } else {
            $data['info'] = $this->lang->line('no_fixture_for_championship');
        }

        $this->session->set_userdata('championship', $championship_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('admin/matches/edit', $data);
        $this->load->view('templates/footer');
    }
}
