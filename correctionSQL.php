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
    <?php

    $etu = htmlspecialchars($_POST['IdEtu']);
    echo $etu . "<br>";
    $IdEval = htmlspecialchars($_POST['IdEval']);
    echo $IdEval . "<br>";
    $IdComp = htmlspecialchars($_POST['IdComp']);
    echo $IdComp . "<br>";
    $progress = htmlspecialchars($_POST['progression']);
    echo $progress . "<br>";
    $comment = htmlspecialchars($_POST['Commentaire']);
    echo $comment . "<br>";
    $IDprof = htmlspecialchars($_SESSION['id']);
    echo $IDprof . "<br>";


    $response2 = $bdd->query("SELECT * FROM competences AS c WHERE idCompetence='$IdComp'");
    $donnees2 = $response2->fetch();
    $NC = $donnees2['nomCompetence'];
    echo $NC . "<br>";
    $response3 = $bdd->query("SELECT * FROM competences WHERE nomCompetence='$NC' AND idNiv='$progress'");
    $donnees3 = $response3->fetch();
    echo $donnees3['idCompetence'] . "<br>";
    $req = $bdd->prepare("UPDATE evalcomp AS ec SET IdComp = :NewIdComp WHERE IdEval = :NewIdEval AND IdComp=:FormerComp");
    $req->bindParam(':NewIdComp', $donnees3['idCompetence']);
    $req->bindParam(':NewIdEval', $IdEval);
    $req->bindParam(':FormerComp', $IdComp);
    $req->execute();

    /* $response = $bdd->query("SELECT * FROM commentaire WHERE IdEval='$IdEval'");
    $donnees = $response->fetch();
    if ($donnees['texte'] == NULL) {
        $req2 = $bdd->prepare("INSERT INTO `commentaire`(`texte`, `IdNIv`, `IdProf`, `IdEtu`, `IdEval`) VALUES (:comment , :progress , :idProf , :etu , :IdEval )");
        $req2->bindParam(':comment', $comment);
        $req2->bindParam(':progress', $progress);
        $req2->bindParam(':idProf', $IDprof);
        $req2->bindParam(':etu', $etu);
        $req2->bindParam(':IdEval', $IdEval);
        $req->execute();
    } else {
        $req3 = $bdd->prepare("UPDATE commentaire AS c SET texte=:comment WHERE IdEval='$IdEval'");
        $req3->bindParam(':comment', $comment);
        $req3->execute();
    } */
    ?>
    <script>
        location.href = 'correction.php';
    </script>
</body>

</html>