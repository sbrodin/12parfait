<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction renvoie une citation du fichier csv.
  *
  * @param $line numéro de ligne de la citation voulue
  * @return array $quote un tableau formaté avec la citation et l'auteur (et s'il existe, un "à propos")
  */
function get_quote($line = 0) {
    $CI =& get_instance();
    $CI->load->helper('assets');
    // Récupération des citations
    $quotes = file(csv_url('citations'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($line === 0 || $line > count($quotes)) {
        // Tirage d'une citation pseudo-aléatoire
        $quote_num = rand(0, count($quotes)-1);
    } else {
        $quote_num = $line;
    }
    // Traitement de la citation
    $quote = str_getcsv($quotes[$quote_num], ';');
    $quote = array(
        'text' => $quote[0],
        'author' => trim($quote[1]).(isset($quote[2]) ? (' '.trim($quote[2])) : ''),
    );
    return $quote;
}