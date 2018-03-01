<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
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
    return get_instance()->log_model->save_log($log_controller, $log_method, $log_message, $log_userip, $log_userid, $log_date);
}