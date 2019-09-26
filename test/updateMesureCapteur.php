<?php
$username = "root";
$password = "";

try {
    $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $req = $conn->prepare('INSERT INTO donnees_capteur (id_capteur,valeur) VALUES (?,?)');
    $req->execute(array($_GET["id"], rand(20,25)));
} catch (PDOException $e) {
    echo $e->getMessage();
}
echo(rand(10, 30));
sleep(5);
header('Location: updateMesureCapteur.php?id='.$_GET["id"]);
