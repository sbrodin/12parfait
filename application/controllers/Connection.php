<?php

/**
  * Cette classe définit les règles de gestion des acl, de connexion et de déconnexion.
  */
class Connection extends CI_Controller {

    // Gestion des acl
    public $admin_acl = array(
        // acl général pour admin
        'admin_all',
        // acl pour user
        'add_user',
        'view_users',
        'view_user',
        'edit_user',
        'activate_user',
        'deactivate_user',
        'promote_user',
        'demote_user',
        // acl pour bet
        'add_bet',
        'view_bets',
        'view_bet',
        'edit_bet',
        'delete_bet',
        // acl pour league
        'add_league',
        'view_leagues',
        'view_league',
        'edit_league',
        'delete_league',
        // acl pour championship
        'add_championship',
        'view_championships',
        'view_championship',
        'edit_championship',
        'delete_championship',
        // acl pour team
        'add_team',
        'view_teams',
        'view_team',
        'edit_team',
        'delete_team',
        // acl pour match
        'add_match',
        'view_matchs',
        'view_match',
        'edit_match',
        'delete_match',
        // acl pour journée
        'view_fixtures',
        'add_fixture',
        'edit_fixture',
        'edit_fixture_results',
    );
    public $moderator_acl = array(
        
    );
    public $user_acl = array(
        // acl pour bet
        'add_bet',
        'view_bets',
        'view_bet',
        'edit_bet',
        'delete_bet',
    );

    /**
    * Constructeur qui appelle les models utilisés par le controller
    */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');

        if (!is_connected()) {
            $this->lang->load('12parfait', $this->config->item('language'));
        } else {
            $this->lang->load('12parfait', $this->session->userdata['user']->language);
        }
    }

    /**
    * Fonction d'affichage de la page de connexion.
    */
    public function index() {
        $data = array();
        $data['title'] = $this->lang->line('log_in');

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('login', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->load->helper('strings');

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
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('login', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $this->login($to_profile);
            }
        }
    }

    /**
    * Fonction d'affichage de la page de création de compte.
    */
    public function create_account() {
        $data = array();
        $data['title'] = $this->lang->line('create_account');

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('create_account', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->load->helper('strings');

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
                    'rules' => 'trim|required|min_length[8]|contains_uppercase|contains_lowercase|contains_number',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'min_length' => $this->lang->line('min_length_field'),
                        'contains_uppercase' => $this->lang->line('must_contain_uppercase_field'),
                        'contains_lowercase' => $this->lang->line('must_contain_lowercase_field'),
                        'contains_number' => $this->lang->line('must_contain_number_field'),
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
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('create_account', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $donnees_echapees = array(
                    'acl' => 'user',
                    'active' => '1',
                    'email' => $post['email'],
                    'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                    'add_date' => date('Y-m-d H:i:s'),
                );

                // Envoi d'email pour info
                $this->load->helper('email');
                $subject = '12 Parfait - Création de compte - Globalis';
                $body = 'Un nouveau compte a été créé.<br/>';
                $body.= 'Email : ' . $post['email'];
                send_email_interception('stanislas.brodin@gmail.com', $subject, $body);

                $this->user_model->create($donnees_echapees);
                $this->session->set_flashdata('success', $this->lang->line('account_successful_creation'));
                $to_profile = TRUE;
                $this->login($to_profile);
            }
        }

    }

    /**
    * Fonction de connexion.
    * Cette fonction stocke en session les acl en fonction des privilèges récupérés en base de l'utilisateur.
    */
    public function login($to_profile = FALSE) {
        // Récupère les données envoyées par le formulaire
        $post = $this->input->post();
        if (empty($post) || !$post['email'] || !$post['password']) {
            redirect(site_url('connection'), 'location');
            exit;
        }

        if ($user = $this->user_model->get_user_by_auth($post['email'], $post['password'])) {
            if ($user->active == 0) {
                $this->session->set_flashdata('error', $this->lang->line('deactivated_account'));
                redirect(site_url('connection'), 'location');
                exit;
            }
            $donnees_echapees = array(
                'last_connection' => date("Y-m-d H:i:s"),
                'hash' => NULL,
                'date_hash' => NULL,
            );

            $this->user_model->update(array("user_id" => $user->user_id), $donnees_echapees);

            $this->session->set_userdata('user', $user);
            if ($user->acl === 'admin') {
                $this->session->set_userdata('acl', $this->admin_acl);
            } else if ($user->acl === 'moderator') {
                $this->session->set_userdata('acl', $this->moderator_acl);
            } else {
                $this->session->set_userdata('acl', $this->user_acl);
            }
            if ($to_profile) {
                redirect(site_url('profile'), 'location');
                exit;
            } else {
                redirect(site_url(), 'location');
                exit;
            }
        } else {
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
            $this->load->view('templates/nav', $data);
            $this->load->view('forgotten_password', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->load->helper('user');
            $this->load->helper('email');
            $this->load->helper('string');

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
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('forgotten_password', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $where = array('email' => $post['email']);
                $hash = random_string('alnum', 255);
                $donnees_echapees = array(
                        'hash' => $hash,
                        'date_hash' => date('Y-m-d H:i:s'),
                    );
                $this->user_model->update($where, $donnees_echapees);

                $subject = '12 Parfait - Mot de passe oublié';
                $body = 'Pour réinitialiser votre mot de passe, veuillez cliquer sur <a href="' . site_url('reset_password/' . $hash) . '">ce lien</a>';
                send_email_interception($post['email'], $subject, $body);

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
            $this->load->view('templates/nav', $data);
            $this->load->view('reset_password', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->load->helper('strings');
            $rules = array(
                array(
                    'field' => 'new_password',
                    'label' => $this->lang->line('new_password'),
                    'rules' => 'trim|required|min_length[8]|contains_uppercase|contains_lowercase|contains_number',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'min_length' => $this->lang->line('min_length_field'),
                        'contains_uppercase' => $this->lang->line('must_contain_uppercase_field'),
                        'contains_lowercase' => $this->lang->line('must_contain_lowercase_field'),
                        'contains_number' => $this->lang->line('must_contain_number_field'),
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
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav', $data);
                $this->load->view('reset_password', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $where = array(
                    'hash' => $hash,
                );
                $donnees_echapees = array(
                    'password' => password_hash($post['new_password'], PASSWORD_BCRYPT),
                    'hash' => NULL,
                    'date_hash' => NULL,
                );
                $this->user_model->update($where, $donnees_echapees);
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
        if (!empty($this->session->userdata['user'])) {
            $this->session->unset_userdata('user');
        }
        if (!empty($this->session->userdata['acl'])) {
            $this->session->unset_userdata('acl');
        }
        redirect(site_url(''), 'location');
        exit;
    }
}