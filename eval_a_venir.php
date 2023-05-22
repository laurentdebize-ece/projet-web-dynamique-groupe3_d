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
    <table>
        <caption>Planning des evaluations</caption>
    <tr>
                <td>
                    <b>Compétence</b>
                </td>
                <td>
                    <b>Date</b>
                </td>
                <td>
                    <b>Professeur en charge</b>
                </td>
                <td>
                    <b>Niveau</b>
                </td>
                <td>
                    <b>Commentaire</b>
                </td>
                <td> <b>S'évaluer?</b> </td>
            </tr>
    <?php
    // on recupere toutes les evals qui ne sont pas encore passées
    $evaluation = $bdd->query('SELECT * FROM niveau AS n, eval AS ev, evalcomp AS ec,competences AS c,  professeurs AS p, commentaire AS com WHERE ev.date > "'.date("Y-m-d", $date).'" AND ev.IdEtu="'.$_SESSION['id'].'"  
    AND ev.idEval= ec.IdEval AND c.idCompetence = ec.IdComp AND p.IdProf=ev.IdProf AND n.idNiv = c.IdNiv AND com.IdEval= ev.idEval ORDER BY ev.date ');
   while ($donnees = $evaluation->fetch()) {
    ?>
   <tr>
            <td> <?php echo $donnees['nomCompetence'];?> </td>
            <td> <?php echo $donnees['date']; ?></td>
                        
            <td> <?php echo $donnees['prenomProf'] . " " . $donnees['nomProf']; ?></td>
            <td> <?php switch ($donnees['niv']) {
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
                            ?>
            </td>
            <td>  <?php echo $donnees['texte']; ?></td>
            <td> <input type=button id="eval" name="eval" value="s'évaluer"> </td>
                </tr>
            <?php
        }

            ?>




</body>

</html>