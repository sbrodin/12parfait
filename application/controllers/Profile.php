<?php

/**
  * Cette classe définit les règles pour l'affichage du profil
  */
class Profile extends MY_Controller {

    /**
    * Constructeur qui appelle les models utilisés par le controller
    */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    /**
    * Fonction d'affichage de la page de profil.
    */
    public function index() {
        $data = array();
        $data['title'] = $this->lang->line('profile');

        $data['user'] = $this->session->userdata('user');
        $add_date = new DateTime($data['user']->add_date);
        $data['user']->add_date_formatted = $add_date->format('d/m/Y');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
    * Fonction d'édition de la page de profil.
    */
    public function edit() {
        $data = array();
        $data['title'] = $this->lang->line('profile_edit');

        $post = $this->input->post();
        $data['user'] = $this->session->userdata('user');
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('profile/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if ($post['user_name'] !== $data['user']->user_name) {
                $rules = array(
                    array(
                        'field' => 'user_name',
                        'label' => $this->lang->line('user_name'),
                        'rules' => 'trim|is_unique[user.user_name]',
                        'errors' => array(
                            'is_unique' => $this->lang->line('already_in_db_field'),
                        ),
                    ),
                );
            } else {
                $rules = array();
            }
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('profile/edit', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $donnees_echapees = array(
                    'first_name' => $post['first_name'],
                    'last_name' => $post['last_name'],
                    'user_name' => $post['user_name'],
                    'language' => $post['language'],
                );

                $this->user_model->update(array("user_id" => $data['user']->user_id), $donnees_echapees);

                $this->session->set_userdata('user', $this->user_model->read('*', array("user_id" => $data['user']->user_id))[0]);

                $this->session->set_flashdata('success', $this->lang->line('profile_modified'));
                redirect(site_url('profile'), 'location');
                exit;
            }
        }
    }
}