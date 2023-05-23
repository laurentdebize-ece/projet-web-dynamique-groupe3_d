<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Mes matières</title>

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
        try {
            $bdd = new PDO(
                'mysql:host=localhost;dbname=omnes_skills;
        charset=utf8',
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    ?>
    <div class="header">
        <div class="img"> </div>
        <h1 class=" welcom_mess">Omnes Skills</h1>
    </div>

    <div class="nav">
        <a href="etudiant.php">Home</a>
        <a href="mes_matieres.php">Mes matières</a>
        <a href="../eval.php">Mes évaluations</a>
        <a href="../eval_a_venir.php">Evaluations à venir</a>
        <a href="mon_espace.php" style="float:right">Mon espace</a>
    </div>


    <div class="row">
        <div class="leftcolumn">
            <div class="sideblocks">
                <h2>MES PARCOURS</h2>
                <div class="fakeimg">
                    <div class="carte-container">
                        <div class="carte carte1">
                            <div class="carte_img carte_img1">
                                <a href="mes_matieres.php">
                                    <h3>Mes matières</h3>
                                </a>
                            </div>
                        </div>
                        <div class="carte carte2">

                            <div class="carte_img carte_img2">
                                <a href="../eval.php">
                                    <h3>Mes évaluations</h3>
                                </a>
                            </div>

                        </div>
                        <div class="carte carte3">

                            <div class="carte_img carte_img3">

                                <a href="../eval_a_venir.php">
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
            </div>
            <?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=omnes_skills; charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    ?>
    <section>
            
        <h1>Mes matières</h1>
        <?php
        $response = $bdd->query('SELECT DISTINCT * FROM etumat AS em, matieres AS m, matcomp AS mc, competences AS c WHERE em.IdEtu= "'.$_SESSION['id'].'" 
        AND em.IdMat= m.idMat AND mc.IdMat=m.idMat AND c.idCompetence=mc.IdCompetence ORDER BY m.nomMat');
        ?>
        <div class="casier">
            <?php
                while ($donnees = $response->fetch()) {
                    $nomMat = lcfirst(preg_replace("/[\p{P}]/u", "", iconv('UTF-8', 'ASCII//TRANSLIT', $donnees['nomMat'])));
            ?>
                <a href="detail_matiere.php?nomMat=<?php echo $donnees['nomMat'];?>">
                    <div class="casier-container" id="<?php echo $nomMat?>" name="<?php echo $nomMat?>">
                        <div class="casier-titre">
                            <div class="casier-container-img">
                                <?php 
                                    $imagePath = "images/matieres/" . lcfirst(preg_replace("/[\p{P}]/u", "", iconv('UTF-8', 'ASCII//TRANSLIT', $donnees['nomMat']))) . ".jpg";
                                    if (file_exists($imagePath)) {
                                        echo '<img src="' . $imagePath . '">';
                                    } else {
                                        echo '<img src="images/default.jpg">';
                                    }
                                ?>
                            </div>
                            <?php echo $donnees['nomMat'];?>
                        </div>
                    </div>
                </a>
            <?php
                }
            ?>
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
                        <?php /*$id = $bdd->query('SELECT * FROM niveau AS n, eval AS ev, evalcomp AS ec,competences AS c, commentaire AS com,  professeurs AS p WHERE ev.date > "' . date("Y-m-d", $date) . '" AND ev.IdEtu="' . $_SESSION['id'] . '" AND ev.idEval= ec.IdEval AND c.idCompetence = ec.IdComp AND p.IdProf=ev.IdProf AND n.idNiv = c.IdNiv AND com.IdEval=ev.idEval ORDER BY ev.date ');
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
                        */?>
                    </table>
                </div>
            </div>
        </div>
        <div class="rightcolumn">
            <div class="sideblocks">
                <h2>NEWSLETTERS</h2>
                <div class="fakeimg" style="height:100px;">Image</div>
            </div>
            <div class="sideblocks">
                <h2>Les evaluations à revoir</h2>
                <p>
                <?php $eval = $bdd->query('SELECT * FROM niveau AS n, eval AS ev, evalcomp AS ec,competences AS c WHERE ev.date < "' . date("Y-m-d", $date) . '" AND ev.IdEtu="' . $_SESSION['id'] . '"  
    AND ev.idEval= ec.IdEval AND c.idCompetence = ec.IdComp AND n.idNiv = c.idNiv AND n.niv=0 ORDER BY ev.date ');
                while ($donnees = $eval->fetch()) {
                ?>
                    <div class="fakeimg">
                        <p> Compétence: <?php echo $donnees['nomCompetence'] . "" . ""; ?>
                            <input type="button" id="s'auto-évaluer" name="AutoEval" value="M'auto-évaluer">
                        </p>
    
                <?php
                }
                
                ?>
                </div>
                </p>
            </div>
            <div class="sideblocks">
                <h2>Pour aller plus loin...</h2>
                <p>
                <a href="https://www.w3schools.com/default.asp">w3schools</a><br>
                <a href="https://mathenpoche.sesamath.net">mathenpoche</a><br>
                <a href="https://www.univdocs.com/2020/06/physique-des-semiconducteurs.html">physique</a>
                </p>
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