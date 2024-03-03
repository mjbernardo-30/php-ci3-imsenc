<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol'      => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host'     => EMAIL_SMTP, 
    'smtp_port'     => EMAIL_SMTP_PORT,
    'smtp_user'     => EMAIL,
    'smtp_pass'     => EMAIL_PASS,
    'smtp_crypto'   => EMAIL_SMTP_ENCRYPT, //can be 'ssl' or 'tls' for example
    'mailtype'      => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout'  => '4', //in seconds
    'charset'       => 'iso-8859-1',
    'wordwrap'      => TRUE,
    'newline'       => "\r\n"
);