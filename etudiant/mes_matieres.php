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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#ajouter').click(function () {
            window.location.href = "ajouter_matiere.php";
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
            <button id='ajouter'>Ajouter</button>
            <button id='return'>Retour</button>
        </div>
    </div class>
    
</body>

</html>