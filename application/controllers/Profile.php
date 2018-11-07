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
        $this->load->model('log_model');
    }

    /**
    * Fonction d'affichage de la page de profil.
    */
    public function index() {
        save_log('profile', 'index', 'Affichage du profil');
        $data = array();
        $data['title'] = $this->lang->line('profile');

        $data['user'] = $this->session->userdata('user');
        $add_date = new DateTime($data['user']->add_date);
        $data['user']->add_date_formatted = $add_date->format('d/m/Y');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }

    /**
    * Fonction d'édition de la page de profil.
    */
    public function edit() {
        save_log('profile', 'edit');
        $data = array();
        $data['title'] = $this->lang->line('profile_edit');

        $post = $this->input->post();
        $data['user'] = $this->session->userdata('user');
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('profile/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $post['user_name'] = trim($post['user_name']);
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
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('profile/edit', $data);
                $this->load->view('templates/footer');
            } else {
                $donnees_echapees = array(
                    'first_name' => trim($post['first_name']),
                    'last_name' => trim($post['last_name']),
                    'user_name' => $post['user_name'],
                    // 'language' => $post['language'],
                );

                $this->user_model->update(array("user_id" => $data['user']->user_id), $donnees_echapees);

                $this->session->set_userdata('user', $this->user_model->read('*', array("user_id" => $data['user']->user_id))[0]);

                save_log('profile', 'edit', 'Modification du profil de l\'utilisateur : '.$this->session->user->user_id);
                $this->session->set_flashdata('success', $this->lang->line('profile_modified'));
                redirect(site_url('profile'), 'location');
                exit;
            }
        }
    }

    /**
    * Fonction d'édition du mot de passe.
    */
    public function change_password() {
        save_log('profile', 'change_password');
        $data = array();
        $data['title'] = $this->lang->line('profile_password_edit');

        $post = $this->input->post();
        $data['user'] = $this->session->userdata('user');
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('profile/change_password', $data);
            $this->load->view('templates/footer');
        } else {
            $rules = array(
                array(
                    'field' => 'password',
                    'label' => $this->lang->line('password'),
                    'rules' => 'trim|required|min_length[8]|contains_uppercase|contains_lowercase|contains_number',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'min_length' => $this->lang->line('min_length_field'),
                        'contains_uppercase' => $this->lang->line('must_contain_uppercase_field'),
                        'contains_lowercase' => $this->lang->line('must_contain_lowercase_field'),
                        'contains_number' => $this->lang->line('must_contain_number_field'),
                    ),
                ),
                array(
                    'field' => 'password_confirmation',
                    'label' => $this->lang->line('password_confirmation'),
                    'rules' => 'trim|required|matches[password]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'matches' => $this->lang->line('must_match_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('profile/change_password', $data);
                $this->load->view('templates/footer');
            } else {
                $donnees_echapees = array(
                    'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                );

                $this->user_model->update(array("user_id" => $data['user']->user_id), $donnees_echapees);

                $this->session->set_flashdata('success', $this->lang->line('password_modified'));
                redirect(site_url('profile'), 'location');
                exit;
            }
        }
    }
}