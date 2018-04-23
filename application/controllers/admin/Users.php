<?php

/**
  * Classe étendue du controller MY_Controller qui se situe dans application/core/MY_Controller.php .
  * Cette classe définit les règles de création, lecture, mise à jour, acivation et désactivation des utilisateurs.
  * Elle définit également la fonction définissant si une adresse email est bien conforme.
  */
class Users extends MY_Controller {

    private $username_min_length = 6;
    private $username_max_length = 255;
    private $password_min_length = 4;
    private $password_max_length = 255;

    /**
    * Constructeur qui appelle les models utilisés par le controller.
    */
    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
    }

    /**
    * Fonction d'affichage de tous les utilisateurs.
    */
    public function index() {
        // Gestion des droits de lecture
        if (!user_can('view_users')) {
            show_404();
        }
        $data['title'] = $this->lang->line('admin') . ' - ' . $this->lang->line('users_admin');
        $data['users'] = $this->user_model->read('*');

        $users_scores = users_score_calculator();

        foreach ($data['users'] as $users_item) {
            $users_item->active = $users_item->active ? $this->lang->line('yes') : $this->lang->line('no');
            $users_item->first_name = ($users_item->first_name === '') ? $this->lang->line('no_data') : $users_item->first_name;
            $users_item->last_name = ($users_item->last_name === '') ? $this->lang->line('no_data') : $users_item->last_name;
            $users_item->user_name = ($users_item->user_name === '') ? $this->lang->line('no_data') : $users_item->user_name;
            $add_date = new DateTime($users_item->add_date);
            $users_item->add_date_formatted = $add_date->format('d/m/Y H:i:s');
            $last_connection = new DateTime($users_item->last_connection);
            $users_item->last_connection_formatted = $last_connection->format('d/m/Y H:i:s');
            $users_item->score = isset($users_scores[$users_item->user_id]) ? $users_scores[$users_item->user_id] : 0;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/users/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
    * Fonction d'activation d'un utilisateur.
    * @param $user_id Id de l'utilisateur à activer
    */
    public function activate($user_id) {
        // Gestion des droits d'activation
        if (!user_can('activate_user')) {
            show_404();
        }

        $donnees_echapees = array('active' => 1);

        $this->user_model->update(array("user_id" => $user_id), $donnees_echapees);

        redirect(site_url('admin/users'), 'location');
        exit;
    }

    /**
    * Fonction de désactivation d'un utilisateur.
    * @param $user_id Id de l'utilisateur à désactiver
    */
    public function deactivate($user_id) {
        // Gestion des droits de désactivation
        if (!user_can('deactivate_user')) {
            show_404();
        }

        $donnees_echapees = array('active' => 0);

        $this->user_model->update(array("user_id" => $user_id), $donnees_echapees);

        redirect(site_url('admin/users'), 'location');
        exit;
    }

    /**
    * Fonction de promotion d'un utilisateur.
    * @param $user_id Id de l'utilisateur à activer
    */
    public function promote($user_id = 0) {
        // Gestion des droits de promotion
        if (!user_can('promote_user')) {
            show_404();
        }

        if ($user_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $select = 'acl';
        $where = array(
            'user_id' => $user_id,
        );
        $user = $this->user_model->read($select, $where);
        if (!$user) {
            redirect(site_url(), 'location');
            exit;
        } else {
            $user = $user[0];
        }

        $new_acl = 'user';
        if ($user->acl === 'user') {
            $new_acl = 'beta';
        } else if ($user->acl === 'beta') {
            $new_acl = 'moderator';
        }

        $donnees_echapees = array('acl' => $new_acl);

        $this->user_model->update($where, $donnees_echapees);

        redirect(site_url('admin/users'), 'location');
        exit;
    }

    /**
    * Fonction de destitution d'un utilisateur.
    * @param $user_id Id de l'utilisateur à désactiver
    */
    public function demote($user_id = 0) {
        // Gestion des droits de destitution
        if (!user_can('demote_user')) {
            show_404();
        }

        if ($user_id === 0) {
            redirect(site_url(), 'location');
            exit;
        }

        $select = 'acl';
        $where = array(
            'user_id' => $user_id,
        );
        $user = $this->user_model->read($select, $where);
        if (!$user) {
            redirect(site_url(), 'location');
            exit;
        } else {
            $user = $user[0];
        }

        $new_acl = 'user';
        if ($user->acl === 'moderator') {
            $new_acl = 'beta';
        } else if ($user->acl === 'beta') {
            $new_acl = 'user';
        }

        $donnees_echapees = array('acl' => $new_acl);

        $this->user_model->update($where, $donnees_echapees);

        redirect(site_url('admin/users'), 'location');
        exit;
    }
}