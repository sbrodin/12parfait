<?php

class Maintenance extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Maintenance
        // $this->maintenance();

        // Construction
        $this->construction();
    }

    public function maintenance()
    {
        $data = array();
        $data['title'] = 'Maintenance';

        $this->load->view('templates/header', $data);
        $this->load->view('maintenance', $data);
        $this->load->view('templates/footer', $data);
    }

    public function construction()
    {
        $data = array();
        $data['title'] = 'Construction';

        $this->load->view('templates/header', $data);
        $this->load->view('construction', $data);
        $this->load->view('templates/footer', $data);
    }
}
