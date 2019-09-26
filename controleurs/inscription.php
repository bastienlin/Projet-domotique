<?php


include "../modele/inscriptionmodele.php";
include('../modele/security.php');

session_start();
checkSession();
// verification d'acces il faut que l'utilisateur soit admin ou gestionnaire pour acceder à la page
if (getTypeUtilisateur($_SESSION['idUtilisateur']) == 'administrateur' or getTypeUtilisateur($_SESSION['idUtilisateur']) == 'gestionnaire') {

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nameErr = $prenomErr = $emailErr = $mdpErr = $verifErr = $labErr = $actiErr = "";
    $name = $prenom = $email = $mdp = $verif = $lab = "";

//On execute un scirpt uniquement si le formulaire à été rempli
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["prenom"])) {
            $prenomErr = "Le prénom est requis";
        } else {
            $prenom = test_input($_POST["prenom"]);
        }

        if (empty($_POST["nom"])) {
            $nameErr = "Le nom est requis";
        } else {
            $name = test_input($_POST["nom"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "L'adresse e-mail est requise";
        } else {
            $email = test_input($_POST["email"]);
        }

        $prenom = test_input($_POST["prenom"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $prenom)) {
            $prenomErr = "Seuls les lettres et les espaces sont autorisés";
        }

        $name = test_input($_POST["nom"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Seuls les lettres et les espaces sont autorisés";
        }
        if ($_POST["activite"] != "personnel" and $_POST["activite"] != "gestionnaire" and $_POST["activite"] != "administrateur") {
            $actiErr = "Veuillez selectionner une activité";
        }

        $email = test_input($_POST["email"]);
        $emailErr = verifmail($bdd, $email, $emailErr);
//On verifie si le mail est déja présent dans la bdd

        if ($_SESSION["type_employe"] == "administrateur") {
            if (empty($_POST["laboratoire"])) {
                $labErr = "Le laboratoire est requis";
            } else {
                $lab = test_input($_POST["laboratoire"]);
            }
        }
        $idlab = "";

        if ($_POST["activite"] == "administrateur") {
            $lab = "Domisep";
            $labErr = "";
        } else {
            $idlab = $_SESSION["idLaboratoire"];
        }
//nous executons la requete d'inscription uniquement s'il n'y a aucune erreur
        if ($prenomErr != "") {
        } else if ($actiErr != "") {
        } elseif ($nameErr != "") {
        } elseif ($emailErr != "") {
        } elseif ($verifErr != "") {
        } elseif ($labErr != "") {
        }else if ($_SESSION["type_employe"] != "administrateur"){
            $mdp = chaine_aleatoire(7);
            inscriptionbdd($name, $prenom, $bdd, $email, $mdp, $idlab);
        } else {
            $verif = veriflab($bdd, $lab);

            if ($verif["nom"] == null) {
                ajoutelab($bdd, $lab);
                $verif = veriflab($bdd, $lab);
            }
            $idlab = $verif["idLaboratoire"];
            $mdp = chaine_aleatoire(7);
            inscriptionbdd($name, $prenom, $bdd, $email, $mdp, $idlab);
        }
    }
    include "../vues/inscriptionView.php";

} else {
    header('Location: ../vues/accesRefuse.php');
}