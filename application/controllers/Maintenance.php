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
        $log_message = 'méthode : maintenance, IP : ' . $this->input->ip_address();
        save_log($log_message, 'controller : maintenance');
        $data = array();
        $data['title'] = $this->lang->line('maintenance');

        $this->load->view('templates/header', $data);
        $this->load->view('maintenance', $data);
        $this->load->view('templates/footer', $data);
    }

    public function construction()
    {
        $log_message = 'méthode : construction, IP : ' . $this->input->ip_address();
        save_log($log_message, 'controller : maintenance');
        $data = array();
        $data['title'] = $this->lang->line('construction');

        $this->load->view('templates/header', $data);
        $this->load->view('construction', $data);
        $this->load->view('templates/footer', $data);
    }
}
