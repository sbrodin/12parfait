<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');

        if (!is_connected()) {
            $this->lang->load('12parfait', $this->config->item('language'));
        } else {
            $this->lang->load('12parfait', $this->session->userdata('language'));
        }
    }

    public function index()
    {
        save_log('home', 'index');
        $data = array();
        $data['title'] = $this->lang->line('home');

        if (!is_connected()) {
            $language = $this->config->item('language');
        } else {
            $language = $this->session->userdata('language');
        }
        if (empty($language)) {
            $language = 'french';
        }
        $this->load->model('message_model');
        $data['home_message'] = $this->message_model->get_message('home-message');
        if ($data['home_message'] !== '') {
            $data['home_message'] = $data['home_message'][0]->{$language.'_content'};
        }
        $data['home_message'] = html_entity_decode($data['home_message']);
        $data['yesterday_matches'] = matches_of_day(date('d/m/Y', time()-60*60*24))[0];
        $data['today_matches'] = matches_of_day()[0];
        $data['tomorrow_matches'] = matches_of_day(date('d/m/Y', time()+60*60*24))[0];

        if (!$data['yesterday_matches'] && !$data['today_matches'] && !$data['tomorrow_matches']) {
            $data['last_matches'] = last_matches()[0];
            $next_matches = next_matches();
            $data['next_matches'] = $next_matches[0];
            $data['next_matches_date'] = $next_matches[1];
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer', $data);
    }
}
