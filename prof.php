<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Accueil_prof</title>

    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">
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
    <div class="header">
        <div class="img"> </div>
        <div class=" welcom_mess">Omnes Skills</div>
    </div>
    <div class="nav">
        <div class="nav">
            <a href="prof.php">Home</a>
            <a href="matieres_prof.php">Matières & compétences</a>
            <a href="navigationPromoProf.php">Mes classes</a>
            <a href="addEvalProfForm.php">Programmer une évaluation</a>
            <a href="mon_espace_prof.php" style="float:right">Mon espace</a>
        </div>
    </div>
    <div class="Hello">
    <?php
    // Afficher le nom et prenom de la personne connectee
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    echo "<h1>Bienvenue $prenom " . str_replace('_', ' ', $nom) . "</h1>";
    ?>
    </div>
    <div class="row">
        <div class="leftcolumn">
            <div class="sideblocks">
                <h2>MES PARCOURS</h2>
                <div class="fakeimg">
                    <div class="carte-container">
                        <div class="carte carte1">
                            <div class="carte_img carte_img1">
                                <a href="matieres_prof.php">
                                    <h3>Matières & compétences</h3>
                                </a>
                            </div>
                        </div>
                        <div class="carte carte2">

                            <div class="carte_img carte_img2">
                                <a href="navigationPromoProf.php">
                                    <h3>Mes classes</h3>
                                </a>
                            </div>

                        </div>
                        <div class="carte carte3">

                            <div class="carte_img carte_img3">

                                <a href="addEvalProfForm.php">
                                    <h3>Programmer une évaluation</h3>
                                </a>
                            </div>
                        </div>
                        <div class="carte carte4">

                            <div class="carte_img carte_img4">
                                <a href="mon_espace_prof.php">
                                    <h3>Mon espace</h3>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
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
                        $evaluation = $bdd->query('SELECT * FROM eval AS ev, etudiant AS e, evalcomp AS ec, competences AS c, niveau AS n WHERE ev.date >= "' . date("Y-m-d", $date) . '" AND ev.IdProf= "'.$_SESSION['id'].'" AND e.IdEtudiant = ev.IdEtu AND ec.IdEval=ev.idEval AND c.idCompetence=ec.IdComp AND n.idNiv=c.IdNiv ORDER BY ev.date');

                        while ($donnees = $evaluation->fetch()) {
                        ?>
                            <tr>
                                <td> <?php echo $donnees['nomCompetence']; ?> </td>
                                <td> <?php echo $donnees['date']; ?></td>

                                <td> <?php echo $donnees['prenomEtu'] . " " . $donnees['nomEtu']; ?></td>
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
                                <td> <input type=button id="eval" name="eval" value="Correction"> </td>
                            </tr>
                        <?php
                        }

                        ?>

                    </table>
                </div>
            </div>
        </div>
        <div class="rightcolumn">
            <div class="sideblocks">
                <h2>NEWSLETTERS</h2>
                <div class="fakeimg" style="height:100px;"></div>
            </div>
            <div class="sideblocks">
                <h2>Correction archivées</h2>
                <p>
                <?php $eval = $bdd->query('SELECT * FROM eval AS ev, etudiant AS e, evalcomp AS ec, competences AS c, niveau AS n WHERE ev.date < "' . date("Y-m-d", $date) . '" AND ev.IdProf= "'.$_SESSION['id'].'" AND e.IdEtudiant = ev.IdEtu AND ec.IdEval=ev.idEval AND c.idCompetence=ec.IdComp AND n.idNiv=c.IdNiv ORDER BY ev.date');
                while ($donnees = $eval->fetch()) {
                ?>
                    <div class="fakeimg">
                        <p> Compétence: <?php echo $donnees['nomCompetence'] . "" . ""; ?>
                        <a href="navigationPromoProf.php"><input type="button" id="s'auto-évaluer" name="AutoEval" value="Modifier"></a>
                        </p>
    
                <?php
                }
                
                ?>
                </div>
            </div>
            <div class="sideblocks">
                <h3>Follow Me</h3>
                <p>Some text..</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <h2>CONTACT</h2>

        <ul>
            <li>
                <h3>Campus de Lyon:</h3>
                Adresse: 25 rue Salomon Reinach 69007 Lyon 7ème<br>
                <a href="mailto:omnes.adminLyon@omnes.fr">mail: omnes.adminLyon@omnes.fr</a><br>
                <a href="tel:0456780968">Telephone: 0456780968</a>
            </li>
            <li>
                <h3>Campus de Paris:</h3>
                Adresse: 18 rue grenelle <br>
                <a href="mailto:omnes.adminParis@omnes.fr">mail: omnes.adminParis@omnes.fr</a><br>
                <a href="tel:0156780968">Telephone: 0156780968 </a>
            </li>
        </ul>

    </div>

</body>

</html>