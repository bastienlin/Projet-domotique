<?php

$mailsent = "";


if (isset($_POST['lastname']) and isset($_POST['subject']) and isset($_POST['firstname'])) {
    include "../modele/contactModele.php";
    $mailsent = sendmail($mailsent);
    if ($mailsent == "Votre message à été envoyé") {
        sendtouser();
    }
}



include "../vues/contactView.php";