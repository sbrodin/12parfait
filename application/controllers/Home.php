<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!is_connected()) {
            $this->lang->load('12parfait', $this->config->item('language'));
        } else {
            $this->lang->load('12parfait', $this->session->userdata['user']->language);
        }
    }

    public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('home');

        // $data['matches_of_day'] = matches_of_day('15/10/2016') ? matches_of_day('15/10/2016') : NULL;
        $data['yesterday_matches'] = matches_of_day(date('d/m/Y', time()-60*60*24)) ? matches_of_day(date('d/m/Y', time()-60*60*24)) : NULL;
        $data['today_matches'] = matches_of_day() ? matches_of_day() : NULL;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer', $data);
    }
}
