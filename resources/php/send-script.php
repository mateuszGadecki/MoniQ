<?php

require_once 'swiftmailer/lib/swift_required.php';

$config = require_once 'send-script.php';
$userEmail = $_POST['userEmail'];
$name = filter_var ($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
$messageText = filter_var ($_POST['message'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
    $alert = 'Podaj poprawny email!';
    }
    else if (empty($name)){
        $alert = 'Podaje poprawne imię!!';
    }
    else if (empty($messageText)){
        $alert = 'Napisz coś!';
    }else {
        $transport = Swift_SmtpTransport::newInstance($config['mailServer'], $config['port'])
        ->setUsername($config['username'])
        ->setPassword($config['password']);

        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance($name)
        ->setFrom($userEmail)
        ->setReplyTo($userEmail)
        ->setTo($config['myEmail'])
        ->setBody($messageText);

        $emailSent = $mailer->send($message);

        if ($emailSent){
            $alert = 'Wysłano. Dzięki za wiadomość!';
        }
        else {
            $alert = 'Coś poszło nie tak.';
        }
    }

    $response = json_encode(array(
        'text' => $alert
    ));

    exit($response);

?>