<?php

class Challenge extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('challenge_model');
        $this->load->model('challenge_championship_model');
        $this->load->model('user_challenge_model');
        $this->load->model('log_model');
    }

    public function index()
    {
        save_log('challenge', 'index');
        if (!user_can('view_challenges')) {
            show_404();
        }

        $challenges = array(
            'test_challenge1',
            'test_challenge2',
        );
        user_can_view_challenge($challenges);

        $data = array();
        $data['title'] = $this->lang->line('challenge');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('challenge/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
