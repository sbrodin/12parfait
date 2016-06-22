<?php

/**
  * Cette classe définit les règles de gestion des acl, de connexion et de déconnexion.
  */
class Connection extends CI_Controller {

    // Gestion des acl
    public $admin_acl = array(
            //acl pour user
            'add_user',
            'view_users',
            'view_user',
            'edit_user',
            'activate_user',
            'deactivate_user',
            //acl pour bet
            'add_bet',
            'view_bets',
            'view_bet',
            'edit_bet',
            'delete_bet',
            //acl pour league
            'add_league',
            'view_leagues',
            'view_league',
            'edit_league',
            'delete_league',
            //acl pour championship
            'add_championship',
            'view_championships',
            'view_championship',
            'edit_championship',
            'delete_championship',
            //acl pour team
            'add_team',
            'view_teams',
            'view_team',
            'edit_team',
            'delete_team',
            //acl pour match
            'add_match',
            'view_matchs',
            'view_match',
            'edit_match',
            'delete_match'
        );
    public $privileged_acl = array(
            'autocomplete_tag',
            'add_playlist',
            'view_playlists',
            'view_my_playlists',
            'view_playlist',
            'edit_playlist',
            'delete_playlist'
        );
    public $user_acl = array(
            'autocomplete_tag',
            'view_my_playlists',
            'view_playlist'
        );

    /**
    * Constructeur qui appelle les models utilisés par le controller
    * et active le profiler en environnement de dev.
    */
    public function __construct() {
        parent::__construct();

        // on n'active le profiler qu'en dev
        if (ENVIRONMENT === 'development') {
            $this->output->enable_profiler(true);
        }
        $this->load->model('user_model');
    }

    /**
    * Fonction d'affichage de la page de connexion.
    */
    public function index() {
        $data = array();
        // $data['home'] = $this->vins_model->get_vins();
        $data['title'] = $this->lang->line('connection');

        $this->load->view('templates/header', $data);
        $this->load->view('authentification');
        $this->load->view('templates/footer', $data);
    }

    /**
    * Fonction d'affichage de la page de création de compte.
    */
    public function create_account() {
        $data = array();
        // $data['home'] = $this->vins_model->get_vins();
        $data['title'] = $this->lang->line('create_account');

        $post = $this->input->post();
        if (empty($post)) {
            $this->load->view('templates/header', $data);
            $this->load->view('create_account');
            $this->load->view('templates/footer', $data);
        } else {
            $rules = array(
                array(
                    'field' => 'email',
                    'label' => $this->lang->line('email'),
                    'rules' => 'required|is_unique[user.email]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'is_unique' => $this->lang->line('already_in_db_field'),
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
                array(
                    'field' => 'password_confirmation',
                    'label' => $this->lang->line('password_confirmation'),
                    'rules' => 'required|matches[password]',
                    'errors' => array(
                        'required' => $this->lang->line('required_field'),
                        'matches' => $this->lang->line('must_match_field'),
                    ),
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('create_account');
            } else {
                $donnees_echapees = array(
                    'acl' => 'user',
                    'active' => '1',
                    'email' => $post['email'],
                    'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                    'add_date' => date('Y-m-d H:i:s'),
                    'last_connection' => date('Y-m-d H:i:s'),
                );
                $this->user_model->create($donnees_echapees);
                $this->load->view('formsuccess');
            }
        }

    }

    /**
    * Fonction de connexion.
    * Cette fonction stocke en session les acl en fonction des privilèges récupérés en base de l'utilisateur.
    */
    public function login() {
        // Récupère les données envoyées par le formulaire
        $post = $this->input->post();
        if (empty($post) || !$post['login'] || !$post['password']) {
            redirect(site_url().'connection', 'location');
        }

        if ($user = $this->user_model->get_user_by_auth($post['login'], $post['password'])) {
            $donnees_echapees = array();
            $donnees_echapees['last_connection'] = date("Y-m-d H:i:s");

            $donnees_non_echapees = array();

            $this->user_model->update(array("user_id" => $user->user_id), $donnees_echapees, $donnees_non_echapees);

            $this->session->set_userdata('user', $user);
            redirect(site_url(), 'location');
        }
        else {
            $this->session->set_flashdata('error', $this->lang->line('incorrect_login'));
            redirect(site_url().'connection', 'location');
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
        var_dump($this->session->get_userdata('user')['user']);
        redirect(site_url().'connection', 'location');
    }
}