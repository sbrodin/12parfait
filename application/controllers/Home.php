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
        $data['yesterday_matches'] = Matches_of_day(date('d/m/Y', time()-24*60*60))['matches'];
        $data['today_matches'] = Matches_of_day()['matches'];
        $data['tomorrow_matches'] = Matches_of_day(date('d/m/Y', time()+24*60*60))['matches'];

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

    public function contact()
    {
        Save_log('contact', 'index');
        $data = array();
        $data['title'] = $this->lang->line('contact');

        // Récupération du message d'information pour le contact
        if (!Is_connected()) {
            $language = $this->config->item('language');
        } else {
            $language = $this->session->user->language;
        }
        if (empty($language)) {
            $language = 'french';
        }
        $this->load->model('message_model');
        $data['contact_message'] = $this->message_model->get_message('contact-message');
        if ($data['contact_message'] !== '') {
            $data['contact_message'] = $data['contact_message'][0]->{$language.'_content'};
        }
        $data['contact_message'] = html_entity_decode($data['contact_message']);

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('contact', $data);
            $this->load->view('templates/footer');
        } else {
            $rules = array(
                array(
                    'field' => 'contact_name',
                    'label' => $this->lang->line('your_name'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'motif',
                    'label' => $this->lang->line('motif'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
                array(
                    'field' => 'message',
                    'label' => $this->lang->line('your_message'),
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('contact', $data);
                $this->load->view('templates/footer');
            } else {
                // Conversion du message pour affichage correct en html
                $post['message'] = nl2br($post['message']);
                // Envoi de l'email
                $subject = '12parfait - Contact - '.$post['motif'];
                $body = 'Message envoyé par "'.$post['contact_name'].'" ('.$this->session->user->email.') :<br/><br/>';
                $body.= $post['message'];

                $config['mailtype'] = 'html';
                $this->email->initialize($config);

                $this->email->from('no-reply@12parfait.fr', '12parfait');
                $this->email->to('stanislas.brodin@gmail.com');
                $this->email->subject($subject);
                $this->email->message($body);
                $body = strip_tags(preg_replace('/\<br\s*\/?\>/', "\n", $body));
                $this->email->set_alt_message($body);
                $this->email->send();
                $this->email->clear();

                Save_log('contact', 'index', 'Envoi du message de : '.$this->session->user->email);
                $this->session->set_flashdata('success', $this->lang->line('message_successfully_sent'));
                redirect(site_url(), 'location');
                exit;
            }
        }
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
