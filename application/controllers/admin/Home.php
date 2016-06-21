<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        // $data['home'] = $this->vins_model->get_vins();
        // $data['title'] = 'Liste des home répertoriés';

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer.php');
    }
}
