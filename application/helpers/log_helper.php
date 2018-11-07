<?php
/**
 * Log helper file
 *
 * PHP Version 7.1
 *
 * @category Helpers
 * @package  Helpers
 * @author   Stanislas Brodin <stanislas.brodin@gmail.com>
 * @license  https://opensource.org/licenses/MIT    MIT License
 * @link     https://12parfait.fr
 */

if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
 * Cette fonction permet de sauvegarder des actions de log
 *
 * @param string $log_controller Controlleur appelé
 * @param string $log_method     Méthode appelée
 * @param string $log_message    Message de log
 * @param string $log_userip     IP de l'utilisateur
 * @param string $log_userid     Id de l'utilisateur, s'il est connecté
 * @param string $log_date       Date de message de log
 *
 * @return Bool Booléen si le log a été créé ou non
 */
function Save_log(
    $log_controller = '',
    $log_method = '',
    $log_message = '',
    $log_userip = '',
    $log_userid = '',
    $log_date = ''
) {
    return get_instance()->log_model->save_log(
        $log_controller,
        $log_method,
        $log_message,
        $log_userip,
        $log_userid,
        $log_date
    );
}