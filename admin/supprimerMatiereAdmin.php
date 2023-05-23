<h1>
    suppression d'une matière
</h1>

<?php

try {
    $bdd = new PDO(
        'mysql:host=localhost;dbname=omnes_skills;charset=utf8',
        'root',
        'root',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    echo "connexion réussie <br>";
} catch (Exception $e) {
    die('ERREUR : ' . $e->getMessage());
    echo "echec connexion <br>";
}


$idMat = $_POST['selecRad'];

if(isset($_POST['selecRad']))
{
    echo "L id recu est  : " . $idMat . "<br>";
    $bdd->query('DELETE FROM enseignerclassmatprof WHERE idMat = '.$idMat);
    $bdd->query('DELETE FROM matieres WHERE idMat = '.$idMat);
}


?>

<meta http-equiv="refresh" content="0;url=adminMatiere.php">
