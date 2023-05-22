<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails d'une compétences</title>
    <link rel="stylesheet" href="style.css">
</head>

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
                            <li><a href="etudiant.php">Accueil</a></li>
                            <li><a href="competences.php">Mes compétences</a></li>
                            <li><a href="transverses.php">Compétences transverses</a></li>
                            <li><a href="eval.php">S'auto-évaluer</a></li>
                        </ul>
                    </nav>
                </div>
                <h1 class="welcom_mess">Omnes Skills</h1>
            </div>
            <div class="section1_partition2">
                <div class="carte-container">
                    <div class="carte carte1">

                        <div class="carte_img carte_img1">

                        <a href="etudiant.php"><h3>Accueil</h3></a>

                        </div>

                    </div>
                    <div class="carte carte2">

                        <div class="carte_img carte_img2">
                        <a href="eval.php"><h3>S'auto-évaluer</h3></a>

                        </div>

                    </div>
                    <div class="carte carte3">

                        <div class="carte_img carte_img3">

                        <a href="transverses.php"><h3>Compétences Transverses</h3></a>

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

    <?php
    if(isset($_GET['nomComp']) && isset($_GET['idComp'])){
        $nomCompSelect = $_GET['nomComp'];
        $idCompSelect = $_GET['idComp'];
        echo "<br>idComp : " . $idCompSelect . "<br>nomComp : " . $nomCompSelect;
    }
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=omnes_skills; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    ?>
</body>
</html>