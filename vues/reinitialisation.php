<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/reinitialisation.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Laboratoire</title>
</head>

<body>


<?php
session_start();
$titrePage = "Réinitialisation du mot de passe";
include "header.php";
?>


<div class="container">
    <script>
        var mailissent = "<?php echo $mailissent ?>";
        if (mailissent != "") {
            document.write(mailissent);
        }
    </script>
    <iv style="text-align:center">
        <form method="post" action="..\controleurs\reinitialisationMDP.php">
            <p>Veuillez entrer votre adresse e-mail :</p>
            <br>
            <input type="text" id="lname" name="lastname" placeholder="Adresse e-mail">

            <br> <br> <br>
            <div>
                <input type="submit" value="Réinitialiser mon mot de passe">
            </div>

</div>
</form>

<?php
include "footer.php";
?>

</body>
</html>
