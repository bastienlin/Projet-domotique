<div>
    <header id="bloc_page">
        <div id="logo">
            <a href="..\index.php"><img src="../Images/LOGO-lab.png" alt="Logo e-Labify"/>
        </div>
        </a>

        <div id="titre_page">
            <h1><?php if (isset($titrePage)) {
                    echo $titrePage;
                } ?>
            </h1>
        </div>


        <nav class="utilisateur">
            <ul class="ulHeader">
                <?php if (isset($_SESSION["nom_utilisateur"])) {
                    echo '<h3 id="user"> ' . $_SESSION["nom_utilisateur"] . '</h3>

                <li><a href="../controleurs/espacePersonnel.php" class="headdd"><img src="../Images/Reglages.png" align="absmiddle" /> Options du compte</a></li>
                <li><a href="../controleurs/deconnexion.php" class="headdd"><img src="../Images/Deconnexion.png" align="absmiddle"  /> Déconnexion</a></li>';
                } ?>
            </ul>
        </nav>
    </header>
</div>