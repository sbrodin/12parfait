<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction prend en entrée le nom d'un fichier css
  * et retourne l'url du fichier dans l'application.
  * @param $nom Nom du fichier css
  * @return Url du fichier css dans l'application
  */
function css_url($nom) {
    return base_url() . 'assets/css/' . $nom . '.css';
}

/**
  * Cette fonction prend en entrée le nom d'un fichier js
  * et retourne l'url du fichier dans l'application.
  * @param $nom Nom du fichier js
  * @return Url du fichier js dans l'application
  */
function js_url($nom) {
    return base_url() . 'assets/js/' . $nom . '.js';
}

/**
  * Cette fonction prend en entrée le nom d'un fichier csv
  * et retourne l'url du fichier dans l'application.
  * @param $nom Nom du fichier csv
  * @return Url du fichier csv dans l'application
  */
function csv_url($nom) {
    return base_url() . 'assets/csv/' . $nom . '.csv';
}

/**
  * Cette fonction prend en entrée le nom d'un fichier json
  * et retourne l'url du fichier dans l'application.
  * @param $nom Nom du fichier json
  * @return Url du fichier js dans l'application
  */
function json_url($nom) {
    return base_url() . 'assets/json/' . $nom . '.json';
}

/**
  * Cette fonction prend en entrée le nom d'une image avec son extension
  * et retourne l'url de l'image dans l'application.
  * @param $nom Nom de l'image
  * @return Url de l'image dans l'application
  */
function img_url($nom) {
    return base_url() . 'assets/img/' . $nom;
}

/**
  * Cette fonction prend en entrée le nom d'une image, un champ alt et un titre
  * et retourne le code html pour l'insertion d'une image avec un champ alt et un titre.
  *
  * La fonction img_url ci-dessus est utilisée pour la source de l'image.
  *
  * @param $nom Nom de l'image
  * @param $alt Champ alt pour l'image
  * @param $title Titre de l'image
  * @param $classes Classes ajoutées à la balise img
  * @return Code html correspondant à l'insertion d'une image, eventuellement avec un champ alt et un titre
  */
function img($nom, $alt = '', $title = '', $classes = '') {
    if ($alt === '' && $title !=='') {
        $alt = $title;
    }
    if ($title === '' && $alt !=='') {
        $title = $alt;
    }
    return '<img src="' . img_url($nom) . '" alt="' . $alt . '" title="' . $title . '" class="' . $classes . '" />';
}