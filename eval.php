<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Evaluations</title>
    <link rel="stylesheet" href="style.css">
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
    <h1>Mes evaluations</h1>
    <?php
    $evaluation = $bdd->query('SELECT * FROM eval AS ev, evalComp AS ec, etudiant AS e WHERE ev.mailEtu=e.mailEtu  
    AND ev.idEval= ec.idEval');
   while ($donnees = $evaluation->fetch()) {
    ?>
        <ul>
            <li> Date : <?php echo $donnees['date']; ?> 
                Compétence évaluée : <?php $competence=$bdd->query('SELECT * FROM eval AS ev, evalComp AS ec, competences AS c  WHERE ev.idEval= ec.idEval AND c.idCompetence = ec.idCompetence ')->fetch(); 
                                                   echo $competence['nomCompetence']; 
                                                 ?> 
                Professeur(s) en charge : <?php $prof=$bdd->query('SELECT * FROM professeurs AS p, eval AS e, evalComp AS ec WHERE e.idEval = ec.idEval AND e.mailProf=p.mailProf ')->fetch();  
                                                   echo $prof['prenomProf']." ".$prof['nomProf']; 
                                                 ?> <br>
            </li>
        </ul>
    <?php
    }

    ?>



</body>

</html>