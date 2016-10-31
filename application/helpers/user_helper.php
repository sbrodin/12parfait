<?php
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
  * @param $acl Action qui souhaite être effectuée
  * @return Booléen pour savoir si l'action est autorisée à l'utilisateur
  */
function user_can($acl) {
    return in_array($acl, get_instance()->session->get_userdata('acl')['acl']);
}

/**
  * Cette fonction vérifie qu'un email existe en base
  *
  * @return Booléen pour savoir si l'email existe en base
  */
function in_database_email($email) {
    return get_instance()->user_model->in_database_email($email);
}

/**
  * Cette fonction vérifie qu'un utilisateur est connecté
  *
  * @return Booléen pour savoir si l'utilisateur est connecté
  */
function is_connected() {
    return (get_cookie('12parfait_connected', TRUE) !== NULL);
}

/**
  * Cette fonction vérifie si un utilisateur est admin
  *
  * @return Booléen pour savoir si l'utilisateur est admin
  */
function is_admin() {
    return (get_instance()->session->get_userdata('user')['user']->acl == 'admin');
}

/**
  * Cette fonction vérifie si un utilisateur est moderateur
  *
  * @return Booléen pour savoir si l'utilisateur est moderateur
  */
function is_moderator() {
    return (get_instance()->session->get_userdata('user')['user']->acl == 'moderator');
}