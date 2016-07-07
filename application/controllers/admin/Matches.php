<?php

class Matches extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $data['title'] = 'Admin - Matchs';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/matches/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
