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

    $promo=0;
    $classe=0;
    ?>



    <h1>Navigation</h1>

    <div class="container">

    <!-- Navigation des promos et séléction des classes-->   
        <div class="row" id=PromoNav>
            <div class="col-sm-4" id=menuDeroulePromo>
                <p>

                    <?php

                    $response = $bdd->query('SELECT * FROM promotion ORDER BY anneeDePromo');
                    while ($donnees = $response->fetch()) {
                        $response2 = $bdd->query('SELECT p.anneeDePromo, c.classeNum FROM promotion AS p, classe AS c WHERE p.ID=c.IdPromotion ORDER BY classeNum');
                        $MAX = $bdd->query('SELECT MAX(anneeDePromo) AS "Max" FROM promotion');
                        $MaxP = $MAX->fetch();
                        $MIN = $bdd->query('SELECT MIN(anneeDePromo) AS "Min" FROM promotion');
                        $MinP = $MIN->fetch();
                        $MAXC = $bdd->query('SELECT MAX(classeNum) AS "MaxC" FROM classe');
                        $MaxC = $MAXC->fetch();
                        $MINC = $bdd->query('SELECT MIN(classeNum) AS "MinC" FROM classe');
                        $MinC = $MINC->fetch();
                        echo "<p class= promo id=p-" . $donnees["anneeDePromo"] . ">Promo " . $donnees['anneeDePromo'] . "</p>";
                        while ($donnees2 = $response2->fetch()) {
                            if ($donnees["anneeDePromo"] == $donnees2["anneeDePromo"]) {
                                echo "<p class=c-" . $donnees["anneeDePromo"] . ">classe " . $donnees2["classeNum"] . "</p>";
                            }
                        }
                    }
                    ?>
                    <!-- id=c".$donnees2["classeNum"]."p".$donnees["anneeDePromo"]. -->
                </p>
            </div>
            <div class="col-sm-8" id=listeClasses>
                <p>
                    <?php
                    $nbcase= 0;
                        $response = $bdd->query('SELECT * FROM promotion ORDER BY anneeDePromo');
                    while ($donnees = $response->fetch()) {
                        $response2 = $bdd->query('SELECT p.anneeDePromo, c.classeNum FROM promotion AS p, classe AS c WHERE p.ID=c.IdPromotion ORDER BY classeNum');
                        echo "<div class='container'><div class='row'>";
                        while ($donnees2 = $response2->fetch()) {
                            if ($donnees["anneeDePromo"] == $donnees2["anneeDePromo"]) {
                                echo "<div class='col-sm-4'><p class=clist-" . $donnees["anneeDePromo"] . " id=clist-". $donnees["anneeDePromo"]."-".$donnees2["classeNum"].">classe " . $donnees2["classeNum"] . "</p></div>";
                                $nbcase= ($nbcase+1)%4;
                                if ($nbcase==0){
                                    echo "</div><div class='row'>";
                                }
                            }
                        }
                        if($nbcase!=4){
                            for($i=0;$i<4-$nbcase;$i++){
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
        <h2 class=titreNavClasse><span id='titreNavClasse'></span></h2>    
        <div class="row" id=ClasseNav>
            <div class="col-sm-4" id=etuMat>
            <?php       

                
                $response = $bdd->query('SELECT * FROM etudiant AS e, classe AS c, promotion AS p WHERE c.IdClasse=e.IdClasse AND c.IdPromotion=p.ID ORDER BY nomEtu');
                $MAXE = $bdd->query('SELECT MAX(IdEtudiant) AS "Max" FROM etudiant');
                $MaxE = $MAXE->fetch();
                $MINE = $bdd->query('SELECT MIN(IdEtudiant) AS "Min" FROM etudiant');
                $MinE = $MINE->fetch();
                $MAXM = $bdd->query('SELECT MAX(idMat) AS "Max" FROM matieres');
                $MaxM = $MAXM->fetch();
                $MINM = $bdd->query('SELECT MIN(idMat) AS "Min" FROM matieres');
                $MinM = $MINM->fetch();
                    while ($donnees = $response->fetch()) {;
                        $response2 = $bdd->query('SELECT * FROM etumat AS em, etudiant AS e, matieres AS m WHERE e.IdEtudiant=em.IdEtu AND em.IdMat=m.idMat ORDER BY nomMat');
                        
                        echo "<p class=etu-" . $donnees["anneeDePromo"]."-".$donnees["classeNum"]." id=e-" . $donnees["IdEtudiant"].">". $donnees["prenomEtu"]." ".$donnees["nomEtu"]."</p>";
                        while ($donnees2 = $response2->fetch()){
                            if ($donnees["IdEtudiant"] == $donnees2["IdEtudiant"]) {
                                echo "<p class=m-".$donnees["IdEtudiant"]." id=m-".$donnees2["idMat"]."-".$donnees["IdEtudiant"].">" . $donnees2["nomMat"] . "</p>";
                            }
                        }
                    }
                ?>
            </div>
            <div class="col-sm-8" id=matiereListe>
                <?php
                    $nbcase= 0;
                    $response = $bdd->query('SELECT * FROM etudiant AS e, classe AS c, promotion AS p WHERE c.IdClasse=e.IdClasse AND c.IdPromotion=p.ID ORDER BY nomEtu');
                        while ($donnees = $response->fetch()) {
                            $response2 = $bdd->query('SELECT * FROM etumat AS em, etudiant AS e, matieres AS m WHERE e.IdEtudiant=em.IdEtu AND em.IdMat=m.idMat ORDER BY nomMat');
                            echo "<div class='container'><div class='row'>";
                            while ($donnees2 = $response2->fetch()) {
                                if ($donnees["IdEtudiant"] == $donnees2["IdEtudiant"]) {
                                    echo "<div class='col-sm-4'><p class=mlist-" . $donnees["IdEtudiant"] . " id=mlist-". $donnees["IdEtudiant"]."-".$donnees2["idMat"].">" . $donnees2["nomMat"] . "</p></div>";
                                    $nbcase= ($nbcase+1)%4;
                                    if ($nbcase==0){
                                        echo "</div><div class='row'>";
                                    }
                                }
                            }
                            if($nbcase!=4){
                                for($i=0;$i<4-$nbcase;$i++){
                                    echo "<div class='col-sm-4'></div>"; 
                                }
                            }
                            echo "</div></div>";
                        }
                    ?>
            </div>
        </div>

<!-- navigation des compétence en fonction de la matière séléctionner -->

        <div class="row" id=MatiereNav>
        <div class="col-sm-4" id=typeMat>
            <?php  
                $response = $bdd->query('SELECT * FROM matieres ORDER BY idMat');
                while ($donnees = $response->fetch()) {
                    echo "<h2 id=mNom-" . $donnees["idMat"] . ">" . $donnees['nomMat'] . "</h2>";
                }
                echo "<p id=CompClick>Compétences</p>";
                echo "<p id=TransClick>Compétences Tranverses";      
                ?>
            </div>
            <div class="col-sm-8">
            <div class='container'><div class='row' id=comp>
            <div class='col-sm-4'>Nom de la Compétence</div>
            <div class='col-sm-4'>évalué le :</div>
            <div class='col-sm-4'>Niveau :</div>
            </div></div>
            <?php
                $response = $bdd->query('SELECT * FROM etudiant AS e, eval AS ev, evalcomp AS ec, competences AS c, niveau AS n WHERE e.IdEtudiant=ev.IdEtu AND ev.IdEval=ec.IdEval AND ec.IdComp=c.idCompetence  AND n.idNiv=c.IdNiv ORDER BY nomEtu');
                    while ($donnees = $response->fetch()) {
                        $response2 = $bdd->query('SELECT * FROM etumat AS em, etudiant AS e, matieres AS m, competences AS c, matcomp AS mc WHERE e.IdEtudiant=em.IdEtu AND em.IdMat=m.idMat AND m.idMat=mc.IdMat AND mc.IdCompetence=c.idCompetence ORDER BY nomCompetence');
                        while ($donnees2 = $response2->fetch()) {
                            if ($donnees["idCompetence"] == $donnees2["idCompetence"] && $donnees2["IdEtudiant"]==$donnees["IdEtudiant"]) {
                                echo "<div class='container'><div class='row'>";
                                echo "<div class='col-sm-4'><p class=comp-" . $donnees2["IdEtudiant"] . "-" . $donnees2["idMat"] . "-" . $donnees["trans"] . ">" . $donnees["nomCompetence"] . "</div></p>"; 
                                echo "<div class='col-sm-4'><p class=comp-" . $donnees2["IdEtudiant"] . "-" . $donnees2["idMat"] . "-" . $donnees["trans"] . ">" . $donnees["date"] . "</div></p>"; 
                                echo "<div class='col-sm-4'><p class=comp-" . $donnees2["IdEtudiant"] . "-" . $donnees2["idMat"] . "-" . $donnees["trans"] . ">" . $donnees["niv"] . "</div></p>"; 
                                echo "</div></div>";
                            }
                        }
                    }
            ?>
            </div>
        </div>
    </div>

    <!-- bouton de retour -->
    <p id=RETOUR>RETOUR</p>

    



<!-- code pour les interactions de click -->

<script>
    var navigation=0;
    var classe;
    var promo;
    var matiere;
    var etudiant;
    $(document).ready(function() {
        $('#RETOUR').click(function() {
            switch (navigation){
                case 0:
                    break;
                case 1:
                    $('#PromoNav').show();
                    $('#titreNavClasse').hide();
                    $('.etu-'+promo+'-'+classe).hide();
                    $('.m-'+etudiant).hide('slow');
                    $('.mlist-'+etudiant).hide();
                    navigation = 0;
                    break;
                case 2:
                    $('.titreNavClasse').show();
                    $('#ClassNav').show();
                    $('#etuMat').show();
                    $('#matiereListe').show();
                    $('#MatiereNav').hide(); 
                    $('#mNom-'+matiere).hide();
                    $('.comp-'+etudiant+'-'+matiere+'-0').hide();
                    $('.comp-'+etudiant+'-'+matiere+'-1').hide();
                    navigation=1;
                    break;
            }
        });
    });

    $(document).ready(function() {
        $('#CompClick').click(function() {
            $('#comp').show();
            $('.comp-'+etudiant+'-'+matiere+'-1').hide();
            $('.comp-'+etudiant+'-'+matiere+'-0').show();
        });
    });
    $(document).ready(function() {
        $('#TransClick').click(function() {
            $('#comp').show();
            $('.comp-'+etudiant+'-'+matiere+'-0').hide();
            $('.comp-'+etudiant+'-'+matiere+'-1').show();
        });
    });
</script>

<?php
    for ($j=$MinP["Min"] ; $j<=$MaxP["Max"] ; $j++){
    echo "<script>$(document).ready(function() {";
    echo "$('#p-".$j."').click(function() {";
    echo "$('.c-".$j."').slideToggle('slow');";
    echo "$('.clist-".$j."').toggle();";
    echo "});});";
    echo "</script>";
    }   

    for($k=$MinP["Min"] ; $k<=$MaxP["Max"] ; $k++){
        for($l=$MinC["MinC"] ; $l<=$MaxC["MaxC"] ; $l++){ 
            echo "<script>$(document).ready(function() {";
            echo "$('#clist-".$k."-".$l."').click(function() {";
            echo "document.getElementById('titreNavClasse').innerHTML = 'Classe ".$l." - Promo ".$k."';";
            echo "$('#PromoNav').hide();";
            echo "$('#titreNavClasse').show();";   
            echo "promo=".$k.";";
            echo "classe=".$l.";";  
            echo "$('.etu-".$k."-".$l."').show();";
            echo "navigation=1;";
            echo "});});";
            echo "</script>";
        }
    }
    for ($p=$MinE["Min"] ; $p<=$MaxE["Max"] ; $p++){
        echo "<script>$(document).ready(function() {";
        echo "$('#e-".$p."').click(function() {";
        echo "$('.m-".$p."').slideToggle('slow');";
        echo "$('.mlist-".$p."').toggle();";
        echo "});});";
        echo "</script>";
        }  
    for($t=$MinE["Min"] ; $t<=$MaxE["Max"] ; $t++){
        for($y=$MinM["Min"] ; $y<=$MaxM["Max"] ; $y++){
            echo "<script>$(document).ready(function() {";
            echo "$('#mlist-".$t."-".$y."').click(function() {";
            echo "$('.titreNavClasse').hide();"; 
            echo "$('#ClassNav').hide();";
            echo "$('#etuMat').hide();";
            echo "$('#matiereListe').hide();";
            echo "$('#MatiereNav').show();";  
            echo "matiere = ".$y.";"; 
            echo "etudiant = ".$t.";";
            echo "$('#mNom-".$y."').show();"; 
            echo "navigation=2;";   
            echo "});});";
            echo "</script>";
        }
    }

?>

</body>

</html>