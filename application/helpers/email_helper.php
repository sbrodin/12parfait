<?php
if ( !defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
  * Cette fonction permet l'envoi d'email avec interception en environnement de développement
  * @param $recipient   Destinataire de l'email
  * @param $subject     Sujet de l'email
  * @param $message     Corps de l'email
  * @return Bool Retourne TRUE si le mail a été accepté pour livraison, FALSE sinon.
  */
if ( ! function_exists('send_email_interception'))
{
    /**
     * Send an email with interception
     *
     * @deprecated  3.0.0   Use PHP's mail() instead
     * @param   string  $recipient
     * @param   string  $subject
     * @param   string  $message
     * @return  bool
     */
    function send_email_interception($recipient, $subject, $message)
    {
        if (defined('EMAIL_INTERCEPTION')) {
            $recipient = EMAIL_INTERCEPTION;
        }
        return mail($recipient, $subject, $message);
    }
}