<?php
$id_capteur = $_POST["id_capteur"];
$value = $_POST["valeur"];
$username = "root";
$password = "";
try {
    $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST["seuil"])) {
    $req = $conn->prepare('UPDATE actionneur SET etat= :etat, seuil= :seuil WHERE id_capteur= :id');
    $req->execute(array('etat' => $value, 'id' => htmlspecialchars($id_capteur), 'seuil' => htmlspecialchars($_POST["seuil"])));
}
$req = $conn->prepare('UPDATE actionneur SET etat= :etat WHERE id_capteur= :id');
$req->execute(array('etat' => $value, 'id' => htmlspecialchars($id_capteur)));
if($_POST["id_capteur"]==1){

}
if($id_capteur==20 AND $value==1) {
    $trame = "1011A11040001BABA91";
}
else if($id_capteur==20 AND $value==0) {
    $trame = "1011A11040000BABA90";
}
else if($id_capteur==23 AND $value==1) {

    $trame = "1011A1:020001BABA98";
}
else if($id_capteur==23 AND $value==0) {
    $trame = "1011A1:020000BABA97";
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=011A&TRAME=".$trame);
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$ans = curl_exec($ch);

curl_close($ch);