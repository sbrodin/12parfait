<?php
/**
 * User helper file
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
 * Cette fonction vérifie qu'un utilisateur a les droits
 * correspondants à l'action qu'il souhaite effectuer.
 *
 * Lors de la connexion, les acl sont entrés en session.
 * La fonction se charge de vérifier que l'acl demandé apparaît dans le tableau.
 *
 * @param Mixed $acl Action qui souhaite être effectuée
 *
 * @return Bool Booléen pour savoir si l'action est autorisée à l'utilisateur
 */
function User_can($acl)
{
    if (Is_connected()) {
        $user_acl = get_instance()->session->userdata('acl');
    } else {
        $user_acl = array();
    }
    if (is_array($acl)) {
        foreach ($acl as $acl_element) {
            // Dès qu'on tombe sur un élément du tableau qui n'est pas dans les
            // acl possibles, on renvoie false
            if (!in_array($acl_element, $user_acl)) {
                return false;
            }
        }
        return true;
    }
    return in_array($acl, $user_acl);
}

/**
 * Cette fonction vérifie qu'un email existe en base
 *
 * @param String $email L'email à vérifier
 *
 * @return Bool Booléen pour savoir si l'email existe en base
 */
function In_Database_email($email)
{
    return get_instance()->user_model->in_database_email($email);
}

/**
 * Cette fonction vérifie qu'un utilisateur est connecté
 *
 * @return Bool Booléen pour savoir si l'utilisateur est connecté
 */
function Is_connected()
{
    return (!empty(get_instance()->session->userdata('acl')));
}

/**
 * Cette fonction vérifie si un utilisateur est admin
 *
 * @return Bool Booléen pour savoir si l'utilisateur est admin
 */
function Is_admin()
{
    return (get_instance()->session->userdata('user')->acl == 'admin');
}

/**
 * Cette fonction vérifie si un utilisateur est moderateur
 *
 * @return Bool Booléen pour savoir si l'utilisateur est moderateur
 */
function Is_moderator()
{
    return (get_instance()->session->userdata('user')->acl == 'moderator');
}