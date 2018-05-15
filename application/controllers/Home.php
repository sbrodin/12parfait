<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!is_connected()) {
            $this->lang->load('12parfait', $this->config->item('language'));
        } else {
            $this->lang->load('12parfait', $this->session->user->language);
        }
    }

    public function index()
    {
        $this->load->model('log_model');
        save_log('home', 'index');
        $data = array();
        $data['title'] = $this->lang->line('home');

        if (!is_connected()) {
            $language = $this->config->item('language');
        } else {
            $language = $this->session->user->language;
        }
        if (empty($language)) {
            $language = 'french';
        }

        // Chargement d'une citation aléatoire
        $this->load->helper('quote_helper');
        $quote = get_quote();
        $data['quote_text'] = $quote['text'];
        $data['quote_author'] = $quote['author'];

        $this->load->model('message_model');
        $data['home_message'] = $this->message_model->get_message('home-message');
        if ($data['home_message'] !== '') {
            $data['home_message'] = $data['home_message'][0]->{$language.'_content'};
        }
        $data['home_message'] = html_entity_decode($data['home_message']);
        $data['yesterday_matches'] = matches_of_day(date('d/m/Y', time()-24*60*60))['matches'];
        $data['today_matches'] = matches_of_day()['matches'];
        $data['tomorrow_matches'] = matches_of_day(date('d/m/Y', time()+24*60*60))['matches'];

        if (!$data['yesterday_matches'] && !$data['today_matches'] && !$data['tomorrow_matches']) {
            if ($last_matches = last_matches()) {
                $data['last_matches'] = $last_matches['matches'];
            } else {
                $data['last_matches'] = null;
            }
            if ($next_matches = next_matches()) {
                $data['next_matches'] = $next_matches['matches'];
                $data['next_matches_date'] = $next_matches['date'];
            } else {
                $data['next_matches'] = null;
                $data['next_matches_date'] = null;
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function terms()
    {
        $this->load->model('log_model');
        save_log('home', 'terms', 'Affichage des conditions d\'utilisation');
        $data = array();
        $data['title'] = $this->lang->line('terms_of_use');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('terms', $data);
        $this->load->view('templates/footer', $data);
    }
}
