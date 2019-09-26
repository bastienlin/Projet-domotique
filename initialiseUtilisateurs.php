<?php

include('modele/security.php');


$bdd = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$req = $bdd->prepare('INSERT INTO utilisateurs (nom_utilisateur, adresse_mail, mot_de_passe, type_employe, idLaboratoire )VALUES(?, ?, ?, ?, ?)');
$req->execute(array('Utilisateur 3', 'utilisateur3@mail.com', customCrypt('motdepasse'), 'administrateur', 0));
$req->execute(array('Utilisateur 2', 'utilisateur2@mail.com', customCrypt('motdepasse'), 'gestionnaire', 1));
$req->execute(array('Utilisateur 1', 'utilisateur1@mail.com', customCrypt('motdepasse'), 'personnel', 1));

?>