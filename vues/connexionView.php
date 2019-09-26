<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/page-de-connexion.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Accueil</title>
</head>

<body id="taille">
<?php
include "header.php";
?>

<div class="row">
    <div class="column left">
        <div class="centrer">
            <h3>Quel service proposons-nous?</h3>
            <h>Nous proposons une gestion informatisée de laboratoires d'analyse avec l'utilisation de capteurs et
                d'actionneurs installés dans ceux-ci.
                Vous aurez accès à la température de vos salles en temps réel, pourrez gérer la sécurité de vos locaux,
                rendre l'éclairage dynamique, connaître l'occupation de vos locaux, etc.
            </h>
            <h>Notre solution est hautement personnalisable pour s'adapter à tous vos besoins.</h>
            <br/> <br/> <br/>
            <div class="centre">
                <img src="..\Images\accueil_image.png" id="image">
            </div>

        </div>
    </div>
    <div class="column right">
        <div class="centrer">
            <div id="encart">
                <form method="post" action="../controleurs/connexion.php">
                    <label for="mail">Mail</label>
                    <input type="text" id="email" name="email" placeholder="Your email..">

                    <label for="pass">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password..">
                    <br/><br/>

                    <input type="submit" value="Connexion">
                </form>
            </div>
            <div id="encart2">
                <?php
                if (isset($err)) {
                    echo "<h class='erreur'>" . htmlspecialchars($err) . "<h></br><br/>";
                }
                ?>
                <a href="../controleurs/reinitialisationMDP.php">Mot de passe oublié?</a>

            </div>
        </div>
    </div>

</div>


<?php
include "footer.php";
?>

</body>
</html>
