<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Mes matières</title>

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
            <!--<div class="section1_partition3">
        

                
            </div>-->

        </section>
    </header>

    <?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=omnes_skills; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    ?>
    <section>
            
        <h1>Mes matières</h1>
        <?php
        $response =  $response = $bdd->query('SELECT * FROM matieres ORDER BY nomMat ASC');

        ?>
        <div class="casier">
            <?php
                while ($donnees = $response->fetch()) {
            ?>
                <a href="etudiant.php">
                    <div class="casier-container" id="<?php echo $donnees['nomMat']?>" name="<?php echo $donnees['nomMat']?>">
                        <div class="casier-titre">
                            <div class="casier-container-img"><img src="images/<?php echo iconv('UTF-8', 'ASCII//TRANSLIT',$donnees['nomMat']); ?>.jpg"></div>
                            <?php 
                            $nomMat = ucfirst($donnees['nomMat']);
                            echo $nomMat;?>

                        </div>
                    </div>
                </a>
            <?php
                }
            ?>
        </div>
    </section>
    <h2>Mes compétences associées</h2>
    <?php
    $response =  $response = $bdd->query('SELECT * FROM competences');
    
    ?>
    <div class="casier">
        <?php
            while ($donnees = $response->fetch()) {
        ?>
                <div class="casier-container"> 
                    <div class="casier-titre">
                        <?php echo $donnees['nomComp']; ?> 
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
    <div class="casier">
        <div class="casier-container">
            <p>Hello</p>
        </div>
        <div class="casier-container">
            <p>Hello</p>
        </div>
        <div class="casier-container">
            <p>Hello</p>
    </div>
</body>

</html>