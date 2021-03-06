<?php

class Log_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('log', 'table');
    }

    /**
      * Cette fonction permet de sauvegarder des actions de log
      * @param log_controller Controlleur appelé
      * @param log_method Méthode appelée
      * @param log_message Message de log
      * @param log_userip IP de l'utilisateur
      * @param log_userid Id de l'utilisateur, s'il est connecté
      * @param $log_date Date de message de log
      * @return boolean Booléen si le log a été créé ou non
      */
    function save_log($log_controller = '', $log_method = '', $log_message = '', $log_userip = '', $log_userid = '', $log_date = '') {
        if ($log_userip === '') {
            $log_userip = $this->input->ip_address();
        }
        if ($log_userid === '') {
            if (Is_connected() && !empty($this->session->user->user_id)) {
                $log_userid = $this->session->user->user_id;
                if (intval($log_userid) === 1) {
                    return;
                }
            } else {
                $log_userid = null;
            }
        }
        if ($log_date === '') {
            $log_date = date('Y-m-d H:i:s');
        }
        $donnees_echapees = array(
                'log_controller' => $log_controller,
                'log_method' => $log_method,
                'log_message' => $log_message,
                'log_userip' => $log_userip,
                'log_userid' => $log_userid,
                'log_date' => $log_date,
            );
        return $this->create($donnees_echapees);
    }
}