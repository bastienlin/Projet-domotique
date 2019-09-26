<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/Options.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Réglages</title>
</head>

<?php
session_start();
$titrePage = "Configuration du Compte";
include "header.php";
?>

<div id="centrale">
    <form action="../Gestion_salle.html" method="get">
        <div class="inscription">
            <p>
                <br/> <br/> <br/> <br/>
                <input type="text" name="Nom" placeholder=" Ancien Nom"/>
                <br/>
                <input type="text" name="Nom" placeholder=" Nouveau Nom"/>
                <br/> <br/> <br/>

                <input type="text" name="Prénom" placeholder="Ancien Prénom"/>
                <br/>
                <input type="text" name="Prénom" placeholder="Nouveau Prénom"/>
                <br/> <br/> <br/>

                <input type="email" name="Adresse e-mail" placeholder="Ancien Adresse e-mail"/>
                <br/>
                <input type="email" name="Adresse e-mail" placeholder="Nouveau Adresse e-mail"/>
                <br/> <br/> <br/>

                <input type="password" name="pass" id="pass" placeholder="Ancien Mot de passe"/>
                <br/>
                <input type="password" name="pass" id="pass" placeholder="Nouveau Mot de passe"/>
                <input type="password" name="pass" id="pass" placeholder="Confirmation du Mot de passe"/>

                Au moins 8 lettres un 1 chiffre
                <br/> <br/> <br/>
            </p>

        </div>

        <label for="labo">Laboratoire de travail</label> <select id="labo" name="labo">
            <option value="labo1">Laboratoire 1</option>
            <option value="labo2">Laboratoire 2</option>
            <option value="labo3">Laboratoire 3</option>
            <option value="labo4">Laboratoire 4</option>
        </select>
        <br/> <br/> <br/>

        <div class="buton">

            <input type="submit" value="Mettre à jour"/>

        </div>

    </form>

    <div class="validation">
        <p>L'inscription ne sera qu'une fois que l'administrateur de votre laboratoire aura accepté votre profil</p>

    </div>
</div>

<?php
include "footer.php";
?>
</body>
</html>