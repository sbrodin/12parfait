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
    * Fonction de création d'utilisateur.
    */
    public function create() {
        // Gestion des droits d'ajout
        if (!user_can('add_user')) {
            redirect(site_url(), 'location');
        }
        $data['title'] = $this->lang->line('add_user');

        $this->form_validation->set_rules("username", "Nom d'utilisateur",
                                            "required|min_length[".$this->username_min_length."]|max_length[".$this->username_max_length."]|is_unique[users.username]");
        $this->form_validation->set_rules("password", "Mot de passe",
                                            "min_length[".$this->password_min_length."]|max_length[".$this->password_max_length."]");
        $this->form_validation->set_rules("password_confirmation", "Confirmation du mot de passe",
                                            "min_length[".$this->password_min_length."]|max_length[".$this->password_max_length."]|matches[password]");
        $this->form_validation->set_rules("email", "Email",
                                            "callback_is_email|is_unique[users.email]",
                                            array(
                                                "is_email" => $this->lang->line('incorrect_email')
                                            ));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header_admin', $data);
            $this->load->view('templates/nav.php', $data);
            $this->load->view('admin/users/create');
            $this->load->view('templates/footer');
        } else {
            $donnees_echapees = array();
            $donnees_echapees['acl'] = $this->input->post('acl');
            $donnees_echapees['active'] = $this->input->post('active') ? $this->input->post('active') : 0;
            $donnees_echapees['first_name'] = $this->input->post('first_name');
            $donnees_echapees['last_name'] = $this->input->post('last_name');
            $donnees_echapees['user_name'] = $this->input->post('user_name');
            $donnees_echapees['email'] = $this->input->post('email') ? $this->input->post('email') : NULL;
            $donnees_echapees['password'] = password_hash($this->input->post('password') ? $this->input->post('password') : $this->input->post('username'), PASSWORD_DEFAULT);
            $donnees_echapees['language'] = $this->input->post('language') ? $this->input->post('language') : 'fr';
            $donnees_echapees['adddate'] = date("Y-m-d H:i:s");

            $donnees_non_echapees = array();

            $this->user_model->create($donnees_echapees, $donnees_non_echapees);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('templates/nav.php', $data);
            $this->load->view('admin/user/createSuccess');
            $this->load->view('templates/footer');
        }
    }

    /**
    * Fonction d'affichage de tous les utilisateurs.
    */
    public function index() {
        // Gestion des droits de lecture
        if (!user_can('view_users')) {
            redirect(site_url(), 'location');
        }
        $data['users'] = $this->user_model->read('*');
        $data['title'] = $this->lang->line('index_user');

        foreach ($data['users'] as $users_item) {
            $users_item->active = $users_item->active ? $this->lang->line('yes') : $this->lang->line('no');
            $users_item->first_name = ($users_item->first_name === '') ? $this->lang->line('no_data') : $users_item->first_name;
            $users_item->last_name = ($users_item->last_name === '') ? $this->lang->line('no_data') : $users_item->last_name;
            $users_item->user_name = ($users_item->user_name === '') ? $this->lang->line('no_data') : $users_item->user_name;
            $add_date = new DateTime($users_item->add_date);
            $users_item->add_date_formatted = $add_date->format('d/m/Y H:i:s');
            $last_connection = new DateTime($users_item->last_connection);
            $users_item->last_connection_formatted = $last_connection->format('d/m/Y H:i:s');

            // if($users_item->lastconnection) {
            //     $users_item->lastconnection = DateTime::createFromFormat("Y-m-d H:i:s", $users_item->lastconnection);
            //     $users_item->lastconnection = $users_item->lastconnection->format("d/m/Y H:i:s");
            // } else {
            //     $users_item->lastconnection = $this->lang->line('never_connected');
            // }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/users/index', $data);
        $this->load->view('templates/footer');
    }

    /**
    * Fonction de visualisation d'un utilisateur.
    * @param $userid Id de l'utilisateur à visualiser
    */
    /*public function view($userid) {
        // Gestion des droits de lecture
        if (!user_can('view_user')) {
            redirect(site_url(), 'location');
        }
        $data['user'] = $this->user_model->read('userid, username, email, isprivileged, isadmin, adddate, lastconnection', array("userid" => $userid))[0];

        // si l'utilisateur cherché n'existe pas ou qu'aucune donnée n'est renvoyée
        if(!$data['user']) {
            redirect(site_url('admin/users'), 'location');
        }

        $data['title'] = $this->lang->line('index_user');

        $data['user']->isprivileged = $data['user']->isprivileged ? $this->lang->line('yes') : $this->lang->line('no');
        $data['user']->isadmin = $data['user']->isadmin ? $this->lang->line('yes') : $this->lang->line('no');
        $data['user']->adddate = DateTime::createFromFormat("Y-m-d H:i:s", $data['user']->adddate);
        $data['user']->adddate = $data['user']->adddate->format("d/m/Y H:i:s");

        if($data['user']->lastconnection) {
            $data['user']->lastconnection = DateTime::createFromFormat("Y-m-d H:i:s", $data['user']->lastconnection);
            $data['user']->lastconnection = $data['user']->lastconnection->format("d/m/Y H:i:s");
        } else {
            $data['user']->lastconnection = $this->lang->line('never_connected');
        }

        $this->load->view('templates/header_admin', $data);
        $this->load->view('admin/users/view', $data);
        $this->load->view('templates/footer');
    }

    /**
    * Fonction de mise à jour d'un utilisateur.
    * @param $userid Id de l'utilisateur à mettre à jour
    */
    /*public function edit($userid) {
        // Gestion des droits de mise à jour
        if (!user_can('edit_user')) {
            redirect(site_url(), 'location');
        }
        $data['user'] = $this->user_model->read('userid, username, email, isprivileged, isadmin', array("userid" => $userid))[0];

        // si l'utilisateur cherché n'existe pas ou qu'aucune donnée n'est renvoyée
        if(!$data['user']) {
            redirect(site_url('admin/users'), 'location');
        }

        $data['title'] = $this->lang->line('edit_user');

        $data['user']->isprivileged = $data['user']->isprivileged ? 'checked' : '';
        $data['user']->isadmin = $data['user']->isadmin ? 'checked' : '';

        $this->form_validation->set_rules("username", "Nom d'utilisateur",
                                            "required|min_length[".$this->username_min_length."]|max_length[".$this->username_max_length."]");
        $this->form_validation->set_rules("password", "Mot de passe",
                                            "min_length[".$this->password_min_length."]|max_length[".$this->password_max_length."]");
        $this->form_validation->set_rules("password_confirmation", "Confirmation du mot de passe",
                                            "min_length[".$this->password_min_length."]|max_length[".$this->password_max_length."]|matches[password]");
        $this->form_validation->set_rules("email", "Email",
                                            "callback_is_email",
                                            array(
                                                "is_email" => "Le champ %s ne correspond pas à une adresse email valide"
                                            ));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header_admin', $data);
            $this->load->view('admin/users/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $donnees_echapees = array();
            $donnees_echapees['username'] = $this->input->post('username');
            $donnees_echapees['password'] = password_hash($this->input->post('password') ? $this->input->post('password') : $this->input->post('username'), PASSWORD_DEFAULT);
            $donnees_echapees['email'] = $this->input->post('email') ? $this->input->post('email') : NULL;
            $donnees_echapees['isprivileged'] = $this->input->post('isprivileged') ? $this->input->post('isprivileged') : 0;
            $donnees_echapees['isadmin'] = $this->input->post('isadmin') ? $this->input->post('isadmin') : 0;

            $donnees_non_echapees = array();

            $this->user_model->update(array("userid" => $userid), $donnees_echapees, $donnees_non_echapees);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('admin/users/success_edit');
            $this->load->view('templates/footer');
        }
    }

    /**
    * Fonction d'activation d'un utilisateur.
    * @param $user_id Id de l'utilisateur à activer
    */
    public function activate($user_id) {
        // Gestion des droits d'activation
        if (!user_can('activate_user')) {
            redirect(site_url(), 'location');
        }

        $donnees_echapees = array();
        $donnees_echapees['active'] = 1;

        $donnees_non_echapees = array();

        $this->user_model->update(array("user_id" => $user_id), $donnees_echapees, $donnees_non_echapees);

        redirect(site_url('admin/users'), 'location');
    }

    /**
    * Fonction de désactivation d'un utilisateur.
    * @param $user_id Id de l'utilisateur à désactiver
    */
    public function deactivate($user_id) {
        // Gestion des droits de désactivation
        if (!user_can('deactivate_user')) {
            redirect(site_url(), 'location');
        }

        $donnees_echapees = array();
        $donnees_echapees['active'] = 0;

        $donnees_non_echapees = array();

        $this->user_model->update(array("user_id" => $user_id), $donnees_echapees, $donnees_non_echapees);

        redirect(site_url('admin/users'), 'location');
    }

    /**
    * Fonction de vérification de la conformité d'une adresse email.
    * @param $email Email entré sous forme de chaîne de caractère
    */
    public function is_email($email) {
        if(!$email) {
            return true;
        }
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}