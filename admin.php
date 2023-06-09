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
            <a href="admin.php">Home</a>
            <a href="admin/adminPromo.php">Promotions & classes</a>
            <a href="admin/adminMatiere.php">Matières</a>
            <a href="admin/adminProf.php">Professeurs</a>
            <a href="login.php" style="float:right">Deconnexion</a>
            <a href="admin/mon_espace_admin.php" style="float:right">Mon espace</a>
        </div>
    </div>

    <div class="row">
        <div class="leftcolumn">
            <div class="sideblocks">
                <h2>MES PARCOURS</h2>
                <div class="fakeimg">
                    <div class="carte-container">
                        <div class="carte carte1">
                            <div class="carte_img carte_img1">
                                <a href="admin/adminPromo.php">
                                    <h3>Promotions & classes</h3>
                                </a>
                            </div>
                        </div>
                        <div class="carte carte2">

                            <div class="carte_img carte_img2">
                                <a href="admin/adminMatiere.php">
                                    <h3>Matières</h3>
                                </a>
                            </div>

                        </div>
                        <div class="carte carte3">

                            <div class="carte_img carte_img3">

                                <a href="admin/adminProf.php">
                                    <h3>Professeurs</h3>
                                </a>
                            </div>
                        </div>
                        <div class="carte carte4">

                            <div class="carte_img carte_img4">
                                <a href="mon_espace.php">
                                    <h3>Mon espace</h3>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="sideblocks">
                <h2>PLANNING</h2>
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
                                <b>Professeur en charge</b>
                            </td>
                            <td>
                                <b>Niveau</b>
                            </td>
                            <td>
                                <b>Commentaire</b>
                            </td>
                            <td>
                                <b>Corriger </b>
                            </td>
                        </tr>
                        <?php $id = $bdd->query('SELECT * FROM etudiant AS e, niveau AS n, eval AS ev, evalcomp AS ec,competences AS c, commentaire AS com,  professeurs AS p WHERE p.IdProf= ev.IdProf AND e.idEtudiant=ev.IdEtu   
    AND ev.idEval= ec.IdEval AND c.idCompetence = ec.IdComp AND n.idNiv = c.IdNiv AND com.IdEval=ev.idEval ORDER BY ev.date ');
                        while ($donnees = $id->fetch()) {
                        ?>
                            <tr>
                                <td>
                                    <b><?php echo $donnees['nomCompetence']; ?></b>
                                </td>
                                <td><?php echo $donnees['date']; ?> </td>
                                <td><?php echo $donnees['nomEtu'] . " " . $donnees['prenomEtu']; ?></td>
                                <td><?php echo $donnees['nomProf']." " . $donnees['prenomProf']; ?></td>
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
                                <td><input type=button id="correction" name="correction" value="Correction"></td>
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
                <div class="fakeimg">
                <p> L'équipe 3D est fière de vous présenter son siteWeb Omnes Skills ! Nous espérons que vous passerez de bons moments lors de votre navigation !</p>
                </div>
            </div>
            <div class="sideblocks">
                <h2></h2>
            </div>
            <div class="sideblocks">
                <h3>Follow Me</h3>
                <p>Some text..</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <h2>NOUS CONTACT</h2>

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