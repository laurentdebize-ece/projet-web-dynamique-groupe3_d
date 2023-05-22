<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Accueil</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
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
    ?>
    <h1>Mes matières</h1>
    <?php
    $matiere = $bdd->query('SELECT * FROM etumat AS em, matieres AS m, matcomp AS mc, competences AS c WHERE em.IdEtu= "'.$_SESSION['id'].'" 
    AND em.IdMat= m.idMat AND mc.IdMat=m.idMat AND c.idCompetence=mc.IdCompetence ORDER BY m.nomMat');
    $mat = 0;
    while ($donnees = $matiere->fetch()) {
    ?>
        <ul>
            <?php
            while (($donnees['nomMat']) != $mat) {
            ?> <li>
                    <?php
                    $mat = $donnees['nomMat'];
                    echo $donnees['nomMat'];
                    ?>
                    <h4>Mes compétences associées</h4>
                </li>
            <?php
            }
            ?>

            <ul>
                <li> <?php echo $donnees['nomCompetence']; ?> </li>

            </ul>

        </ul>
    <?php
    }
    ?>


</body>

</html>