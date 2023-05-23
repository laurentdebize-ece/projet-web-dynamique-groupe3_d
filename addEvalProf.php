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
        $NewDate = htmlspecialchars($_POST['date']);
        $comp = htmlspecialchars($_POST['NomComp']);
        $IDprof = htmlspecialchars($_SESSION['id']);
        $classe = htmlspecialchars($_POST['classe']);
        $promo = htmlspecialchars($_POST['promo']);
        $response = $bdd->query("SELECT * FROM etudiant AS e, classe AS c, promotion AS p WHERE c.IdClasse=e.IdClasse AND c.IdPromotion=p.ID AND classeNum='$classe' AND anneeDePromo='$promo' ");
        while($donnees = $response->fetch()){
            $req ="INSERT INTO 'eval' ('date', 'IdEtu', 'IdProf') VALUES ( :NewDate,:IdEtudiant,:id)";
            $InsertStatement = $bdd->prepare($req); 
            $InsertStatement->bindParam(':NewDate', $NewDate);
            $InsertStatement->bindParam(':IdEtudiant', $donnees['idEtudiant']);
            $InsertStatement->bindParam(':id', $IDprof);


            $response2 = $bdd->query("SELECT * FROM competences AS c WHERE nomCompetence='$comp'");
            $IdEtudiant = $donnees['idEtudiant'];
            $response3 = $bdd->query("SELECT idEval FROM eval AS c WHERE 'date'='$NewDate' AND IdEtu='$IdEtudiant' AND IdProf='$IDprof'");
            $idEval= $response3->fetch();
            while($donnees2 = $response2->fetch()){
                $req2 = "INSERT INTO 'evalcomp' ('IdEval', 'IdComp') VALUES( :idEval, ':idComp')";               
                $exec=$bdd->prepare($req2);
                $exec->bindParam(':idEvale', $idEval['idEval']);
                $exec->bindParam(':idComp', $donnees2['idCompetence']);
                if ($exec->execute()) {
                    echo "succès";
                } else {
                    echo "Impossible de créer l'enregistrement";
                }
            }
        } 
        if ($insertStatement->execute()) {
            echo "Nouveau enregistrement créé avec succès";
        } else {
            echo "Impossible de créer l'enregistrement";
        }       
    ?>


    <script>
        //location.href='addEvalProfForm.php';
    </script>
    
</body>

</html>