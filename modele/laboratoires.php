<?php
function getNameLaboratoire($idLabo)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $req = $conn->prepare('SELECT nom FROM laboratoire WHERE idLaboratoire=?');
    $req->execute(array($idLabo));
    $result = $req->fetch();
    return $result["nom"];
}

function getNumEmployes($idLabo)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    if ($idLabo != 0) {
        $req = $conn->prepare('SELECT COUNT(*) AS num FROM utilisateurs WHERE idLaboratoire=?');
    } else {
        $req = $conn->prepare('SELECT COUNT(*) AS num FROM utilisateurs');
    }
    $req->execute(array($idLabo));
    $result = $req->fetch();
    return $result["num"];
}

function getNumSalles($idLabo)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    if ($idLabo != 0) {
        $req = $conn->prepare('SELECT COUNT(*) AS num FROM pieces WHERE id_laboratoire=?');
    } else {
        $req = $conn->prepare('SELECT COUNT(*) AS num FROM pieces');
    }
    $req->execute(array($idLabo));
    $result = $req->fetch();
    return $result["num"];
}

function getNumCapteurs($idLabo)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    if ($idLabo != 0) {
        $req = $conn->prepare('SELECT COUNT(capteur.id_capteur) AS num from capteur JOIN pieces ON (capteur.idPieces=pieces.idPieces)  WHERE id_laboratoire= ?');
    } else {
        $req = $conn->prepare('SELECT COUNT(*) AS num FROM capteur');
    }


    $req->execute(array($idLabo));
    $result = $req->fetch();
    return $result["num"];
}

function getNumLabs()
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $req = $conn->prepare('SELECT COUNT(*) AS num from laboratoire ');
    $req->execute(array());
    $result = $req->fetch();
    return $result["num"] - 1;
}

?>

