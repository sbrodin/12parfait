<?php
if (!defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction permet l'envoi d'email avec interception en environnement de développement
  * @param $recipient   Destinataire de l'email
  * @param $subject     Sujet de l'email
  * @param $message     Corps de l'email
  * @return Bool Retourne TRUE si le mail a été accepté pour livraison, FALSE sinon.
  */
function send_email_interception($recipient, $subject, $message) {
    $headers = 'MIME-Version: 1.0' . PHP_EOL;
    $headers.= 'Content-type: text/html; charset=UTF8' . PHP_EOL;
    $headers.= 'From: 12 Parfait <no-reply@12parfait.fr>' . PHP_EOL;

    if (defined('EMAIL_INTERCEPTION')) {
        mail($recipient, $subject, $message, $headers);
        $subject.= ' - mail à destination originale de '.$recipient;
        $recipient = EMAIL_INTERCEPTION;
    }

    return mail($recipient, $subject, $message, $headers);
}