<?php
/**
 * Quote helper file
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
 * Cette fonction renvoie une citation du fichier csv.
 *
 * @param integer $line numéro de ligne de la citation voulue
 *
 * @return array $quote Un tableau formaté avec la citation et l'auteur
 *                      (et s'il existe, un "à propos")
 */
function Get_quote($line = 0)
{
    $CI =& get_instance();
    $CI->load->helper('assets');
    // Récupération des citations
    $quotes = file(
        csv_url('citations'),
        FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
    );
    if ($line === 0 || $line > count($quotes)) {
        // Tirage d'une citation pseudo-aléatoire
        $quote_num = rand(0, count($quotes)-1);
    } else {
        $quote_num = $line;
    }
    // Traitement de la citation
    $quote = str_getcsv($quotes[$quote_num], ';');
    $quote[2] = isset($quote[2]) ? (' '.trim($quote[2])) : '';
    $quote = array(
        'text' => $quote[0],
        'author' => trim($quote[1]).$quote[2],
    );
    return $quote;
}