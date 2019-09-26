<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '..\vendor\autoload.php';

function sendmail($mailsent)
{
    $email = $_POST['lastname'];
    $subject = $_POST["subject"];
    $mail = 'arnaud.mathey92@gmail.com'; // Déclaration de l'adresse de destination.
    $objet = $_POST['firstname'];


    $mail = new PHPMailer(); // create a new object
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "e.labify.APP@gmail.com";
    $mail->Password = "APPG11Amail";
    $mail->SetFrom("e.labify.APP@gmail.com");
    $mail->Subject = "Contactelabyfi";
    $mail->Body = "<html><head></head><body>envoyé par $email pour $objet: $subject </body></html>";
    $mail->AddAddress("arnaud.mathey92@gmail.com");

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        $mailsent = "Erreur lors de l'envoie de votre requete";
    } else {
        $mailsent = "Votre message à été envoyé";
    }

    return $mailsent;
}



function sendtouser()
{
    $email = $_POST['lastname'];
    $mail2 = new PHPMailer(); // create a new object
    $mail2->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail2->IsSMTP(); // enable SMTP
    $mail2->SMTPAuth = true; // authentication enabled
    $mail2->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail2->Host = "smtp.gmail.com";
    $mail2->Port = 587; // or 587
    $mail2->IsHTML(true);
    $mail2->Username = "e.labify.APP@gmail.com";
    $mail2->Password = "APPG11Amail";
    $mail2->SetFrom("e.labify.APP@gmail.com");
    $mail2->Subject = "Contactelabyfi";
    $mail2->Body = "<html><head></head><body>Votre demande à été prise en compte nos équipe y répondront dès que possible </body></html>";
    $mail2->AddAddress($email);


}

