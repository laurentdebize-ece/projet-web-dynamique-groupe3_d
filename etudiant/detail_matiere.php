<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail d'une matière</title>
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

    if (isset($_GET['nomMat'])){
        $nomMat = $_GET['nomMat'];
    }
    else {
        
    }

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=omnes_skills; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $tabMatiere = $bdd->query('SELECT * FROM matieres');
    while ($matiere = $tabMatiere->fetch()){
        if ($matiere['nomMat'] == $nomMat){
            
            $tabCompetence = $bdd->query('SELECT * FROM competences JOIN matcomp ON competences.idCompetence = matcomp.IdCompetence AND matcomp.IdMat = ' . $matiere['idMat']);
            ?>
                <section>
                    <h1><?php echo ucfirst($matiere['nomMat']); ?></h1>
                    <div class="casier">
                        <?php
                            while ($competence = $tabCompetence->fetch()){
                        ?>
                                <a href="detail_competence.php?nomComp=<?php echo $competence['nomCompetence']; ?>&idComp=<?php echo $competence['idCompetence']; ?>">
                                    <div class="casier-container" id="<?php echo $competence['nomCompetence']; ?>" name="<?php echo $competence['nomCompetence']; ?>">
                                        <div class="casier-titre">
                                            <div class="casier-container-img">
                                                <?php 
                                                $imagePath = "images/competences/" . lcfirst(preg_replace("/[\p{P}]/u", "", iconv('UTF-8', 'ASCII//TRANSLIT', $competence['nomCompetence']))) . ".jpg";
                                                if (file_exists($imagePath)) {
                                                    echo '<img src="' . $imagePath . '">';
                                                } else {
                                                    echo '<img src="images/default.jpg">';
                                                }
                                                ?>
                                            </div>
                                            <?php 
                                            $nomCompetence = ucfirst($competence['nomCompetence']);
                                            echo $nomCompetence;
                                            ?>
                                        </div>
                                    </div>
                                </a>
                        <?php
                                
                            }
                        ?>
                    
                </section>
            <?php
        }
    };

    

    $tabMatComp = $bdd->query('SELECT * FROM matcomp ORDER BY idMat ASC');



    ?>

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
        $response = $bdd->query('SELECT * FROM matieres ORDER BY nomMat ASC');

        ?>
        <div class="casier">
            <?php
                while ($donnees = $response->fetch()) {
                    $nomMat = lcfirst(preg_replace("/[\p{P}]/u", "", iconv('UTF-8', 'ASCII//TRANSLIT', $donnees['nomMat'])));
            ?>
                <a href="detail_matiere.php?nomMat=<?php echo $donnees['nomMat'];?>">
                    <div class="casier-container" id="<?php echo $nomMat?>" name="<?php echo $nomMat?>">
                        <div class="casier-titre">
                            <div class="casier-container-img">
                                <?php 
                                    $imagePath = "images/matieres/" . lcfirst(preg_replace("/[\p{P}]/u", "", iconv('UTF-8', 'ASCII//TRANSLIT', $donnees['nomMat']))) . ".jpg";
                                    if (file_exists($imagePath)) {
                                        echo '<img src="' . $imagePath . '">';
                                    } else {
                                        echo '<img src="images/default.jpg">';
                                    }
                                ?>
                            </div>
                            <?php echo $donnees['nomMat'];?>
                        </div>
                    </div>
                </a>
            <?php
                }
            ?>
        </div>
    </section>
</body>

</html>