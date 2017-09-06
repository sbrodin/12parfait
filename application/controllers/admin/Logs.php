<?php

/**
  * Classe étendue du controller MY_Controller qui se situe dans application/core/MY_Controller.php .
  * Cette classe définit les règles de lecture des logs.
  */
class Logs extends MY_Controller {

    /**
    * Constructeur qui appelle les models utilisés par le controller.
    */
    public function __construct() {
        parent::__construct();

        $this->load->model('log_model');
    }

    /**
    * Fonction d'affichage de tous les logs.
    */
    public function index() {
        // Gestion des droits de lecture
        if (!user_can('view_logs')) {
            redirect(site_url(), 'location');
            exit;
        }
        $data['title'] = $this->lang->line('admin') . ' - ' . $this->lang->line('logs_admin');
        $data['logs'] = $this->log_model->read('*', array(), null, null, 'log_id DESC');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/logs/index', $data);
        $this->load->view('templates/footer', $data);
    }
}