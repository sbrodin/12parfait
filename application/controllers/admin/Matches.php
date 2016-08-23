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
        $order = ('name ASC');
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

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/matches/add', $data);
        $this->load->view('templates/footer', $data);
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
        $order = ('name ASC');
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
        $select = 'fixture_id, fixture_name, championship.name AS championship_name';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = ('championship_name ASC, cast(fixture_name AS UNSIGNED) ASC');
        $data['fixtures'] = $this->db->select($select)
                                     ->from($this->config->item('fixture', 'table'))
                                     ->where($where)
                                     ->join('championship', 'championship.championship_id = fixture.fixture_championship_id', 'left')
                                     ->limit($nb, $debut)
                                     ->order_by($order)
                                     ->get()
                                     ->result();

        foreach ($data['fixtures'] as $key => $fixture) {
            $fixture->complete_name = $fixture->championship_name . ' - ' . $fixture->fixture_name;
        }

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
                redirect(site_url('admin/matches/fixture'), 'location');
                exit;
            }
        }
    }
}
