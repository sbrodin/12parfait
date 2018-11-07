<?php

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');
    }

    public function index()
    {
        if (!user_can('admin_all')) {
            Save_log('admin/home', 'index', 'tentative échouée de connexion à l\'admin');
            show_404();
        }
        Save_log('admin/home', 'index');

        $data = array();
        $data['title'] = $this->lang->line('admin').' - '.$this->lang->line('home');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}
