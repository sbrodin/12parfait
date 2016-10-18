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

        // Authentification de l'utilisateur
        if (!is_connected()) {
            // Redirige l'utilisateur vers la page de connexion s'il n'est pas authentifié
            $this->lang->load('12parfait', $this->config->item('language'));
            redirect(site_url(), 'location');
        } else {
            $this->lang->load('12parfait', $this->session->userdata['user']->language);
        }

        // on n'active le profiler qu'en dev
        if (ENVIRONMENT === 'development') {
            // $this->output->enable_profiler(true);
        }
    }
}