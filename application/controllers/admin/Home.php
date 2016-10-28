<?php

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!user_can('admin_all')) {
            redirect(site_url(), 'location');
            exit;
        }

        $data = array();
        $data['title'] = $this->lang->line('admin') . ' - ' . $this->lang->line('home');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
