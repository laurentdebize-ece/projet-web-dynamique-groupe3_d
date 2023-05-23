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

    <script>
        function correction(IdEtu, IdComp, IdEval, idNiv) {
            document.getElementById("progression").value=idNiv;
            document.getElementById("IdEtu").value=IdEtu;
            document.getElementById("IdComp").value=IdComp;
            document.getElementById("IdEval").value=IdEval;
            document.getElementById("popupForm").style.display = "block";
        }
    </script>

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
                    $evaluation = $bdd->query('SELECT * FROM eval AS ev, etudiant AS e, evalcomp AS ec, competences AS c, niveau AS n WHERE ev.date >= "' . date("Y-m-d", $date) . '" AND ev.IdProf= "' . $_SESSION['id'] . '" AND e.IdEtudiant = ev.IdEtu AND ec.IdEval=ev.idEval AND c.idCompetence=ec.IdComp AND n.idNiv=c.IdNiv ORDER BY ev.date');

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
                            <td> <?php echo "<input type=button id='eval' name='eval' value='Correction' onclick=correction(" . $donnees['IdEtudiant'] . "," . $donnees['IdEtudiant'] . "," . $donnees['IdEtudiant'] . "," . $donnees['idNiv'] . ")></td>"; ?>
                        </tr>

                    <?php
                    }

                    ?>

                </table>
            </div>
        </div>
    </div>

    <div class=CorrectPopUp>
        <div class="FormPopUp" id="popupForm">
            <form action="correctionSQL.php" method="post" class="formCorrect">
                <h2>Correction</h2>
                <label for="progression">Progression</label>
                <select name="progression" id="progression">
                    <option value="1">Acquis</option>
                    <option value="2">En Cours d'acquisition</option>
                    <option value="3">Non Acquis</option>
                    <option value="4">Non Evalué</option>
                </select>
                <input type="text" id="IdEtu" name="IdEtu" class=hidden />
                <input type="text" id="IdComp" name="IdComp" class=hidden/>
                <input type="text" id="IdEval" name="IdEval" class=hidden />
                <label for="Commentaire">Commentaire</label>
                <input type="text" id="Commentaire" name="Commentaire" required />
                <input type="submit" class="Confirmer" value=Confirmer>
                <button type="button" class="Fermer" onclick="Fermer()">Fermer</button>
            </form>
        </div>
    </div>
    <script>
        function Fermer() {
            document.getElementById("popupForm").style.display = "none";
        }
    </script>

    <a href="prof.php"><button type="submit" id="retour" value=retour>Retour</button></a>
    </div>

</body>

</html>