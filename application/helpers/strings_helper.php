<?php
/**
 * Strings helper file
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

if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
 * Cette fonction prend en entrée une chaîne de caractères
 * et retourne une chaîne de caractères débarassée d'accents, de caractères
 * spéciaux, d'espaces et de '/'
 *
 * @param string $str      Chaîne de caractères à modifier
 * @param string $encoding Encodage utilisé
 *
 * @return string $str Chaîne de caractères débarassée d'accents, de caractères
 *                     spéciaux, d'espaces et de '/'
 */
function Suppr_Accents_espaces($str, $encoding='utf-8')
{
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);
    // remplacer les entités HTML pour avoir juste le premier caractère
    // non accentué
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "Ã " => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil);#', '\1', $str);
    $str = preg_replace('#&([A-za-z])(?:circ|orn|ring|slash|th);#', '\1', $str);
    $str = preg_replace('#&([A-za-z])(?:tilde|uml);#', '\1', $str);
    // Remplacer les ligatures tel que : Œ, Æ ...
    // Exemple "Å“" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;# ', '', $str);
    // Retire les espaces
    $str = str_replace(' ', '', trim($str));
    // Retire les slash
    $str = str_replace('/', '', trim($str));
    return $str;
}

/**
 * Cette fonction prend en entrée une chaîne de caractères
 * et retourne un booléen correspondant à la présence ou non d'une majuscule
 *
 * @param string $str Chaîne de caractères à vérifier
 *
 * @return Bool Booléen pour savoir si la chaîne en entrée contient une majuscule
 */
function Contains_uppercase($str)
{
    return preg_match('#[A-Z]#', $str) !==0 ? true : false;
}

/**
 * Cette fonction prend en entrée une chaîne de caractères
 * et retourne un booléen correspondant à la présence ou non d'une minuscule
 *
 * @param string $str Chaîne de caractères à vérifier
 *
 * @return Bool Booléen pour savoir si la chaîne en entrée contient une minuscule
 */
function Contains_lowercase($str)
{
    return preg_match('#[a-z]#', $str) !==0 ? true : false;
}

/**
 * Cette fonction prend en entrée une chaîne de caractères
 * et retourne un booléen correspondant à la présence ou non d'un chiffre
 *
 * @param string $str Chaîne de caractères à vérifier
 *
 * @return Bool Booléen pour savoir si la chaîne en entrée contient une minuscule
 */
function Contains_number($str)
{
    return preg_match('#[0-9]#', $str) !==0 ? true : false;
}