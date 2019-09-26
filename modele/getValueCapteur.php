<?php
$username = "root";
$password = "";

try {
    $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$result = $conn->prepare('SELECT valeur, date FROM donnees_capteur WHERE id_capteur=? ORDER BY date DESC');
$result->execute(array(htmlspecialchars($_POST["id_capteur"])));
$first = true;
foreach ($result as $row) {
    if ($first) {
        echo $row["valeur"];
        $first = false;
    }
}