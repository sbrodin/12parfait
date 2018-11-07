<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
  * Classe étendue du controller CI
  *
  * L'extension de la classe de base permet de vérifier que l'utilisateur est connecté
  * et active le profiler en environnement de dev.
  */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');

        // Authentification de l'utilisateur
        if (!Is_connected()) {
            $this->load->model('log_model');
            Save_log('my_controller', '__construct', 'utilisateur non connecté,<br/> tentative d\'accès à l\'url : '.(isset($_SERVER['HTTPS']) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            // Redirige l'utilisateur vers la page de connexion s'il n'est pas authentifié
            $this->lang->load('12parfait', $this->config->item('language'));
            redirect(site_url(''), 'location');
            exit;
        } else {
            $this->lang->load('12parfait', $this->session->user->language);
        }

        // Si l'utilisateur n'est plus actif, il doit être déconnecté
        if (!$this->user_model->is_active()) {
            $this->load->model('log_model');
            Save_log('my_controller', '__construct', 'utilisateur désactivé, url : '.(isset($_SERVER['HTTPS']) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
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

        // on n'active le profiler qu'en dev
        if (ENVIRONMENT === 'development') {
            // $this->output->enable_profiler(true);
        }
    }
}