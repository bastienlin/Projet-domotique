<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/inscription.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Laboratoire</title>
</head>

<body>


<?php
$titrePage = "Inscription";
include "header.php";
?>


<div id="centrale">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="inscription_1">
            <br/> <br/> <br/> <br/> <br/>
            <input type="text" name="nom" placeholder="Nom"/>
            <br/>
            <script>
                var nameErr = "<?php echo $nameErr ?>";
                if (nameErr != "") {
                    document.write(nameErr);
                }
                // On affiche les erreurs s'il y en a
            </script>

            <br/> <br/> <br/> <br/>

            <input type="text" name="prenom" placeholder="Prénom"/>
            <br/>
            <script>
                var prenomErr = "<?php echo $prenomErr ?>";
                if (prenomErr != "") {
                    document.write(prenomErr);
                }
            </script>

            <br/> <br/> <br/> <br/>

            <input type="email" name="email" placeholder="Adresse e-mail"/>
            <div class="err">
                <script>
                    var emailErr = "<?php echo $emailErr ?>";
                    if (emailErr != "") {
                        document.write(emailErr);
                    }
                </script>
            </div>
            <br/> <br/> <br/>


        </div>

        <div class="inscription_2">

            <div class="custom-select">
                <select id="activité" name="activite" onchange="hide();">
                    <option value="sélectionner">Activité</option>
                    <option value="personnel">Personnel</option>
                    <option value="gestionnaire">Gestionnaire</option>
                    <script>
                        var session = "<?php echo $_SESSION["type_employe"] ?>";
                        if (session == "administrateur") {
                            document.write('<option value="administrateur">Admistrateur Domisep</option>');
                        }
                        // On ajoute l'option uniquement si l'utilisateur est admin

                    </script>


                </select>
                <script>
                    var actiErr = "<?php echo $actiErr ?>";
                    if (actiErr != "") {
                        document.write(actiErr);
                    }
                </script>
            </div>
            <script>
                var labErr = "<?php echo $labErr ?>";
                if (labErr != "") {
                    document.write(labErr);
                }
            </script>

            <script>
                var session = "<?php echo $_SESSION["type_employe"] ?>";
                if (session == "administrateur") {
                    document.write('<div class="inscription_3" > <input type = "text" name = "laboratoire" placeholder = "Laboratoire" /> </div ></div >');
                }
            </script>


            <div class="button">
                <input type="submit" value="Inscrire un nouvel utilisateur"/>
            </div>


    </form>

</div>


<script>
    var x, i, j, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    for (i = 0; i < x.length; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < selElmnt.length; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function (e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        for (k = 0; k < y.length; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function (e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }

    function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }

    /*if the user clicks anywhere outside the select box,
    then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);
</script>


</body>

<?php
include "footer.php";
?>

</html>
