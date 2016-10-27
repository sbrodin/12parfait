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

        $this->load->model('message_model');
        if (!is_connected()) {
            $language = $this->config->item('language');
        } else {
            $language = $this->session->userdata['user']->language;
        }
        $data['home_message'] = $this->message_model->get_message('home-message', $language);
        if ($data['home_message'] !== '') {
            $data['home_message'] = $data['home_message'][0]->content;
        }
        $data['home_message'] = html_entity_decode($data['home_message']);
        $data['yesterday_matches'] = matches_of_day(date('d/m/Y', time()-60*60*24));
        $data['today_matches'] = matches_of_day();
        $data['tomorrow_matches'] = matches_of_day(date('d/m/Y', time()+60*60*24));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer', $data);
    }
}
