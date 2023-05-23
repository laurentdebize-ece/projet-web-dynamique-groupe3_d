<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Evaluation</title>
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
    <div class="head">
        <h1>Vous pouvez à présent corriger l'évaluation !</h1>

        <div class="sideblocks">
            <h2>Mes Corrections à venir</h2>
            <div class="fakeimg">
                <table>
                    <tr>
                        <td>
                            <b>Compétence</b>
                        </td>
                        <td>
                            <b>Date</b>
                        </td>
                        <td>
                            <b>Étudiant</b>
                        </td>
                        <td>
                            <b>Niveau</b>
                        </td>

                        <td>
                            <b>Corriger </b>
                        </td>
                    </tr>
                    <?php
                    $evaluation = $bdd->query('SELECT * FROM eval AS ev, etudiant AS e, evalcomp AS ec, competences AS c, niveau AS n WHERE ev.date >= "' . date("Y-m-d", $date) . '" AND ev.IdProf= "' . $_SESSION['id'] . '" AND e.IdEtudiant = ev.IdEtu AND ec.IdEval=ev.idEval AND c.idCompetence=ec.IdComp AND n.idNiv=c.IdNiv AND ORDER BY ev.date');

                    while ($donnees = $evaluation->fetch()) {
                    ?>
                        <tr>
                            <td> <?php echo $donnees['nomCompetence']; ?> </td>
                            <td> <?php echo $donnees['date']; ?></td>

                            <td> <?php echo $donnees['prenomEtu'] . " " . $donnees['nomEtu']; ?></td>
                            <td> <?php switch ($donnees['idNiv']) {
                                        case 1: {
                                                echo "AQUIS";
                                                break;
                                            }
                                        case 2: {
                                                echo "EN COURS D'AQUISITION";
                                                break;
                                            }
                                        case 3: {
                                                echo "NON AQUIS";
                                                break;
                                            }
                                        case 4: {
                                                echo "NON EVALUÉ";
                                                break;
                                            }
                                    }
                                    ?>
                            </td>
                            <td> <a href="correction.php"><input type=button id="eval" name="eval" value="Correction"> </a></td>
                        </tr>
                    <?php
                    }

                    ?>

                </table>
            </div>
        </div>
    </div>

    <a href="prof.php"><button type="submit" id="retour" value=retour>Retour</button></a>
    </div>

</body>

</html>