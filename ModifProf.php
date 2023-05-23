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

    $comp = htmlspecialchars($_POST['NomComp']);
    $etu = htmlspecialchars($_POST['Etudiant']);
    $progress = htmlspecialchars($_POST['progression']);
    $IDprof = htmlspecialchars($_SESSION['id']);

    $response = $bdd->query("SELECT * FROM competences WHERE NomCompetence='$comp'");
    $donnees = $response->fetch();
    if ($donnees != NULL) {
        $_SESSION['popUp'] = $etu;
        $response2 = $bdd->query("SELECT * FROM eval AS e, evalcomp AS ec, competences AS c WHERE e.idEval=ec.IdEval AND ec.IdComp=c.idCompetence AND idEtu='$etu' AND IdProf='$IDprof' AND NomCompetence='$comp'");
        $donnees2 = $response2->fetch();
        echo $donnees2['idEval']."<br>";
        echo $donnees2['idCompetence']."<br>";
        $response3 = $bdd->query("SELECT * FROM competences WHERE NomCompetence='$comp' AND idNiv='$progress'");
        $donnees3 = $response3->fetch();
        echo $donnees3['idCompetence']."<br>";
        $req = $bdd->prepare("UPDATE evalcomp AS ec SET IdComp = :NewIdComp WHERE IdEval = :NewIdEval AND IdComp=:FormerComp");
        $req->bindParam(':NewIdComp', $donnees3['idCompetence']);
        $req->bindParam(':NewIdEval', $donnees2['idEval']);
        $req->bindParam(':FormerComp', $donnees2['idCompetence']);
        $req->execute();
    }
    else{$_SESSION['popUp'] = -$etu;}
    ?>
    <script>

        location.href = 'navigationPromoProf.php';
    </script>
</body>

</html>