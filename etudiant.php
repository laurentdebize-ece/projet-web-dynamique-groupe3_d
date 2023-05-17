<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Accueil_etudiant</title>

    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">
    </script>
    <script type="text/javascript">
        var img = 1;

        function chgmtImage(move) {
            $("img").css('display', 'none');
            if (img == 1 && move == -1) {
                img = 7;
                $("#" + img).css('display', 'block');
            } else if (img == 7 && move == 1) {
                img = 1;
                $('#1').css('display', 'block');
            } else {
                $('img').css('display', 'none');
                img = img + move;
                $('#' + img).css('display', 'block');

            }

        }
    </script>
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
    <header>
        <section id="section1">
            <div class="section1_partition1">
                <div class="partition1_head">
                    <div class="img_container">
                        <div class="img"> </div>
                    </div>
                    <nav>
                        <ul>
                            <li> <a href="etudiant.php">Home</a> </li>
                            <li><a href="matieres.php">Mes matières</a></li>
                            <li><a href="eval.php">Mes évaluations</a></li>
                            <li><a href="eval_a_venir.php">Evaluations à venir</a></li>
                            <li><a href="mon_espace.php">Mon espace</a></li>
                        </ul>
                    </nav>
                </div>
                <h1 class=" welcom_mess">Omnes Skills</h1>

            </div>
            <div class="section1_partition2">
                <div class="carte-container">
                    <div class="carte carte1">

                        <div class="carte_img carte_img1">

                            <a href="matieres.php">
                                <h3>Mes matières</h3>
                            </a>

                        </div>

                    </div>
                    <div class="carte carte2">

                        <div class="carte_img carte_img2">
                            <a href="eval.php">
                                <h3>Mes évaluations</h3>
                            </a>
                        </div>

                    </div>
                    <div class="carte carte3">

                        <div class="carte_img carte_img3">

                            <a href="eval_a_venir.php">
                                <h3>Évaluations à venir</h3>
                            </a>

                        </div>
                    </div>
                    <div class="carte carte4">

                        <div class="carte_img carte_img4">
                            <a href="mon_espace.php">
                                <h3>Mon espace</h3>
                        </div>

                    </div>

                </div>
            </div>
            <div class="section1_partition3">
                <br>
                <table>
                    <caption>PLANNING</caption>
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
                        <td>
                            <b>Évaluation</b>
                        </td>
                    </tr>
                    <?php $id = $bdd->query('SELECT * FROM niveau AS n, eval AS ev, evalcomp AS ec,competences AS c, commentaire AS com,  professeurs AS p WHERE ev.date > "' . date("Y-m-d", $date) . '" AND ev.IdEtu="' . $_SESSION['id'] . '"  
    AND ev.idEval= ec.IdEval AND c.idCompetence = ec.IdComp AND p.IdProf=ev.IdProf AND n.idNiv = c.IdNiv AND com.IdEval=ev.idEval ORDER BY ev.date ');
                    while ($donnees = $id->fetch()) {
                    ?>
                        <tr>
                            <td>
                                <b><?php echo $donnees['nomCompetence']; ?></b>
                            </td>
                            <td><?php echo $donnees['date']; ?> </td>
                            <td><?php echo $donnees['nomProf'] . " " . $donnees['prenomProf']; ?></td>
                            <td><?php switch ($donnees['niv']) {
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
                                } ?></td>
                            <td><?php echo $donnees['texte']; ?></td>
                            <td><input type=button id="s'auto-évaluer" name="AutoEval" value="S'auto-évaluer"></td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>
    
        </section>






        </div>
    </header>
</body>

</html>