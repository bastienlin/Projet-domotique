<?php


//connexion à la base de données:

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '..\vendor\autoload.php';

try {

    $bdd = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


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

// define variables and set to empty values
$nameErr = $prenomErr = $emailErr = $mdpErr = $verifErr = "";
$name = $prenom = $email = $mdp = $verif = "";


function verifmail($bdd, $email, $emailErr)
{
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE 	adresse_mail=? LIMIT 1');
    $req->execute(array(htmlspecialchars($email)));
    $resultat = $req->fetch();
    if ($resultat["adresse_mail"] != "") {
        $emailErr = "Cette adresse e-mail est déjà utilisée.";
    }
    return $emailErr;


    /*
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Adresse e-mail invalide";
        } elseif($resultat != 0){
            //on vérifie que cette adresse mail n'est pas déjà utilisée par un autre membre
            $emailErr = "Cette adresse e-mail est déjà utilisée.";
        }
    */

}

function veriflab($bdd, $lab)
{
    $req = $bdd->prepare('SELECT * FROM laboratoire WHERE 	nom=? LIMIT 1');
    $req->execute(array(htmlspecialchars($lab)));
    return $req->fetch();
}

function ajoutelab($bdd, $lab)
{
    $req = $bdd->prepare('INSERT INTO laboratoire (nom)VALUES(?)');
    $req->execute(array(htmlspecialchars($lab)));

}

function inscriptionbdd($name, $prenom, $bdd, $email, $mdp, $idlab)
{

    try {
        $name = $prenom . ' ' . $name;

        $req = $bdd->prepare('INSERT INTO utilisateurs (nom_utilisateur, adresse_mail, mot_de_passe, type_employe, idLaboratoire )VALUES(?, ?, ?, ?, ?)');
        $req->execute(array(htmlspecialchars($name), htmlspecialchars($email), customCrypt($mdp), htmlspecialchars($_POST['activite']), $idlab));

    } catch (Exception $e) {
        echo $e->getMessage();
    }

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
    $mail->Subject = "Bienvenue sur elabify ";
    $mail->Body = "<html><head></head><body>Votre compte elabify a ete cree votre mot de passe est $mdp vous pouvez le modifier dans les
 options de votre compte</body></html>";
    $mail->AddAddress($email);

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
    }
}

?>





