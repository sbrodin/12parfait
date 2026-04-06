<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!Is_connected()) {
            $this->lang->load('12parfait', $this->config->item('language'));
        } else {
            $this->lang->load('12parfait', $this->session->user->language);
        }
        $this->load->model('log_model');
    }

    public function index()
    {
        Save_log('home', 'index');
        $data = array();
        $data['title'] = $this->lang->line('home_title');

        if (!Is_connected()) {
            $language = $this->config->item('language');
        } else {
            $language = $this->session->user->language;
        }
        if (empty($language)) {
            $language = 'french';
        }

        // Chargement d'une citation aléatoire
        $this->load->helper('quote_helper');
        $quote = Get_quote();
        $data['quote_text'] = $quote['text'];
        $data['quote_author'] = $quote['author'];

        // Chargement du message d'accueil
        $this->load->model('message_model');
        $this->load->model('message_model');
        $data['home_message'] = $this->message_model->get_message('home-message');
        if ($data['home_message'] !== '') {
            $data['home_message'] = $data['home_message'][0]->{$language.'_content'};
        }
        $data['home_message'] = html_entity_decode($data['home_message']);

        // Chargement des infos matchs
        $yesterday_matches = Matches_of_day(date('d/m/Y', time()-24*60*60));
        $today_matches = Matches_of_day();
        $tomorrow_matches = Matches_of_day(date('d/m/Y', time()+24*60*60));

        $data['yesterday_matches'] = is_null($yesterday_matches) ? [] : $yesterday_matches['matches'];
        $data['today_matches'] = is_null($today_matches) ? [] : $today_matches['matches'];
        $data['tomorrow_matches'] = is_null($tomorrow_matches) ? [] : $tomorrow_matches['matches'];

        if (!$data['yesterday_matches'] && !$data['today_matches'] && !$data['tomorrow_matches']) {
            if ($last_matches = Last_matches()) {
                $data['last_matches'] = $last_matches['matches'];
            } else {
                $data['last_matches'] = null;
            }
            if ($next_matches = Next_matches()) {
                $data['next_matches'] = $next_matches['matches'];
                $data['next_matches_date'] = $next_matches['date'];
            } else {
                $data['next_matches'] = null;
                $data['next_matches_date'] = null;
            }
        }

        // Chargement des articles
        $this->load->model('article_model');
        $articles = $this->article_model->get_articles();
        foreach ($articles as $article) {
            $article->content = $article->{$language.'_content'};
            $article->title = $article->{$language.'_title'};
        }
        // $data['articles'] = $articles;
        $data['articles'] = [];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }

    public function terms()
    {
        Save_log('home', 'terms', 'Affichage des conditions d\'utilisation');
        $data = array();
        $data['title'] = $this->lang->line('terms_of_use');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('terms', $data);
        $this->load->view('templates/footer');
    }

    public function donate()
    {
        Save_log('home', 'donate', 'Affichage de la page "coup de pouce"');

        if (!Is_connected()) {
            $language = $this->config->item('language');
        } else {
            $language = $this->session->user->language;
        }
        if (empty($language)) {
            $language = 'french';
        }

        $data = array();
        $data['title'] = $this->lang->line('donate');
        $data['language'] = $language;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('donate', $data);
        $this->load->view('templates/footer');
    }

    public function rules()
    {
        Save_log('home', 'rules', 'Affichage des règles');
        $data = array();
        $data['title'] = $this->lang->line('rules');

        if (!Is_connected()) {
            $language = $this->config->item('language');
        } else {
            $language = $this->session->user->language;
        }
        if (empty($language)) {
            $language = 'french';
        }
        $data['language'] = $language;

        // $this->load->model('message_model');

        // $general_rules = $this->message_model->get_message('home-message');
        // if ($general_rules !== '') {
        //     $general_rules = $general_rules[0]->{$language.'_content'};
        // }
        // $data['general_rules'] = html_entity_decode($general_rules);

        // $bet_infos = $this->message_model->get_message('bet-message');
        // if ($bet_infos !== '') {
        //     $bet_infos = $bet_infos[0]->{$language.'_content'};
        // }
        // $data['bet_infos'] = html_entity_decode($bet_infos);

        // $bet_of_infos = $this->message_model->get_message('bet-of-message');
        // if ($bet_of_infos !== '') {
        //     $bet_of_infos = $bet_of_infos[0]->{$language.'_content'};
        // }
        // $data['bet_of_infos'] = html_entity_decode($bet_of_infos);

        // $bet_filter = $this->message_model->get_message('bet-filter-message');
        // if ($bet_filter !== '') {
        //     $bet_filter = $bet_filter[0]->{$language.'_content'};
        // }
        // $data['bet_filter'] = html_entity_decode($bet_filter);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('rules', $data);
        $this->load->view('templates/footer');
    }
}
