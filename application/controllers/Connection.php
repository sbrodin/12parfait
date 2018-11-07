<?php

/**
  * Cette classe définit les règles de gestion des acl, de connexion et de déconnexion.
  */
class Connection extends CI_Controller {

    // Gestion des acl
    public $admin_acl = array(
        // acl général pour admin
        'admin_all',
        // acl pour debug
        'debug',
        // acl pour user
        'admin_users',
        'add_user',
        'view_users',
        'view_user',
        'edit_user',
        'activate_user',
        'deactivate_user',
        'promote_user',
        'demote_user',
        // acl pour bet
        'admin_bets',
        // acl pour league
        'admin_leagues',
        'add_league',
        'view_leagues',
        'view_league',
        'edit_league',
        'delete_league',
        // acl pour championship
        'admin_championships',
        'add_championship',
        'view_championships',
        'view_championship',
        'edit_championship',
        'delete_championship',
        'activate_championship',
        'deactivate_championship',
        // acl pour team
        'admin_teams',
        'add_team',
        'view_teams',
        'view_team',
        'edit_team',
        'delete_team',
        'del_team_from_championship',
        // acl pour match
        'admin_matches',
        'add_match',
        'view_matchs',
        'view_match',
        'edit_match',
        'delete_match',
        // acl pour journée
        'admin_fixtures',
        'add_fixture',
        'view_fixtures',
        'edit_fixture',
        'edit_fixture_results',
        'close_fixture',
        'open_fixture',
        // acl pour messages
        'admin_messages',
        'add_message',
        'view_messages',
        'edit_message',
        // acl pour logs
        'admin_logs',
        'view_logs',
    );
    public $moderator_acl = array(
        // acl général pour admin
        'admin_all',
        // acl pour journée
        'admin_fixtures',
        'add_fixture',
        'view_fixtures',
        'edit_fixture',
        'edit_fixture_results',
        'close_fixture',
        'open_fixture',
    );
    public $beta_acl = array(
        // acl pour beta
        'beta',
    );
    public $user_acl = array(
        // acl pour bet
        'add_bet',
        'view_bets',
        'view_bet',
        'edit_bet',
        'delete_bet',
        // acl pour scores
        'view_scores',
    );

    /**
    * Constructeur qui appelle les models utilisés par le controller
    */
    public function __construct() {
        parent::__construct();

        if (!is_connected()) {
            $this->lang->load('12parfait', $this->config->item('language'));
        } else {
            $this->lang->load('12parfait', $this->session->user->language);
        }
        $this->load->model('log_model');
    }

    /**
    * Fonction d'affichage de la page de connexion.
    */
    public function index() {
        if (is_connected()) {
            redirect(site_url());
            exit;
        }
        save_log('connection', 'index');
        $data = array();
        $data['title'] = $this->lang->line('log_in');
        if (!empty($this->input->get()) && $this->input->get('url') !== null) {
            $url = urlencode($this->input->get('url'));
        } else {
            $url = '';
        }
        $data['url'] = $url;

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('login', $data);
            $this->load->view('templates/footer');
        } else {
            $rules = array(
                array(
                    'field' => 'email',
                    'label' => $this->lang->line('email'),
                    'rules' => 'required|valid_email',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'valid_email' => $this->lang->line('valid_email'),
                    ),
                ),
                array(
                    'field' => 'password',
                    'label' => $this->lang->line('password'),
                    'rules' => 'required',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('login', $data);
                $this->load->view('templates/footer');
            } else {
                $this->login($url);
            }
        }
    }

    /**
    * Fonction d'affichage de la page de création de compte.
    */
    public function create_account() {
        save_log('connection', 'create_account');
        $data = array();
        $data['title'] = $this->lang->line('create_account');

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('create_account', $data);
            $this->load->view('templates/footer');
        } else {
            $rules = array(
                array(
                    'field' => 'email',
                    'label' => $this->lang->line('email'),
                    'rules' => 'trim|strtolower|required|is_unique[user.email]|valid_email',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'is_unique' => $this->lang->line('already_in_db_field'),
                        'valid_email' => $this->lang->line('valid_email'),
                    ),
                ),
                array(
                    'field' => 'password',
                    'label' => $this->lang->line('password'),
                    'rules' => 'trim|required|min_length[8]|Contains_uppercase|Contains_lowercase|Contains_number',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'min_length' => $this->lang->line('min_length_field'),
                        'Contains_uppercase' => $this->lang->line('must_contain_uppercase_field'),
                        'Contains_lowercase' => $this->lang->line('must_contain_lowercase_field'),
                        'Contains_number' => $this->lang->line('must_contain_number_field'),
                    ),
                ),
                array(
                    'field' => 'password_confirmation',
                    'label' => $this->lang->line('password_confirmation'),
                    'rules' => 'trim|required|matches[password]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'matches' => $this->lang->line('must_match_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('create_account', $data);
                $this->load->view('templates/footer');
            } else {
                $post['email'] = strtolower($post['email']);
                $donnees_echapees = array(
                    'rand_userid' => random_string('alnum', 10),
                    'acl' => 'user',
                    'active' => '1',
                    'email' => $post['email'],
                    'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                    'language' => 'french',
                    'add_date' => date('Y-m-d H:i:s'),
                );

                // Envoi d'email pour info
                $subject = '12parfait - Création de compte';
                $body = 'Un nouveau compte a été créé.<br/><br/>';
                $body.= 'Email : '.$post['email'];

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

                // Envoi d'email pour confirmation d'inscription
                $this->load->model('message_model');
                $welcome_email = $this->message_model->get_message('welcome-email');
                if ($welcome_email !== '') {
                    $subject = $this->lang->line('welcome_email_subject');
                    $welcome_email = html_entity_decode($welcome_email[0]->{'french_content'});
                    $this->email->from('no-reply@12parfait.fr', '12parfait');
                    $this->email->to($post['email']);
                    $this->email->subject($subject);
                    $this->email->message($welcome_email);
                    $welcome_email = strip_tags(preg_replace('/\<br\s*\/?\>/', "\n", $welcome_email));
                    $this->email->set_alt_message($welcome_email);
                    $this->email->send();
                    $this->email->clear();
                }

                $this->load->model('user_model');
                $this->user_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('account_successful_creation'));
                // Redirection vers le profil
                $this->login('profile');
            }
        }

    }

    /**
    * Fonction de connexion.
    * Cette fonction stocke en session les acl en fonction des privilèges récupérés en base de l'utilisateur.
    */
    public function login($url = '') {
        $this->load->model('user_model');
        // Récupère les données envoyées par le formulaire
        $post = $this->input->post();
        if (empty($post) || !$post['email'] || !$post['password']) {
            if (empty($post)) {
                save_log('connection', 'login', 'échec de connexion - données post vides');
            } else if (!$post['email']) {
                save_log('connection', 'login', 'échec de connexion - post email vide');
            } else if (!$post['password']) {
                save_log('connection', 'login', 'échec de connexion - post password vide');
            }
            redirect(site_url('connection'), 'location');
            exit;
        }

        // Cas de la redirection depuis la page d'accueil
        if (!empty($this->input->get()) && $this->input->get('url') !== null) {
            $url = urlencode($this->input->get('url'));
        }

        if ($user = $this->user_model->get_user_by_auth($post['email'], $post['password'])) {
            if ($user->active == 0) {
                $this->session->set_flashdata('error', $this->lang->line('deactivated_account'));
                redirect(site_url('connection'), 'location');
                exit;
            }
            $donnees_echapees = array(
                'last_connection' => date("Y-m-d H:i:s"),
                'hash' => null,
                'date_hash' => null,
            );

            $this->user_model->update(array("user_id" => $user->user_id), $donnees_echapees);

            $this->session->set_userdata('user', $user);
            if ($user->acl === 'admin') {
                $this->session->set_userdata('acl', array_merge($this->admin_acl, $this->beta_acl, $this->user_acl));
            } else if ($user->acl === 'moderator') {
                $this->session->set_userdata('acl', array_merge($this->moderator_acl, $this->beta_acl, $this->user_acl));
            } else if ($user->acl === 'beta') {
                $this->session->set_userdata('acl', array_merge($this->beta_acl, $this->user_acl));
            } else {
                $this->session->set_userdata('acl', $this->user_acl);
            }
            if ($url !== '') {
                save_log('connection', 'login', 'connexion réussie - vers url spécifique : '.urldecode($url));
                redirect(site_url(urldecode($url)), 'location');
                exit;
            } else {
                save_log('connection', 'login', 'connexion réussie - vers home');
                redirect(site_url(), 'location');
                exit;
            }
        } else {
            save_log('connection', 'login', 'échec de connexion - problème email / mot de passe (email : '.$post['email'].')');
            $this->session->set_flashdata('error', $this->lang->line('incorrect_login'));
            redirect(site_url('connection'), 'location');
            exit;
        }
    }

    /**
    * Fonction d'oubli de mot de passe.
    */
    public function forgotten_password() {
        $data = array();
        $data['title'] = $this->lang->line('forgotten_password');

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('forgotten_password', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('user_model');
            $rules = array(
                array(
                    'field' => 'email',
                    'label' => $this->lang->line('email'),
                    'rules' => 'required|valid_email|in_database_email',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'valid_email' => $this->lang->line('valid_email'),
                        'in_database_email' => $this->lang->line('not_in_database_email'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('forgotten_password', $data);
                $this->load->view('templates/footer');
            } else {
                $post['email'] = strtolower($post['email']);
                $where = array('email' => $post['email']);
                $hash = random_string('alnum', 255);
                $donnees_echapees = array(
                        'hash' => $hash,
                        'date_hash' => date('Y-m-d H:i:s'),
                    );
                $this->user_model->update($where, $donnees_echapees);

                $subject = '12parfait - Mot de passe oublié';
                $body = 'Pour réinitialiser votre mot de passe, veuillez cliquer sur <a href="'.site_url('reset_password/'.$hash).'">ce lien</a>';

                $config['mailtype'] = 'html';
                $this->email->initialize($config);

                $this->email->from('no-reply@12parfait.fr', '12parfait');
                $this->email->to($post['email']);
                $this->email->subject($subject);
                $this->email->message($body);
                $body = strip_tags(preg_replace('/\<br\s*\/?\>/', "\n", $body));
                $this->email->set_alt_message($body);
                $this->email->send();
                $this->email->clear();
                save_log('connection', 'forgotten_password', 'Envoi du message de réinitialisation de mot de passe pour l\'adresse : '.$post['email']);

                $this->session->set_flashdata('info', $this->lang->line('reset_password_email_sent'));
                redirect(site_url('connection'), 'location');
                exit;
            }
        }
    }

    /**
    * Fonction de réinitialisation du mot de passe
    * Cette fonction permet de réinitialiser son mot de passe à partir d'un lien reçu dans un email
    */
    public function reset_password($hash)
    {
        $this->load->model('user_model');
        $data = array();
        $data['title'] = $this->lang->line('reset_password');
        $data['hash'] = $hash;

        $user = $this->user_model->read('*', array('hash'=>$hash));
        // Si le hash n'existe pas en base
        if (!$user) {
            redirect(site_url(), 'location');
            exit;
        } else {
            $user = $user[0];
        }

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav');
            $this->load->view('reset_password', $data);
            $this->load->view('templates/footer');
        } else {
            $rules = array(
                array(
                    'field' => 'new_password',
                    'label' => $this->lang->line('new_password'),
                    'rules' => 'trim|required|min_length[8]|Contains_uppercase|Contains_lowercase|Contains_number',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'min_length' => $this->lang->line('min_length_field'),
                        'Contains_uppercase' => $this->lang->line('must_contain_uppercase_field'),
                        'Contains_lowercase' => $this->lang->line('must_contain_lowercase_field'),
                        'Contains_number' => $this->lang->line('must_contain_number_field'),
                    ),
                ),
                array(
                    'field' => 'new_password_confirmation',
                    'label' => $this->lang->line('new_password_confirmation'),
                    'rules' => 'trim|required|matches[new_password]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'matches' => $this->lang->line('must_match_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('reset_password', $data);
                $this->load->view('templates/footer');
            } else {
                $where = array(
                    'hash' => $hash,
                );
                $donnees_echapees = array(
                    'password' => password_hash($post['new_password'], PASSWORD_BCRYPT),
                    'hash' => null,
                    'date_hash' => null,
                );
                $this->user_model->update($where, $donnees_echapees);
                var_dump($user);
                save_log('connection', 'reset_password', 'Réinitialisation du mot de passe pour l\'adresse : '.$user->email);
                $this->session->set_flashdata('success', $this->lang->line('password_modified'));
                redirect(site_url('connection'), 'location');
                exit;
            }
        }
    }

    /**
    * Fonction de déconnexion.
    * Cette fonction supprime les données de session.
    */
    public function logout() {
        save_log('connection', 'logout');
        if (!empty($this->session->userdata('user'))) {
            $this->session->unset_userdata('user');
        }
        if (!empty($this->session->userdata('acl'))) {
            $this->session->unset_userdata('acl');
        }
        delete_cookie('ci_session');
        redirect(site_url(''), 'location');
        exit;
    }
}