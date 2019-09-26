<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/modifmdp.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Laboratoire</title>
</head>

<body>


<?php
$titrePage = "Modification du mot de passe";
include "header.php";
?>

</body>

<div class="container">
    <div style="text-align:center">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <br><br>
            <label for="lname">Ancien mot de passe :</label>
            <input style="width: 250px;height: 20px;border-radius: 4px;border-color: transparent;" type="password" id="oldmdp" name="oldmdp"><br>
            <br>
            <label for="lname">Nouveau mot de passe :</label>
            <input style="width: 250px;height: 20px;border-radius: 4px;border-color: transparent;" type="password" id="newmdp" name="newmdp"><br>
            <br>
            <label for="lname">Confirmation nouveau mot de passe :</label>
            <input style="width: 250px;height: 20px;border-radius: 4px;border-color: transparent;" type="password" id="newmdpverif" name="newmdpverif"><br> <br>
            <input type="submit" value="Modifier mon mot de passe"><br>
        </form>
        <script>
            var longErr = "<?php echo $longErr ?>";
            if (longErr != "") {
                document.write(longErr);
            }
        </script>
        <script>
            var mdpErr = "<?php echo $mdpErr ?>";
            if (mdpErr != "") {
                document.write(mdpErr);
            }
        </script>
        <script>
            var succes = "<?php echo $succes ?>";
            if (succes != "") {
                document.write(succes);
            }
        </script>
    </div>

</div>

<?php
include "footer.php";
?>

</body>
</html>
