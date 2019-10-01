<?php

class Championships extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('championship_model');
    }

    public function index()
    {
        if (!user_can('view_championships')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('championships');

        $select = '*';
        $where = array();
        $nb = null;
        $debut = null;
        $order = 'name ASC';
        $data['championships'] = $this->championship_model->read($select, $where, $nb, $debut, $order);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('admin/championships/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        if (!user_can('add_championship')) {
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('add_championship');

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('admin/championships/add', $data);
            $this->load->view('templates/footer');
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
                    'rules' => 'trim|required|greater_than_equal_to[2015]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'greater_than_equal_to' => $this->lang->line('must_be_year_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('admin/championships/add', $data);
                $this->load->view('templates/footer');
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
            show_404();
        }

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('edit_championship');

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
        if ($championship->country === 'france') {
            $level = 'local';
        } else {
            $level = 'national';
        }

        $this->load->model('team_model');
        $select = '*';
        $where = array(
            'level' => $level,
            'sport' => $championship->sport,
        );
        $nb = null;
        $debut = null;
        $order = 'name ASC';
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
            $this->load->view('templates/nav');
            $this->load->view('admin/championships/edit', $data);
            $this->load->view('templates/footer');
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
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('admin/championships/edit', $data);
                $this->load->view('templates/footer');
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

    /**
    * Fonction d'activation d'un championnat.
    * @param $championship_id Id du championnat à activer
    */
    public function activate($championship_id) {
        // Gestion des droits d'activation
        if (!user_can('activate_championship')) {
            show_404();
        }

        $donnees_echapees = array('status' => 'open');

        $this->championship_model->update(array("championship_id" => $championship_id), $donnees_echapees);

        redirect(site_url('admin/championships'), 'location');
        exit;
    }

    /**
    * Fonction de désactivation d'un championnat.
    * @param $championship_id Id du championnat à désactiver
    */
    public function deactivate($championship_id) {
        // Gestion des droits de désactivation
        if (!user_can('deactivate_championship')) {
            show_404();
        }

        $donnees_echapees = array('status' => 'close');

        $this->championship_model->update(array("championship_id" => $championship_id), $donnees_echapees);

        redirect(site_url('admin/championships'), 'location');
        exit;
    }

    /**
    * Fonction de suppression d'une équipe d'un championnat
    * @param $team_id Id de l'équipe à enlever
    * @param $championship_id Id du championnat concerné
    */
    public function del_team_from_championship($team_id, $championship_id) {
        // Gestion des droits de suppression
        if (!user_can('del_team_from_championship')) {
            show_404();
        }
        $this->load->model('championship_team_model');

        $where = array(
            'team_id' => $team_id,
            'championship_id' => $championship_id,
        );

        $this->championship_team_model->delete($where);

        if ($this->session->userdata('fixture')) {
            redirect(site_url('admin/fixtures/results/'.$this->session->userdata('fixture')), 'location');
            exit;
        } else {
            redirect(site_url('admin/championships'), 'location');
            exit;
        }
    }
}
