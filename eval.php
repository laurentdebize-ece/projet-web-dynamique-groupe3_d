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
   $evaluation = $bdd->query('SELECT * FROM niveau AS n, eval AS ev, evalcomp AS ec, competences AS c,  professeurs AS p WHERE ev.IdEtu="'.$_SESSION['id'].'"  
    AND ev.idEval= ec.idEval AND c.idCompetence = ec.idComp AND p.IdProf=ev.IdProf AND n.idNiv = c.IdNiv ORDER BY ev.date ');
   while ($donnees = $evaluation->fetch()) {
    ?>
        <ul>
            <li> Date : <?php echo $donnees['date']; ?> 
                Compétence évaluée : <?php echo $donnees['nomCompetence']; 
                                                 ?> 
                Professeur(s) en charge : <?php echo $donnees['prenomProf']." ".$donnees['nomProf']; 
                                                 ?> 
                Niveau : <?php switch($donnees['niv']){
                    case 0: {
                        echo "NON EVALUÉ"; 
                        break; 
                    }
                    case 1: {
                        echo "EN COURS D'AQUISITION"; 
                        break; 
                    }
                    case 2: {
                        echo "AQUIS"; 
                        break; 
                    }
                    case 3: {
                        echo "NON AQUIS"; 
                        break; 
                    }
                }
               ?> <br>
               
                                               
            </li>
        </ul>
    <?php
    }

    ?>



</body>

</html>