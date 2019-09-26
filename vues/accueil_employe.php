<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/accueil_employe.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Salle d'analyse</title>
</head>

<body id="taille">
<div id="bloc_page">
    <header>
        <div id="logo">
            <a href="#"><img src="../Images/LOGO-lab.png" alt="Logo e-Labify"/>
        </div>
        </a>

        <div id="titre_page">
            <h1>Bienvenue </h1>
        </div>


        <nav class="utilisateur">
            <ul>
                <h3>Arnaud M.</h3> <!--C'est quoi ca ??? -->

                <li><a href="#"><img src="../Images/Reglages.png" align="absmiddle"/> Options du compte</a></li>

                <li><a href="#"><img src="../Images/Deconnexion.png" align="absmiddle"/> Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="main">
            <div class="image1">
                <a href="../Gestion_salle.html">
                    <img src="../Images/iconelab.png" class="ico_categorie" align="absmiddle"/> Laboratoire
                </a>
            </div>


            <div class="image2">
                <a href="../Gestion_salle.html">
                    <img src="../Images/Statistic-icon.png" class="ico_categorie" align="absmiddle"/> Statistique
                </a>
            </div>

            <div class="image3">
                <a href="../Gestion_salle.html">
                    <img src="../Images/Sécurité.png" class="ico_categorie" align="absmiddle"/> Sécurité
                </a>
            </div>


        </div>


    </section>
</div>

<?php
include "footer.php";
?>
</body>
</html>
