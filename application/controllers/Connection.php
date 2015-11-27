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
        $this->load->view('templates/header');
        $this->load->view('authentification');
        $this->load->view('templates/footer');
    }

    /**
    * Fonction de connexion.
    * Cette fonction stocke en session les acl en fonction des privilèges récupérés en base de l'utilisateur.
    */
    public function login() {
        $this->load->model('user_model');

        // Récupère les données envoyées par le formulaire
        $data = $this->input->post();
        if (empty($data) || !$data['login'] || !$data['password']) {
            redirect(site_url().'connection', 'location');
        }

        if ($user = $this->user_model->get_user_by_auth($data['login'], $data['password'])) {
            $donnees_echapees = array();
            $donnees_echapees['lastconnection'] = date("Y-m-d H:i:s");

            $donnees_non_echapees = array();

            $this->user_model->update(array("userid" => $user['userid']), $donnees_echapees, $donnees_non_echapees);

            $this->session->set_userdata('user', $user);
            if($user['isadmin']) {
                $this->session->set_userdata('acl', $this->admin_acl);
            } elseif ($user['isprivileged']) {
                $this->session->set_userdata('acl', $this->privileged_acl);
            } else {
                $this->session->set_userdata('acl', $this->basic_acl);
            }
            redirect(site_url().'home', 'location');
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
        redirect(site_url().'connection', 'location');
    }
}