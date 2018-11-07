<?php
/**
 * Assets helper file
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
 * Cette fonction prend en entrée le nom d'un fichier css
 * et retourne l'url du fichier dans l'application.
 *
 * @param String $nom Nom du fichier css
 *
 * @return String Url du fichier css dans l'application
 */
function Css_url($nom)
{
    return base_url().'assets/css/'.$nom.'.css';
}

/**
 * Cette fonction prend en entrée le nom d'un fichier js
 * et retourne l'url du fichier dans l'application.
 *
 * @param String $nom Nom du fichier js
 *
 * @return String Url du fichier js dans l'application
 */
function Js_url($nom)
{
    return base_url().'assets/js/'.$nom.'.js';
}

/**
 * Cette fonction prend en entrée le nom d'un fichier csv
 * et retourne l'url du fichier dans l'application.
 *
 * @param String $nom Nom du fichier csv
 *
 * @return String Url du fichier csv dans l'application
 */
function Csv_url($nom)
{
    return base_url().'assets/csv/'.$nom.'.csv';
}

/**
 * Cette fonction prend en entrée le nom d'un fichier json
 * et retourne l'url du fichier dans l'application.
 *
 * @param String $nom Nom du fichier json
 *
 * @return String Url du fichier js dans l'application
 */
function Json_url($nom)
{
    return base_url().'assets/json/'.$nom.'.json';
}

/**
 * Cette fonction prend en entrée le nom d'une image avec son extension
 * et retourne l'url de l'image dans l'application.
 *
 * @param String $nom Nom de l'image
 *
 * @return String Url de l'image dans l'application
 */
function Img_url($nom)
{
    return base_url().'assets/img/'.$nom;
}

/**
 * Cette String fonction prend en entrée le nom d'un fichier svg
 * et retourne l'url du fichier dans l'application.
 *
 * @param String $nom Nom du fichier svg
 *
 * @return Url du fichier svg dans l'application
 */
function Svg_url($nom)
{
    return base_url().'assets/svg/'.$nom.'.svg';
}

/**
 * Cette fonction prend en entrée le nom d'une image, un champ alt et un titre
 * et retourne le code html pour l'insertion d'une image avec un champ alt et
 * un titre.
 *
 * La fonction Img_url ci-dessus est utilisée pour la source de l'image.
 *
 * @param String $nom     Nom de l'image
 * @param String $alt     Champ alt pour l'image
 * @param String $title   Titre de l'image
 * @param String $classes Classes ajoutées à la balise img
 *
 * @return String Code html correspondant à l'insertion d'une image,
 *                éventuellement avec un champ alt et un titre
 */
function img($nom, $alt = '', $title = '', $classes = '')
{
    if ($alt === '' && $title !=='') {
        $alt = $title;
    }
    if ($title === '' && $alt !=='') {
        $title = $alt;
    }
    $img_html = '<img ';
    $img_html.= 'src="'.Iimg_url($nom).'" ';
    $img_html.= 'alt="'.$alt.'" ';
    $img_html.= 'title="'.$title.'" ';
    $img_html.= 'class="'.$classes.'" ';
    $img_html.= '/>';
    return $img_html;
}

/**
 * Cette fonction prend en entrée le nom d'un fichier svg, un champ alt et un
 * titre et retourne le code html pour l'insertion d'une image avec un champ
 * alt et un titre.
 *
 * La fonction Svg_url ci-dessus est utilisée pour la source du fichier svg.
 *
 * @param String $nom     Nom du fichier svg
 * @param String $alt     Champ alt pour l'image
 * @param String $title   Titre de l'image
 * @param String $classes Classes ajoutées à la balise img
 *
 * @return String Code html correspondant à l'insertion d'un fichier svg,
 *                éventuellement avec un champ alt et un titre
 */
function svg($nom, $alt = '', $title = '', $classes = '')
{
    if ($alt === '' && $title !=='') {
        $alt = $title;
    }
    if ($title === '' && $alt !=='') {
        $title = $alt;
    }
    $svg_html = '<img ';
    $svg_html.= 'src="'.Svg_url($nom).'" ';
    $svg_html.= 'alt="'.$alt.'" ';
    $svg_html.= 'title="'.$title.'" ';
    $svg_html.= 'class="'.$classes.'" ';
    $svg_html.= '/>'
    return $svg_html;
}