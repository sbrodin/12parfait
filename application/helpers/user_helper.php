<?php
if ( !defined('BASEPATH') ) {
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
if ( !function_exists('user_can')) {
    function user_can($acl) {
        $CI =& get_instance();
        return in_array($acl, $CI->session->get_userdata('acl')['acl']);
    }
}

/**
  * Cette fonction vérifie qu'un utilisateur est connecté
  *
  * @return Booléen pour savoir si l'utilisateur est connecté
  */
if ( !function_exists('is_connected')) {
    function is_connected() {
        $CI =& get_instance();
        return isset($CI->session->get_userdata('user')['user']);
    }
}