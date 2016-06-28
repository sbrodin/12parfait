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

        $user = $this->session->userdata('user');
        $data['user'] = $user;
        $date = new DateTime($user->add_date);
        $data['user']->add_date_formatted = $date->format('d/m/Y');

        $this->load->view('templates/header', $data);
        $this->load->view('profile', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
    * Fonction d'édition de la page de profil.
    */
    public function edit() {
        $data = array();
        $data['title'] = $this->lang->line('profile_edit');

        $this->load->view('templates/header', $data);
        $this->load->view('profile_edit', $data);
        $this->load->view('templates/footer', $data);
    }
}