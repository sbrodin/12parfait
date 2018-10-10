<?php

class Maintenance extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');
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
        save_log('maintenance', 'maintenance');
        $data = array();
        $data['title'] = $this->lang->line('maintenance');

        $this->load->view('templates/header', $data);
        $this->load->view('maintenance', $data);
        $this->load->view('templates/footer');
    }

    public function construction()
    {
        save_log('maintenance', 'construction');
        $data = array();
        $data['title'] = $this->lang->line('construction');

        $this->load->view('templates/header', $data);
        $this->load->view('construction', $data);
        $this->load->view('templates/footer');
    }
}
