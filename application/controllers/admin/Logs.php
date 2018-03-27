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
            show_404();
        }
        $data['title'] = $this->lang->line('admin') . ' - ' . $this->lang->line('logs_admin');
        $select = 'log_id, log_controller, log_method, log_userip, log_userid, log_message, DATE_FORMAT(log_date, "%d/%m/%Y à %Hh%im%s") as log_date';
        $where = array();
        $limit = 100;
        $debut = 0;
        $order = 'log_id DESC';
        $data['logs'] = $this->log_model->read(
            $select,
            $where,
            $limit,
            $debut,
            $order
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('admin/logs/index', $data);
        $this->load->view('templates/footer', $data);
    }
}