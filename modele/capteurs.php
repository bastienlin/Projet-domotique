<?php
function returncapteurs()
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $result = $conn->prepare('SELECT capteur_type, id_capteur FROM capteur WHERE idPieces=?');
    $result->execute(array(htmlspecialchars($_GET["salle"])));

    return $result;
}

function ajoutCapteur()
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $result = $conn->prepare('SELECT capteur_type, id_capteur FROM capteur WHERE capteur_type=? AND idPieces=?');
        $result->execute(array(htmlspecialchars($_POST["typeCapteur"]), htmlspecialchars($_GET["salle"])));

        foreach ($result as $row) {
            if ($row["id_capteur"] != null) {
                return "Vous ne pouvez pas ajouter plusieurs capteurs de même type dans une même salle";
            }
        }
        $req = $conn->prepare('INSERT INTO capteur (capteur_type, idPieces) VALUES (?,?)');
        $req->execute(array(htmlspecialchars($_POST["typeCapteur"]), htmlspecialchars($_GET["salle"])));

        return "Nouveau capteur créé";
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getDerniereMesure($idCapteur)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $result = $conn->prepare('SELECT valeur, date FROM donnees_capteur WHERE id_capteur=? ORDER BY date DESC');
    $result->execute(array(htmlspecialchars($idCapteur)));
    foreach ($result as $row) {
        return $row["valeur"];
    }
}

function getMesures($idCapteur)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $result = $conn->prepare('SELECT valeur, date FROM donnees_capteur WHERE id_capteur=? ORDER BY date DESC');
    $result->execute(array(htmlspecialchars($idCapteur)));
    return $result;
}

function getValsActionneur($idCapteur)
{
    $username = "root";
    $password = "";
    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    while (true) {
        $result = $conn->prepare('SELECT * FROM actionneur WHERE id_capteur=?');
        $result->execute(array(htmlspecialchars($idCapteur)));
        if ($result->rowCount() > 0) {
            foreach ($result as $row) {
                return $row["etat"];
            }
        } else {
            try {
                $req = $conn->prepare('INSERT INTO actionneur (id_capteur) VALUES (?)');
                $req->execute(array(htmlspecialchars($idCapteur)));
                return 0;
            } catch (PDOException $e) {
            }
        }
    }
}

function supprimerCapteur($id)
{
    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $result = $conn->prepare('DELETE FROM capteur WHERE id_capteur=?');
    $result->execute(array($id));

    $result = $conn->prepare('DELETE FROM donnees_capteur WHERE id_capteur=?');
    $result->execute(array($id));

    $result = $conn->prepare('DELETE FROM actionneur WHERE id_capteur=?');
    $result->execute(array($id));
}

?>