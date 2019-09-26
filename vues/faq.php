<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/faq.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Laboratoire</title>
</head>


<body>

<?php
session_start();
$titrePage = "Questions & Réponses";
include "header.php";
?>

<div class="all">

<section class="faq-section">
    <input type="checkbox" id="q1">
    <label for="q1">Qui sommes-nous ?</label>
    <p>Nous sommes une entreprise internationale ayant pris en charge divers projets dont celui de laboratoires connectés.</p>
</section>

<section class="faq-section">
    <input type="checkbox" id="q2">
    <label for="q2">Quel service proposons-nous ?</label>
    <p>Nous proposons une gestion informatisée de laboratoires d'analyse avec l'utilisation de capteurs et d'actionneurs
        installés dans ceux-ci. Vous aurez accès à la température de vos salles en temps réel, pourrez gérer la sécurité
        de vos locaux, rendre l'éclairage dynamique, connaître l'occupation de vos locaux, etc. Notre solution est
        hautement personnalisable pour s'adapter à tous vos besoins.</p>
</section>

<section class="faq-section">

    <input type="checkbox" id="q3">
    <label for="q3">Pourquoi choisir e-labify ?</label>
    <p>Avec e-labify, votre laboratoire bénéficiera d'un système fiable et innovant afin de faciliter toutes vos taches nécessaires.</p>

</section>

<section class="faq-section">
    <input type="checkbox" id="q4">
    <label for="q4">Quelles sont les droits de chaque utilisateur ?</label>
    <p>Tout utilisateur dispose d’un droit d’accès, de rectification, de suppression et d’opposition aux données personnelles le concernant.</p>


</section>

<section class="faq-section">
    <input type="checkbox" id="q5">
    <label for="q5">Comment installer votre système dans notre laboratoire ?</label>
    <p>Suite à une demande à un administrateur, celui-ci pourra prendre en charge le client selon ses besoins</p>

</section>

<section class="faq-section">
    <input type="checkbox" id="q6">
    <label for="q6">Que faire en cas de panne de composants ?</label>
    <p>En cas de panne de composants, l'administrateur doit être signalé via le service client afin qu'il puisse faire la démarche de réparation</p>

</section>

</div>

</body>

<?php
include "footer.php";
?>