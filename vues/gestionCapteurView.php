<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/Gestion_Capteur.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Salle d'analyse</title>
</head>

<body id="taille">
<?php
$titrePage = "Gestion de la température";
include "header.php";
?>

<div class="todos">

    <div class="main">

        <div class="image2">
            <img src="../Images/Termomètre.png" class="ico_categorie" align="absmiddle"/> Température dans la pièce :
            <h id="temp"><?php echo getDerniereMesure($_GET["capteur"])?> </h>
            <h> °C</h>
            <script>
                var h = document.getElementById('temp').textContent;
                if (h == " "){
                    window.alert("Aucune donnée reçue, il est possible que vous ayez mal configuré votre capteur.  \n" +
                        "Si vous n'arrivez pas à la faire fonctionner merci de contacter le service client.");
                }
            </script>

            <br/>

            <div class="text_reglage_auto"> Activer / Désactiver le réglage automatique :
                <label class="switch">
                    <input type="checkbox" id="<?php echo $_GET["capteur"] ?>"
                           onchange="actionneurChange(<?php echo $_GET['capteur'] ?>)" <?php if (getValsActionneur($_GET["capteur"]) == 1) {
                        echo ' checked=true';
                    } ?> ">
                    <span class="slider round"></span>
                </label>
            </div>

            <label for="temperature" class="boutonTemp">Définir le seuil de température : <input type="number" id="temperature"
                                                                              name="temperature" min="0" max="50"
                                                                              value="20" onKeyDown="return false">  °C</label>
            <br><label for="nbValeurs" class="boutonTemp">Nombre de valeurs maximum affichées : <input type="number" id="nbValeurs"
                                                                              name="nbValeurs" min="1" max="1000"
                                                                              value="10" onKeyDown="return false"> </label>
        </div>


        <?php
        $i=0;
        $result=getMesures($_GET["capteur"]);
        $array = [];
        $dataPoints=[];
        foreach ( $result as $row )
        {
            if ($i == 10) {
                break 1;
            }
            $i = $i + 1;
            array_push($dataPoints, array("x" => (strtotime($row["date"]) - 7200) * 1000, "y" => $row["valeur"]));
        }

        ?>
            <script >
                function getXMLHttpRequest() {
                    var xhr = null;

                    if (window.XMLHttpRequest || window.ActiveXObject) {
                        if (window.ActiveXObject) {
                            try {
                                xhr = new ActiveXObject("Msxml2.XMLHTTP");
                            } catch (e) {
                                xhr = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                        } else {
                            xhr = new XMLHttpRequest();
                        }
                    } else {
                        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
                        return null;
                    }
                    return xhr;
                }

                function actionneurChange(id) {
                    var xhr = getXMLHttpRequest();

                    xhr.open("POST", "../modele/changeValActionneur.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    if (document.getElementById(id).checked) {
                        xhr.send("id_capteur=" + id + "&valeur=1&seuil="+document.getElementById("temperature").value);

                    } else {
                        xhr.send("id_capteur=" + id + "&valeur=0");
                    }
                }

                window.onload = function () {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        title:{
                            text: "Dernières mesures de température"
                        },
                        axisY: {
                            title: "Temperature en °C",
                        },
                        axisX: {

                            valueFormatString: "D MMM H:m:s" ,
                        },
                        data: [{
                            xValueType: "dateTime",
                            type: "spline",
                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });

                    chart.render();

                    function actualiseTemperature(id) {
                        var xhr = getXMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                                document.getElementById("temp").innerText = xhr.responseText;
                            }
                        };

                        xhr.open("POST", "../modele/getValueCapteur.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send("id_capteur=" + id);
                    }

                    function actualiseGraphique(id) {
                        var xhr = getXMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                                datap = xhr.responseText;
                                chart.options.data[0].dataPoints = JSON.parse(datap);
                                chart.render();
                            }
                        };

                        xhr.open("POST", "../modele/getValuesCapteur.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send("id_capteur=" + id+"&nbValeurs="+document.getElementById("nbValeurs").value);

                    }

                    function actualisation() {
                        setTimeout(function () {
                            actualiseTemperature(<?php echo $_GET["capteur"]; ?>);
                            actualiseGraphique(<?php echo $_GET["capteur"]; ?>);
                            actualisation();
                        }, 3000)
                    }

                    actualisation();

                }
            </script>

        <div id="chartContainer" style="height: 370px; width: 60%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </div>




    <nav>
        <ul class="menu">
            <h3 class="titreMenu">PIECES</h3>
            <?php afficheSallesMenu(); ?>
            <h3 class="titreMenu">Options</h3>
            <?php
            if ($_SESSION["type_employe"] == "gestionnaire") {
                echo('<li><a href="../controleurs/ajoutSalle.php" class="navMenu">Ajouter une salle </a></li>');
            } ?>
            <li><a href="../controleurs/gestionSalle.php?salle=<?php echo $_GET["salle"] ?>" class="navMenu">Retour</a></li>
        </ul>
    </nav>


</div>


<?php
include "footer.php";
?>
</body>
</html>