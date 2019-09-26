<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/contact.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Laboratoire</title>
</head>

<body>


<?php
session_start();
$titrePage = "Contact";
include "header.php";
?>


<div class="container">
    <div style="text-align:center">
        <h2>Nous contacter?</h2>
        <p>Veuillez remplir le formulaire ci-dessous:</p>
    </div>
    <div class="row">
        <div class="column">
            <img src="../Images/banniere_contact.jpg" style="width:100%">
        </div>
        <div class="column">
            <form method="post" action="..\controleurs\contact.php">
                <label for="fname">Objet</label>
                <input type="text" id="fname" name="firstname">
                <label for="lname">Adresse e-mail</label>
                <input type="text" id="lname" name="lastname"> <br> <br>
                <textarea id="subject" name="subject" placeholder="Contenu de votre message..."
                          style="height:170px"></textarea>
                <input type="submit" value="Envoyer">
            </form>
            <script>
                var mailsent = "<?php echo $mailsent ?>";
                if (mailsent != "") {
                    document.write(mailsent);
                    //verification de si un mail à ete envoyé
                }
            </script>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>

</body>
</html>
