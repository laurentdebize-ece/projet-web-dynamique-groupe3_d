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
    if (isset($_POST['date'], $_POST['NomComp'], $_SESSION['id'], $_POST['classe'], $_POST['promo'])) {
        $_SESSION['popUp'] = 1;
        $NewDate = htmlspecialchars($_POST['date']);
        $comp = htmlspecialchars($_POST['NomComp']);
        $IDprof = htmlspecialchars($_SESSION['id']);
        $classe = htmlspecialchars($_POST['classe']);
        $promo = htmlspecialchars($_POST['promo']);
        $response = $bdd->query("SELECT * FROM etudiant AS e, classe AS c, promotion AS p WHERE c.IdClasse=e.IdClasse AND c.IdPromotion=p.ID AND classeNum='$classe' AND anneeDePromo='$promo' ");
        while ($donnees = $response->fetch()) {
            if ($donnees['IdEtudiant'] == NULL) {
                $_SESSION['popUp'] = -1;
                echo "<script>location.href = 'addEvalProfForm.php';</script>";
            }
            //echo $donnees['IdEtudiant']."<br>";
            else {
                $req = "INSERT INTO `eval`(`date`, `IdEtu`, `IdProf`) VALUES( :NewDate,:IdEtudiant,:id)";
                $InsertStatement = $bdd->prepare($req);
                $InsertStatement->bindParam(':NewDate', $NewDate);
                $InsertStatement->bindParam(':IdEtudiant', $donnees['IdEtudiant']);
                $InsertStatement->bindParam(':id', $IDprof);
                if ($InsertStatement->execute()) {
                    echo "Nouveau enregistrement créé avec succès";
                } else {
                    echo "Impossible de créer l'enregistrement";
                }
                $response2 = $bdd->query("SELECT * FROM competences AS c, niveau AS n WHERE n.idNiv=c.IdNiv AND nomCompetence='$comp' AND (niv=0 OR niv='Non Evalué')");
                $IdEtudiant = $donnees['IdEtudiant'];
                $response3 = $bdd->query("SELECT * FROM eval AS c WHERE `date`='$NewDate' AND IdEtu='$IdEtudiant' AND IdProf='$IDprof'");
                $idEval = $response3->fetch();
                $donnees2 = $response2->fetch();
                if ($donnees2['idCompetence'] == NULL) {
                    $_SESSION['popUp'] = -1;
                    echo "<script>location.href = 'addEvalProfForm.php';</script>";
                } else {
                    $req2 = "INSERT INTO `evalcomp` (`IdEval`, `IdComp`) VALUES(:idEval, :idComp)";
                    $exec = $bdd->prepare($req2);
                    $exec->bindParam(':idEval', $idEval['idEval']);
                    $exec->bindParam(':idComp', $donnees2['idCompetence']);
                    if ($exec->execute()) {
                        echo "succès";
                    } else {
                        echo "Impossible de créer l'enregistrement";
                    }
                }
            }
        }
    } else {
        $_SESSION['popUp'] = -1;
    }
    ?>


    <script>
        location.href = 'addEvalProfForm.php';
    </script>

</body>

</html>