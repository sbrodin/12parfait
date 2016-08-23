<?php

class Matches extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('match_model');
    }

    public function index()
    {
        $data = array();
        $data['title'] = 'Admin - Matchs';

        $this->load->model('championship_model');
        $select = '*';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = 'name ASC';
        $data['championships'] = $this->championship_model->read($select, $where, $nb, $debut, $order);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/matches/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
        $data = array();
        $data['title'] = 'Admin - Ajouter un match';

        $this->load->model('team_model');
        $select = 'team.team_id, team.name AS team_name, championship.name AS championship_name, fixture.fixture_name';
        $where = array(
            'championship_team.championship_id' => $this->session->userdata['championship'],
            'fixture.fixture_id' => $this->session->userdata['fixture'],
        );
        $nb = NULL;
        $debut = NULL;
        $order = '';
        $data['teams'] = $this->db->select($select)
                                  ->from($this->config->item('team', 'table'))
                                  ->join('championship_team', 'championship_team.team_id = team.team_id', 'left')
                                  ->join('championship', 'championship_team.championship_id = championship.championship_id', 'left')
                                  ->join('fixture', 'championship.championship_id = fixture.fixture_championship_id', 'left')
                                  ->where($where)
                                  ->limit($nb, $debut)
                                  ->order_by($order)
                                  ->get()
                                  ->result();

        $data['championship_name'] = $data['teams'][0]->championship_name;
        $data['fixture_name'] = $data['teams'][0]->fixture_name;

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/matches/add', $data);
            $this->load->view('templates/footer', $data);
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
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/matches/add', $data);
                $this->load->view('templates/footer', $data);
            } else {
                var_dump('expression');
                exit;
                $this->session->unset_userdata('championship');
                $this->session->unset_userdata('fixture');
                redirect(site_url('admin/matches/fixture'), 'location');
                exit;
            }
        }
    }

    public function championship()
    {
        $data = array();
        $data['title'] = 'Admin - Ajouter un match';

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
            $this->load->view('admin/matches/championship', $data);
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
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/matches/championship', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $this->session->set_userdata('championship', $post['championship']);
                redirect(site_url('admin/matches/fixture'), 'location');
                exit;
            }
        }
    }

    public function fixture()
    {
        $data = array();
        $data['title'] = 'Admin - Ajouter un match';

        $this->load->model('fixture_model');
        $select = 'fixture_id, fixture_name, fixture_championship_id, championship.name AS championship_name';
        $where = array('fixture_championship_id' => $this->session->userdata['championship']);
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

        $data['championship'] = $data['fixtures'][0]->championship_name;

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/matches/fixture', $data);
            $this->load->view('templates/footer', $data);
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
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('admin/matches/fixture', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $this->session->set_userdata('fixture', $post['fixture']);
                redirect(site_url('admin/matches/add'), 'location');
                exit;
            }
        }
    }
}
