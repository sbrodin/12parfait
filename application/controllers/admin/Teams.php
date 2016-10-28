<?php

class Teams extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('team_model');
    }

    public function index()
    {
        if (!user_can('view_teams')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = $this->lang->line('admin') . ' - ' . $this->lang->line('teams_admin');

        $select = 'team_id, name, short_name';
        $where = array();
        $nb = NULL;
        $debut = NULL;
        $order = 'name ASC';
        $data['teams'] = $this->team_model->read($select, $where, $nb, $debut, $order);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/teams/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
        if (!user_can('add_team')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = $this->lang->line('admin') . ' - ' . $this->lang->line('add_team');

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/teams/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'team_name',
                    'label' => $this->lang->line('team_name'),
                    'rules' => 'trim|required|is_unique[team.name]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'is_unique' => $this->lang->line('already_in_db_field'),
                    ),
                ),
                array(
                    'field' => 'team_short_name',
                    'label' => $this->lang->line('team_short_name'),
                    'rules' => 'trim|required|max_length[5]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'max_length' => $this->lang->line('too_long_5_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/teams/add', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $donnees_echapees = array(
                    'name' => $post['team_name'],
                    'short_name' => $post['team_short_name'],
                );
                $this->team_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('team_successful_creation'));
                redirect(site_url('admin/teams'), 'location');
                exit;
            }
        }
    }

    public function edit($team_id = 0)
    {
        if (!user_can('edit_team')) {
            redirect(site_url(), 'location');
            exit;
        }

        if ($team_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = $this->lang->line('admin') . ' - ' . $this->lang->line('edit_team');

        $select = 'team_id, name, short_name';
        $where = array(
            'team_id' => $team_id,
        );
        $team = $this->team_model->read($select, $where);
        if (!$team) {
            redirect(site_url(), 'location');
            exit;
        } else {
            $team = $team[0];
        }
        $data['team'] = $team;

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/teams/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'team_name',
                    'label' => $this->lang->line('team_name'),
                    'rules' => 'trim|ucfirst|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'team_short_name',
                    'label' => $this->lang->line('team_short_name'),
                    'rules' => 'trim|required|max_length[5]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'max_length' => $this->lang->line('too_long_5_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('admin/teams/edit', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $where = array('team_id' => $team_id);
                $donnees_echapees = array(
                    'name' => $post['team_name'],
                    'short_name' => $post['team_short_name'],
                );
                $this->team_model->update($where, $donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('team_successful_edition'));
                redirect(site_url('admin/teams'), 'location');
                exit;
            }
        }
    }
}
