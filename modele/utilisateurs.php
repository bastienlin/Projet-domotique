<?php
function returnutilisateursLab()
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    if ($_SESSION["idLaboratoire"] == 0) {
        $sql = 'SELECT * FROM utilisateurs WHERE  idUtilisateurs!="' . $_SESSION["idUtilisateur"] . '"';
        $result = $conn->prepare('SELECT * FROM utilisateurs WHERE  idUtilisateurs!=?');
        $result->execute(array($_SESSION["idUtilisateur"]));
    } else {
        $result = $conn->prepare('SELECT * FROM utilisateurs WHERE idLaboratoire=? AND idUtilisateurs!=?');
        $result->execute(array($_SESSION["idLaboratoire"], $_SESSION["idUtilisateur"]));
    }

    return $result;
}

function supprimerUtilisateur($id)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $result = $conn->prepare('DELETE FROM utilisateurs WHERE idUtilisateurs=?');
    $result->execute(array($id));

    return $result;
}