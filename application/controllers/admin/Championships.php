<?php

class Championships extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('championship_model');
    }

    public function index()
    {
        $data = array();
        $data['title'] = 'Admin - Championnats';

        $data['championships'] = $this->championship_model->read();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/championships/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
        if (!user_can('add_championship')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Ajouter un championnat';

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/championships/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'championship_name',
                    'label' => $this->lang->line('championship_name'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'sport',
                    'label' => $this->lang->line('sport'),
                    'rules' => 'trim|strtolower|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'country',
                    'label' => $this->lang->line('country'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'level',
                    'label' => $this->lang->line('level'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'year',
                    'label' => $this->lang->line('year'),
                    'rules' => 'trim|required|greater_than_equal_to[2016]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'greater_than_equal_to' => $this->lang->line('must_be_year_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('admin/championships/add');
                $this->load->view('templates/footer', $data);
            } else {
                $donnees_echapees = array(
                    'name' => $post['championship_name'],
                    'sport' => $post['sport'],
                    'country' => $post['country'],
                    'level' => $post['level'],
                    'year' => $post['year'],
                );
                $this->championship_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('championship_successful_creation'));
                redirect(site_url('admin/championships'), 'location');
                exit;
            }
        }
    }

    public function edit($championship_id = 0)
    {
        if (!user_can('edit_championship')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = 'Admin - Editer un championnat';

        $select = '*';
        $where = array(
            'championship_id' => $championship_id,
        );
        $championship = $this->championship_model->read($select, $where);
        if (!$championship) {
            redirect(site_url(), 'location');
            exit;
        } else {
            $championship = $championship[0];
        }
        $data['championship'] = $championship;

        $this->load->model('team_model');
        $select = '*';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = ('name ASC');
        $data['teams'] = $this->team_model->read($select, $where, $nb, $debut, $order);

        $this->load->model('championship_team_model');
        $select = 'team_id';
        $where = array(
            'championship_id' => $championship_id,
        );
        $data['championship_teams'] = $this->championship_team_model->read($select, $where);
        $championship_teams = array();
        foreach ($data['championship_teams'] as $key => $team_id) {
            $championship_teams[$team_id->team_id] = $team_id->team_id;
        }
        $data['championship_teams'] = $championship_teams;

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/championships/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'championship_name',
                    'label' => $this->lang->line('championship_name'),
                    'rules' => 'trim|ucfirst|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('admin/championships/edit', $data);
                $this->load->view('templates/footer', $data);
            } else {
                // Update du championnat
                $where = array('championship_id' => $championship_id);
                $donnees_echapees = array(
                    'name' => $post['championship_name'],
                    'sport' => $post['sport'],
                    'country' => $post['country'],
                    'level' => $post['level'],
                    'year' => $post['year'],
                );
                $this->championship_model->update($where, $donnees_echapees);

                // Update des équipes du championnat
                // Suppression des équipes déjà présentes
                $where = array('championship_id' => $championship_id);
                $this->championship_team_model->delete($where);
                // Ajout des équipes
                $championship_team = array();
                foreach ($post['teams'] as $key => $team_id) {
                    $championship_team[] = array(
                        'championship_id' => $championship_id,
                        'team_id' => $team_id,
                    );
                }
                $this->db->insert_batch('championship_team', $championship_team);

                $this->session->set_flashdata('success', $this->lang->line('championship_successful_edition'));
                redirect(site_url('admin/championships'), 'location');
                exit;
            }
        }
    }
}
