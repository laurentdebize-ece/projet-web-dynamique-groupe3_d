<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Ajouter une matière</title>

    <link rel="stylesheet" href="style.css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".casier-container").click(function () {
            var nomMat = $(this).attr("name");
            var idMat = $(this).attr("id");
            var popup = confirm("Voulez-vous vraiment ajouter la matière " + nomMat + " ?");
            if (popup == true) {
                $.ajax({
                    url: "ajouter_matiere_ajax.php",
                    type: "POST",
                    data: {
                        idMat: idMat
                    },
                    success: function (data) {
                        alert("La matière " + nomMat + " a bien été ajoutée à votre compte !");
                        location.reload();
                    },
                    error: function (data) {
                        alert("Erreur lors de l'ajout de la matière " + nomMat + " à votre compte !");
                    }
                });
            }
            else {
                alert("La matière " + nomMat + " n'a pas été ajoutée à votre compte !");
            }
        });
        $("#retour").click(function () {
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
    ?>
    <div class="casier-compte">
        <h1>Ajouter une matière</h1>
        
        <?php
        // Je veux les matières auxquelles l'élève n'a pas accès, cad les matieres dans matière dont l'ID ne se trouve pas en commun avec l'ID de l'élève dans la table etumat

        $response = $bdd->query('SELECT * FROM matieres WHERE idMat NOT IN (SELECT idMat FROM etumat WHERE idEtu = ' . $_SESSION['id'] . ') ORDER BY nomMat ASC');
        ?>

        <div class="casier">
            <?php
                while ($donnees = $response->fetch()) {
                    $nomMat = lcfirst(preg_replace("/[\p{P}]/u", "", iconv('UTF-8', 'ASCII//TRANSLIT', $donnees['nomMat'])));
                    $idMat = $donnees['idMat'];
            ?>
                    <div class="casier-container" id="<?php echo $idMat?>" name="<?php echo $nomMat?>">
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
            <?php
                }
            ?>
            <button id='ajouter'>Ajouter</button>
           <a href="mes_matieres.php"><button id='return'>Retour</button></a>
            </div>
        
            
    </div>


</body>

</html>