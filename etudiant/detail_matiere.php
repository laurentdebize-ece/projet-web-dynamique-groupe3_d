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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#retour').click(function () {
            window.location.href = "mes_matieres.php";
        });
    });
</script>


<body>
    
    <?php
    
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=omnes_skills;
    charset=utf8',
            'root',
            'root',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (Exception $e) {
        try {
            $bdd = new PDO(
                'mysql:host=localhost;dbname=omnes_skills;
        charset=utf8',
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    if (isset($_GET['nomMat'])){
        $nomMat = $_GET['nomMat'];
    }
    else {
        
    }
    
    $tabMatiere = $bdd->query('SELECT * FROM matieres');
    while ($matiere = $tabMatiere->fetch()){
        if ($matiere['nomMat'] == $nomMat){
            
            $tabCompetence = $bdd->query('SELECT * FROM competences JOIN matcomp ON competences.idCompetence = matcomp.IdCompetence AND matcomp.IdMat = ' . $matiere['idMat'] . ' ORDER BY competences.nomCompetence ASC');
            ?>
                <div class='casier-compte'>
                    <h1><?php echo ucfirst($matiere['nomMat']); ?></h1>
                    <div class="casier">
                        <?php
                            if ($tabCompetence->rowCount()==0){
                                ?><p class="tex">Aucune compétence n'est liée à cette matière...</p><?php
                            }
                            else{
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

                            }
                            
                        ?>
                        <button id='retour'>Retour</button>
                    
                </div>
            </div>
            
            <?php
        }

    };

    echo "<br><br>";
    

    $tabMatComp = $bdd->query('SELECT * FROM matcomp ORDER BY idMat ASC');

    ?>

    <div class='casier-compte'>
            
        <h1>Mes matières</h1>
        <?php
        $response = $bdd->query('SELECT * FROM matieres JOIN etumat ON matieres.idMat = etumat.IdMat AND etumat.IdEtu = '.$_SESSION['id'].' ORDER BY nomMat ASC ');
        
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
    </div>
</body>

</html>