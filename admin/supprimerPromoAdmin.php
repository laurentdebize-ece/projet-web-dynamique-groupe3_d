<h1>
    suppression d'une promotion 
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


$idPromo = $_POST['selecRad'];

if(isset($_POST['selecRad']))
{
    echo "L id recu est  : " . $idPromo . "<br>";
    $bdd->query('DELETE FROM promotion WHERE ID = '.$idPromo);
}


?>

<meta http-equiv="refresh" content="0;url=adminPromo.php">