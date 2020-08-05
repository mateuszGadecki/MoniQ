<?php

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $to = "kontakt@moniq-reda.pl";
    $subject = "Nowy email od: < $name > , adres email: < $email > ";
    $headers = 'From: ' . $name . ' <odpowiedz@moniq-reda.pl>' . "\r\n" .
        'Reply-to: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion() . "\r\n" .
        "Content-Type: text/plain; charset=utf-8";

mail($to, $subject, $message, $headers);

?>