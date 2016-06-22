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
        // $data['home'] = $this->vins_model->get_vins();
        $data['title'] = $this->lang->line('profile');

        $this->load->view('templates/header', $data);
        $this->load->view('profile', $data);
        $this->load->view('templates/footer', $data);
    }

}