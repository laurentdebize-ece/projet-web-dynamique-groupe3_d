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

    $comp = $_POST['NomComp'];
    echo $comp;
    $etu = $_SESSION['NumEtu'];
    echo $etu;
    $progresse=$_POST['progression'];
    echo $_POST['progression'];
    /* $response4 = $bdd->query("SELECT * FROM eval AS e, evalcomp AS ec WHERE e.idEval=ec.IdEval AND ec.IdComp='$comp' AND idEtu='$etu'");
$donneesTransi = $response4->fetch();
$NewIdEval = $donneesTransi;
$req = $bdd->prepare("UPDATE evalcomp AS ec SET IdComp = :Newprogress WHERE ec.idEval = :NewIdEval");
$req->execute(array('Newprogress' => $Newprogress, 'NewIdEval' => $NewIdEval));
?>
if (NewNomComp != '') {
<?php
$response = $bdd->query("SELECT nomCompetence, idNiv FROM competences WHERE idCompetence='$comp'");
$donnees = $response->fetch();
$nomComp = $donnees;
$NewNomComp = '<script type="text/javascript">document.write(NewNomComp);</script>';
$reponse = $bdd->query("SELECT idCompetence FROM competences WHERE nomCompetence='$nomComp'");
while ($donnees2 = $reponse->fetch()) {
    $IDcomp = $donnees2['idCompetence'];
    $req2 = $bdd->prepare("UPDATE competences AS c SET nomCompetence = :NewNomComp WHERE c.idCompetence = :IDcomp");
    $req2->execute(array('NewNomComp' => $NewNomComp, 'IDcomp' => $IDcomp));
}
?>
} */ ?>
</body>
</html>