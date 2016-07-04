<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('home');
        var_dump($this->session->get_userdata('acl')['acl']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer', $data);
    }
}
