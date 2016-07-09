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

        $date['championships'] = $this->championship_model->read();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/championships/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
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
                    'rules' => 'trim|required|is_int',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'is_int' => $this->lang->line('must_be_year_field'),
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
                    'acl' => 'user',
                    'active' => '1',
                    'email' => $post['email'],
                    'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                    'add_date' => date('Y-m-d H:i:s'),
                    'last_connection' => date('Y-m-d H:i:s'),
                );
                $this->user_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('account_successful_creation'));
                $to_profile = TRUE;
                $this->login($to_profile);
            }
        }
    }
}
