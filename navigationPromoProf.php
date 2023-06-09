<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
    <title>navigation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylenavProf.css">
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

    $promo = 0;
    $classe = 0;
    ?>



    <h1>Navigation</h1>

    <div class="container">

        <!-- Navigation des promos et séléction des classes-->
        <div class="row" id=PromoNav>
            <div class="col-sm-4" id=menuDeroulePromo>
                <p>

                    <?php
                    $encore = 0;
                    $encore2 = 0;
                    $ID = $_SESSION['id'];
                    $response = $bdd->query("SELECT * FROM promotion AS p, professeurs AS pr, enseignerclassmatprof AS cmp, classe AS c WHERE pr.IdProf = '$ID' AND pr.IdProf =cmp.IdProf AND cmp.IdClasse=c.IdClasse AND p.ID=c.IdPromotion ORDER BY anneeDePromo");
                    while ($donnees = $response->fetch()) {
                        $response2 = $bdd->query("SELECT * FROM promotion AS p, professeurs AS pr, enseignerclassmatprof AS cmp, classe AS c WHERE pr.IdProf = '$ID' AND pr.IdProf =cmp.IdProf AND cmp.IdClasse=c.IdClasse AND p.ID=c.IdPromotion ORDER BY classeNum");
                        $MAX = $bdd->query('SELECT MAX(anneeDePromo) AS "Max" FROM promotion');
                        $MaxP = $MAX->fetch();
                        $MIN = $bdd->query('SELECT MIN(anneeDePromo) AS "Min" FROM promotion');
                        $MinP = $MIN->fetch();
                        $MAXC = $bdd->query('SELECT MAX(classeNum) AS "MaxC" FROM classe');
                        $MaxC = $MAXC->fetch();
                        $MINC = $bdd->query('SELECT MIN(classeNum) AS "MinC" FROM classe');
                        $MinC = $MINC->fetch();
                        if ($donnees["anneeDePromo"] != $encore) {
                            echo "<p class= promo id=p-" . $donnees["anneeDePromo"] . ">Promo " . $donnees['anneeDePromo'] . "</p>";
                            $encore = $donnees["anneeDePromo"];
                            while ($donnees2 = $response2->fetch()) {
                                if ($donnees["anneeDePromo"] == $donnees2["anneeDePromo"]) {
                                    echo "<p class=c-" . $donnees["anneeDePromo"] . ">classe " . $donnees2["classeNum"] . "</p>";
                                }
                            }
                        }
                    }
                    ?>
                </p>
            </div>
            <div class="col-sm-8" id=listeClasses>
                <p>
                    <?php
                    $nbcase = 0;
                    $response = $bdd->query('SELECT * FROM promotion ORDER BY anneeDePromo');
                    while ($donnees = $response->fetch()) {
                        $response2 = $bdd->query('SELECT p.anneeDePromo, c.classeNum FROM promotion AS p, classe AS c WHERE p.ID=c.IdPromotion ORDER BY classeNum');
                        echo "<div class='container'><div class='row'>";
                        while ($donnees2 = $response2->fetch()) {
                            if ($donnees["anneeDePromo"] == $donnees2["anneeDePromo"]) {
                                echo "<div class='col-sm-4'><p class=clist-" . $donnees["anneeDePromo"] . " id=clist-" . $donnees["anneeDePromo"] . "-" . $donnees2["classeNum"] . ">classe " . $donnees2["classeNum"] . "</p></div>";
                                $nbcase = ($nbcase + 1) % 2;
                                if ($nbcase == 0) {
                                    echo "</div><div class='row'>";
                                }
                            }
                        }
                        if ($nbcase != 2) {
                            for ($i = 0; $i < 2 - $nbcase; $i++) {
                                echo "<div class='col-sm-4'></div>";
                            }
                        }
                        echo "</div></div>";
                    }
                    ?>
                </p>
            </div>
        </div>

        <!-- Navigation des classe et séléction des élèves-->
        <div class="row" id=ClasseNav>
            <div class="col-sm-4" id=etuMat>
                <h2 class=titreNavClasse><span id='titreNavClasse'></span></h2><br>
                <?php
                $MAXE = $bdd->query('SELECT MAX(IdEtudiant) AS "Max" FROM etudiant');
                $MaxE = $MAXE->fetch();
                $MINE = $bdd->query('SELECT MIN(IdEtudiant) AS "Min" FROM etudiant');
                $MinE = $MINE->fetch();
                $MAXM = $bdd->query('SELECT MAX(idMat) AS "Max" FROM matieres');
                $MaxM = $MAXM->fetch();
                $MINM = $bdd->query('SELECT MIN(idMat) AS "Min" FROM matieres');
                $MinM = $MINM->fetch();
                $response = $bdd->query('SELECT * FROM etudiant AS e, classe AS c, promotion AS p WHERE c.IdClasse=e.IdClasse AND c.IdPromotion=p.ID ORDER BY nomEtu');
                while ($donnees = $response->fetch()) {
                    echo "<p class=etu-" . $donnees["anneeDePromo"] . "-" . $donnees["classeNum"] . " id=e-" . $donnees["IdEtudiant"] . ">" . $donnees["prenomEtu"] . " " . $donnees["nomEtu"] . "</p>";
                }
                ?>
            </div>
            <div class="col-sm-8" id=matiereListe>
                <div class='table-hover' id=tableauComp>
                    <div class='row' id=comp>
                        <div class='col-sm-2'>Nom de la Compétence</div>
                        <div class='col-sm-2'>Matière</div>
                        <div class='col-sm-2'>évalué le :</div>
                        <div class='col-sm-2'>Niveau :</div>
                    </div>
                    <?php
                    $encore3 = 0;
                    $MAXCOMP = $bdd->query('SELECT MAX(idCompetence) AS "Max" FROM competences');
                    $MaxComp = $MAXCOMP->fetch();
                    $MINCOMP = $bdd->query('SELECT MIN(idCompetence) AS "Min" FROM competences');
                    $MinComp = $MINCOMP->fetch();
                    $MATIERES =  $bdd->query("SELECT * FROM professeurs AS pr, enseignerclassmatprof AS cmp WHERE pr.IdProf = '$ID' AND pr.IdProf =cmp.IdProf");
                    while ($Matieres = $MATIERES->fetch()) {
                        if ($encore3 != $Matieres['IdMat']) {
                            $response = $bdd->query('SELECT * FROM etudiant AS e, eval AS ev, evalcomp AS ec, competences AS c, niveau AS n WHERE e.IdEtudiant=ev.IdEtu AND ev.IdEval=ec.IdEval AND ec.IdComp=c.idCompetence  AND n.idNiv=c.IdNiv ORDER BY nomEtu');
                            while ($donnees = $response->fetch()) {
                                $response2 = $bdd->query('SELECT * FROM etumat AS em, etudiant AS e, matieres AS m, competences AS c, matcomp AS mc WHERE e.IdEtudiant=em.IdEtu AND em.IdMat=m.idMat AND m.idMat=mc.IdMat AND mc.IdCompetence=c.idCompetence ORDER BY nomCompetence');
                                while ($donnees2 = $response2->fetch()) {
                                    if ($donnees["idCompetence"] == $donnees2["idCompetence"] && $donnees2["IdEtudiant"] == $donnees["IdEtudiant"] && $donnees2["idMat"] == $Matieres['IdMat']) {
                                        echo "<div class='row' id='comp-" . $donnees2["idCompetence"] . "'>";
                                        echo "<div class='col-sm-2'><p id='comp-" . $donnees2["idCompetence"] . "' class=comp-" . $donnees2["IdEtudiant"] . "-" . $donnees["trans"] . ">" . $donnees["nomCompetence"] . "</div></p>";
                                        echo "<div class='col-sm-2'><p id='comp-" . $donnees2["idCompetence"] . "' class=comp-" . $donnees2["IdEtudiant"] . "-" . $donnees["trans"] . ">" . $donnees2["nomMat"] . "</div></p>";
                                        echo "<div class='col-sm-2'><p id='comp-" . $donnees2["idCompetence"] . "' class=comp-" . $donnees2["IdEtudiant"] . "-" . $donnees["trans"] . ">" . $donnees["date"] . "</div></p>";
                                        echo "<div class='col-sm-2'><p id='comp-" . $donnees2["idCompetence"] . "' class=comp-" . $donnees2["IdEtudiant"] . "-" . $donnees["trans"] . ">" . $donnees["niv"] . "</div></p>";
                                        echo "</div>";
                                    }
                                }
                            }
                            $encore3 = $Matieres['IdMat'];
                        }
                    }
                    ?>
                </div>
                <div class='container' id=form2>
                    <form id=ModifComp action="ModifProf.php" method="post">
                        <div id=hidden>
                            <label for="Etudiant">Etudiant :</label>
                            <input type='text' id="Etudiant" name='Etudiant'>
                        </div>
                        <div>
                            <label for="NompComp">Nom de la Compétence :</label>
                            <input type='text' id="NomComp" name='NomComp'>
                        </div>
                        <div class=distancetop>
                            <label for="progression">Progression :</label>
                            <select name="progression" id="progression">
                                <option value="1">Acquis</option>
                                <option value="2">En Cours d'acquisition</option>
                                <option value="3">Non Acquis</option>
                            </select><br>
                        </div>
                        <div class=distancetop>
                            <input type='submit' id="Envoyer" value=Modifier>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>

    <!-- bouton de retour -->
    <button id=RETOUR onclick=retour()>RETOUR</button>





    <!-- code pour les interactions de click -->

    <script>
        var navigation = 0;
        var classe;
        var promo;
        var comp = 0;
        var etudiant = 0;
        var progress;

        function retour() {
            switch (navigation) {
                case 0:
                    location.href = 'prof.php';
                    break;
                case 1:
                    $('#PromoNav').show();
                    $('#titreNavClasse').hide();
                    $('#ClasseNav').hide();
                    $('#comp').hide();
                    $('#comp2').hide();
                    $('#comp3').hide();
                    $('#MatiereNav').hide();
                    $('.etu-' + promo + '-' + classe).hide();
                    $('.m-' + etudiant).hide('slow');
                    $('.mlist-' + etudiant).hide();
                    //$('#mNom-' + matiere).hide();
                    $('.comp-' + etudiant + '-0').hide();

                    navigation = 0;
                    break;
            }
        }

        $(document).ready(function() {
            $('#CompClick').click(function() {
                $('#comp').show();
                $('.comp-' + etudiant + '-' + matiere + '-1').hide();
                $('.comp-' + etudiant + '-' + matiere + '-0').show();
            });
        });
        $(document).ready(function() {
            $('#TransClick').click(function() {
                $('#comp').show();
                $('.comp-' + etudiant + '-' + matiere + '-0').hide();
                $('.comp-' + etudiant + '-' + matiere + '-1').show();
            });
        });
    </script>

    <?php
    for ($j = $MinP["Min"]; $j <= $MaxP["Max"]; $j++) {
        echo "<script>$(document).ready(function() {";
        echo "$('#p-" . $j . "').click(function() {";
        echo "$('.c-" . $j . "').slideToggle('slow');";
        echo "$('.clist-" . $j . "').toggle();";
        echo "});});";
        echo "</script>";
    }

    for ($k = $MinP["Min"]; $k <= $MaxP["Max"]; $k++) {
        for ($l = $MinC["MinC"]; $l <= $MaxC["MaxC"]; $l++) {
            echo "<script>$(document).ready(function() {";
            echo "$('#clist-" . $k . "-" . $l . "').click(function() {";
            echo "document.getElementById('titreNavClasse').innerHTML = 'Classe " . $l . " - Promo " . $k . "';";
            echo "$('#PromoNav').hide();";
            echo "$('#titreNavClasse').show();";
            echo "$('#ClasseNav').show();";
            echo "promo=" . $k . ";";
            echo "classe=" . $l . ";";
            echo "$('.etu-" . $k . "-" . $l . "').show();";
            echo "navigation=1;";
            echo "});});";
            echo "</script>";
        }
    }
    for ($p = $MinE["Min"]; $p <= $MaxE["Max"]; $p++) {
        echo "<script>$(document).ready(function() {";
        echo "$('#e-" . $p . "').click(function() {";
        echo "if( etudiant != " . $p . "){"; //jsp pk ca ne fonctionne plus
        echo '$(".comp-"+etudiant+"-0").hide();}';
        echo "etudiant = " . $p . ";";
        echo "document.getElementById('Etudiant').value=" . $p . ";";
        echo "$('.comp-'+etudiant+'-0').toggle();";
        echo "$('#comp').show();";
        echo "$('#comp2').show();";
        echo "$('#comp3').show();";
        echo "});});";
        echo "</script>";
    }

    for ($g = $MinComp["Min"]; $g <= $MaxComp["Max"]; $g++) {
        echo "<script>$(document).ready(function() {";
        echo "$('#comp-" . $g . "').click(function() {";
        echo "comp=" . $g . ";";
        echo "document.getElementById('NomComp').value=" . $g . ";";
        echo "});});";
        echo "</script>";
    }

    ?>

<?php 
    if ($_SESSION['popUp']>0){
        echo "<script>alert('La compétence a bien été ajoutée');</script>";
        $_SESSION['popUp']=0;
    }
    if ($_SESSION['popUp']<0){
        echo "<script>alert('Problème : une information n`existe pas dans la base de données');</script>";
        $_SESSION['popUp']=0;
    }
    
    ?>

</body>

</html>