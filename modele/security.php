<?php


function customCrypt($mdp)
{
    $saltS = "#3%";
    $saltD = strlen($mdp);
    $res = hash('sha512', $saltD . $mdp . $saltS);
    return $res;
}

function getLab($idSalle)
{

    $username = 'root';
    $password = '';

    $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $req = $conn->prepare('SELECT id_laboratoire FROM pieces WHERE idPieces=?');
    $req->execute(array($idSalle));
    return $req->fetch()['id_laboratoire'];
}

function getTypeUtilisateur($id)
{

    $username = 'root';
    $password = '';

    $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $req = $conn->prepare('SELECT type_employe FROM utilisateurs WHERE idUtilisateurs=?');
    $req->execute((array($id)));
    return $req->fetch()['type_employe'];
}

function checkSession()
{
    if (!isset($_SESSION['idUtilisateur'])) {
        header('Location: ../vues/accesRefuse.php');
    }
}

function controleAccesSalle($idLab, $salle, $idUtilisateur)
{

    $type = getTypeUtilisateur($idUtilisateur);

    return $idLab == getLab($salle) and ($type == 'personnel' or $type = 'gestionnaire');
}