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


$i = 0;
$dataPoints = [];
foreach ($result as $row) {
    if ($i == $_POST["nbValeurs"]) {
        break 1;
    }
    $i = $i + 1;
    array_push($dataPoints, array("x" => (strtotime($row["date"]) - 7200) * 1000, "y" => $row["valeur"]));
}


echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
