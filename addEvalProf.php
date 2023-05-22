<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>addEval</title>
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
    ?>

    <?php 
        $response = $bdd->query("SELECT * FROM etudiant AS e, classe AS c, promotion AS p WHERE c.IdClasse=e.IdClasse AND c.IdPromotion=p.ID AND classeNum=$_POST[classe] AND anneeDePromo=$_POST[promo] ");
        while($donnees = $response->fetch()){

            $req ="INSERT INTO 'eval' ('date', 'IdEtu', 'IdProf') VALUES ( '$_POST[date]','$donnees[IdEtudiant]','$_SESSION[id]')";
            $bdd->exec($req); //ca ne fonctionne pas jsp pourquoi

            $response2 = $bdd->query("SELECT * FROM competences AS c WHERE nomCompetence=$_POST[comp] ");
            $response3 = $bdd->query("SELECT idEval FROM eval AS c WHERE 'date'=$_POST[date] AND IdEtu=$donnees[idEtudiant] AND IdProf=$_SESSION[id]");
            $idEval= $response3->fetch();
            while($donnees2 = $response2->fetch()){
                $req2 = "INSERT INTO 'evalcomp' ('IdEval', 'IdComp') VALUES( '$idEval','$donnees2[idCompetence]')";
                $bdd->exec($req2);
            }
        }        
    ?>

    <script>
        location.href='addEvalProfForm.php';
    </script>
    
</body>

</html>