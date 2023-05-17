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
    // pour recuperer la date du jour 
    $date = time(); 
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
    <h1>Planning des évaluations</h1>
    <?php
    // on recupere toutes les evals qui ne sont pas encore passées
    $evaluation = $bdd->query('SELECT * FROM niveau AS n, eval AS ev, evalcomp AS ec,competences AS c,  professeurs AS p WHERE ev.date > "'.date("Y-m-d", $date).'" AND ev.IdEtu="'.$_SESSION['id'].'"  
    AND ev.idEval= ec.IdEval AND c.idCompetence = ec.IdComp AND p.IdProf=ev.IdProf AND n.idNiv = c.IdNiv ORDER BY ev.date ');
   while ($donnees = $evaluation->fetch()) {
    $eval = array(); 
    $eval['date']= $donnees['date']; 
    $eval['comp']= $donnees['nomCompetence']; 
    $eval['prof']= $donnees['prenomProf'].$donnees['nomProf']; 
    $eval['progression']= $donnees['progression']; 
    $eval['niv']= $donnees['niv']; 
    foreach ($eval as $val){
        echo $val ; 
    }
    ?>
        <ul>
            <li> Date : <?php echo $donnees['date']; ?> 
                Compétence évaluée : <?php echo $donnees['nomCompetence']; 
                                                 ?> 
                Professeur(s) en charge : <?php  echo $donnees['prenomProf']." ".$donnees['nomProf']; 
                                                 ?> 
                Niveau : <?php 
                switch($donnees['niv']){
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