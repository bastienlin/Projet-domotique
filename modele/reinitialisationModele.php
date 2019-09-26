<?php


include('security.php');

$e_mail = $_POST['lastname'];; // Déclaration de l'adresse de destination.
$objet = "mot de passe reinitialisé";


function chaine_aleatoire($nb_car, $chaine = 'azertyuiopqsdfghjklmwxcvbn123456789')
{
    $nb_lettres = strlen($chaine) - 1;
    $generation = '';
    for ($i = 0; $i < $nb_car; $i++) {
        $pos = mt_rand(0, $nb_lettres);
        $car = $chaine[$pos];
        $generation .= $car;
    }
    return $generation;
}

$newpassword = chaine_aleatoire(7);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '..\vendor\autoload.php';

$username = "root";
$password = "";
$dbname = "mvc";


// Create connection

try {
    $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$sql = "UPDATE utilisateurs SET mot_de_passe=? WHERE adresse_mail=?";
$req = $conn->prepare($sql);
$req->execute(array(customCrypt($newpassword), htmlspecialchars($e_mail)));


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
$mail->Subject = "Reinitialisation de votre mot de passe";
$mail->Body = "<html><head></head><body>Votre nouveau mot de passe est  $newpassword</body></html>";
$mail->AddAddress($e_mail);

if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    $mailissent = "Votre mot de passe a été réinitialisé. Veuillez consulter votre boîte mail.";
}

?>