<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction prend en entrée une chaîne de caractères
  * et retourne une chaîne de caractères débarassée d'accents, de caractères spéciaux, d'espaces et de '/'
  *
  * @param $str Chaîne de caractères à modifier
  * @param $encoding Encodage utilisé
  * @return Chaîne de caractères débarassée d'accents, de caractères spéciaux, d'espaces et de '/'
  */
function suppr_accents_espaces($str, $encoding='utf-8'){
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);
    // remplacer les entités HTML pour avoir juste le premier caractères non accentués
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "Ã " => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    // Remplacer les ligatures tel que : Œ, Æ ...
    // Exemple "Å“" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;# ', '', $str);
    // Retire les espaces
    $str = str_replace(' ', '',trim($str));
    // Retire les slash
    $str = str_replace('/', '',trim($str));
    return $str;
}

/**
  * Cette fonction prend en entrée une chaîne de caractères
  * et retourne un booléen correspondant à la présence ou non d'une majuscule
  *
  * @param $str Chaîne de caractères à vérifier
  * @return Booléen pour savoir si la chaîne en entrée contient une majuscule
  */
function contains_uppercase($str){
    return preg_match('#[A-Z]#', $str)!==0 ? TRUE : FALSE;
}

/**
  * Cette fonction prend en entrée une chaîne de caractères
  * et retourne un booléen correspondant à la présence ou non d'une minuscule
  *
  * @param $str Chaîne de caractères à vérifier
  * @return Booléen pour savoir si la chaîne en entrée contient une minuscule
  */
function contains_lowercase($str){
    return preg_match('#[a-z]#', $str)!==0 ? TRUE : FALSE;
}

/**
  * Cette fonction prend en entrée une chaîne de caractères
  * et retourne un booléen correspondant à la présence ou non d'un chiffre
  *
  * @param $str Chaîne de caractères à vérifier
  * @return Booléen pour savoir si la chaîne en entrée contient une minuscule
  */
function contains_number($str){
    return preg_match('#[0-9]#', $str)!==0 ? TRUE : FALSE;
}