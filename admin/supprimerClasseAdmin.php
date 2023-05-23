<h1>
    suppression d'une classe
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


$idClasse = $_POST['selecRad'];

if(isset($_POST['selecRad']))
{
    echo "L id recu est  : " . $idClasse . "<br>";
    $bdd->query('DELETE FROM enseignerclassmatprof WHERE IdClasse = '.$idClasse);
    $bdd->query('DELETE FROM etudiant WHERE IdClasse = '.$idClasse);
    $bdd->query('DELETE FROM classe WHERE IdClasse = '.$idClasse);
}


?>

<meta http-equiv="refresh" content="0;url=adminPromo.php">