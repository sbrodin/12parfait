<?php

class Log_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->config->item('log', 'table');
    }

    /**
      * Cette fonction permet de sauvegarder des actions de log
      * @param $log_message Message de log
      * @param $log_type Type de message de log
      * @param $log_date Date de message de log
      * @return void
      */
    function save_log($log_message = '', $log_type = '', $log_date = '') {
        if ($log_date === '') {
            $log_date = date('Y-m-d H:i:s');
        }
        $select = 'log_type, log_message';
        $where = array(
            'log_type' => $log_type,
            'log_message' => $log_message,
        );
        $existing_log = $this->read($select, $where);
        $donnees_echapees = array(
                'log_message' => $log_message,
                'log_type' => $log_type,
                'log_date' => $log_date,
            );
        return $this->create($donnees_echapees);
    }
}