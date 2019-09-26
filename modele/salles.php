<?php

function returnsalle()
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $req = $conn->prepare('SELECT idPieces,nom,type_piece FROM pieces WHERE id_laboratoire=?');
    $req->execute(array($_SESSION["idLaboratoire"]));

    return $req;
}

function returnNameSalle($id)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $req = $conn->prepare('SELECT nom FROM pieces WHERE idPieces=?');
    $req->execute(array($id));
    foreach ($req as $row) {
        return $row["nom"];
    }

}

function ajoutsalle()
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $req = $conn->prepare('INSERT INTO pieces (nom,id_laboratoire,type_piece) VALUES (?, ?, ?)');
        $req->execute(array(htmlspecialchars($_POST["nomSalle"]), $_SESSION["idLaboratoire"], htmlspecialchars($_POST["typeSalle"])));

        return "Nouvelle Salle créée";
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function supprimerSalle($id)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $result = $conn->prepare('DELETE FROM pieces WHERE idPieces=?');
    $result->execute(array($id));

    $result = $conn->prepare('DELETE FROM capteur WHERE idPieces=?');
    $result->execute(array($id));

    return $result;
}

?>