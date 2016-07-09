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
}
