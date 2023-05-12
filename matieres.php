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
    $matiere = $bdd->query('SELECT * FROM etumat AS em, matieres AS m, matcomp AS mc, competences AS c, etudiant AS e WHERE em.IdEtu=e.IdEtudiant 
    AND em.IdMat= m.idMat AND mc.IdMat=m.idMat AND c.idCompetence=mc.IdCompetence ORDER BY m.nomMat');

    while ($donnees = $matiere->fetch()) {
    ?>
        <ul>
            <li> <?php echo $donnees['nomMat']; ?>
                <h4>Mes compétences associées</h4>           
                <?php 
                $comp= $donnees['nomCompetence']; 
                ?> 
                <ul>
                    <li> <?php echo $donnees['nomCompetence']; ?> </li>      
                <?php 
                while (($donnees['nomCompetence'])!=$comp){
                    ?>
                    <li><?php echo $donnees['nomCompetence']; ?></li> 
            <?php     
            }
                  ?>  
                </ul>
            </li>
    
        </ul>
        <?php     
            }
                  ?>


</body>

</html>