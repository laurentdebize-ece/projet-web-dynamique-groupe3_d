<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Accueil</title>

    <link rel="stylesheet" href="matiere.css">
</head>

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
        die('Erreur : ' . $e->getMessage());
    }
    ?>
    <h1>Mes matières</h1>
    <?php
    $matiere = $bdd->query('SELECT * FROM etumat AS em, matieres AS m, etudiant AS e WHERE em.mailEtu=e.mailEtu 
    AND em.IdMat= m.idMat');

    while ($donnees = $matiere->fetch()) {
    ?>
        <ul>
            <li> <?php echo $donnees['nomMat']; ?>
                <h4>Mes compétences associées</h4>
                <?php
                $competence = $bdd->query('SELECT * FROM matieres AS m, matcomp AS mc, competences AS c WHERE m.idMat = "' . $donnees['idMat'] . '" AND mc.IdMat= m.idMat AND c.idCompetence=mc.IdCompetence');
                while ($donnees = $competence->fetch()) {
                ?>
                    <ul>
                        <li> <?php echo $donnees['nomCompetence']; ?> </li>
                    </ul>
            </li>
        <?php
                }
        ?>
        </ul>
    <?php
    }

    ?>


</body>

</html>