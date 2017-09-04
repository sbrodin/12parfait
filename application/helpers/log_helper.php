<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction permet de sauvegarder des actions de log
  * @param $log_message Nom du fichier css
  * @param $log_ Nom du fichier css
  * @return void
  */
function save_log($log_message = '', $log_type = '', $log_date = '') {
    return get_instance()->log_model->save_log($log_message, $log_type, $log_date);
}