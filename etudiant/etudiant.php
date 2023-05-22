<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Accueil étudiant</title>

    <link rel="stylesheet" href="../style.css">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    function showOption(n){
        let options = document.getElementsByClassName("options");
        let cartes = document.getElementsByClassName("carte-container");
        for (let i = 0; i < options.length; i++) {
            let option = options[i];
            option.style.display = "none";
            if (i == n - 1) {
                option.style.display = "block"; 
            }
        }
        return n;
    }

    $(document).ready(function () {
        var carte_selectionnee = showOption(0);
        console.log(carte_selectionnee);
        $(".carte1").click(function () {
            if ($(this).hasClass("carte_selectionnee")) {
                carte_selectionnee = showOption(0);
            }
            else carte_selectionnee = showOption(1);
            console.log(carte_selectionnee);
        });
        $(".carte2").click(function () {
            if ($(this).hasClass("carte_selectionnee")) {
                carte_selectionnee = showOption(0);
            }
            else carte_selectionnee = showOption(2);
            console.log(carte_selectionnee);
        });
        $(".carte3").click(function () {
            if ($(this).hasClass("carte_selectionnee")) {
                carte_selectionnee = showOption(0);
            }
            else carte_selectionnee = showOption(3);
            console.log(carte_selectionnee);
        });
        $(".carte4").click(function () {
            if ($(this).hasClass("carte_selectionnee")) {
                carte_selectionnee = showOption(0);
            }
            else carte_selectionnee = showOption(4);
            console.log(carte_selectionnee);
        });
    });
</script>

<body>
    <header>
        <section id="section1">
            <div class="section1_partition1">
                <div class="partition1_head">
                    <div class="img_container">
                        <div class="img"> </div>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="mes_matieres.php">Mes matières</a></li>
                            <li><a href=".php">Mes évaluations</a></li>
                            <li><a href=".php">Evaluations à venir</a></li>
                        </ul>
                    </nav>
                </div>
                <h1 class="welcom_mess">Omnes Skills</h1>
            </div>
            <div class="section1_partition2">
                <div class="carte-container">
                    <div class="carte carte1">

                        <div class="carte_img carte_img1">

                        <a href="mes_matieres.php"><h3>Mes matières</h3></a>

                        </div>

                    </div>
                    <div class="carte carte2">

                        <div class="carte_img carte_img2">
                        <a href=".php"><h3>Mes évaluations</h3></a>
                        </div>

                    </div>
                    <div class="carte carte3">

                        <div class="carte_img carte_img3">

                        <a href=".php"><h3>Évaluations à venir</h3></a>

                        </div>
                    </div>
                    <div class="carte carte4">

                        <div class="carte_img carte_img4">
                        <a href="mon_espace.php"><h3>Mon espace</h3></a>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        
    </header>
    <section>
    <?php
    // Afficher le nom et prenom de la personne connectee
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    echo "<h1>Bienvenue $prenom ".str_replace('_', ' ',$nom)."</h1>";

    ?>
        <div class="options" id="option-1" name="matieres">
            <div class="option_title">
                <h2>Mes matières</h2>
                
            </div>
        </div>
        <div class="options" id="option-2" name="evaluations">
            <div class="option_title">
                <h2>Mes évaluations</h2>  
            </div>
        </div>
        <div class="options" id="option-3" name="evaluations_a_venir">
            <div class="option_title">
                <h2>Évaluations à venir</h2>  
            </div>
        </div>
        <div class="options" id="option-4" name="mon_espace">
            <div class="option_title">
                <h2>Mon espace</h2>  
            </div>
        </div>
        
    </section>
</body>

</html>