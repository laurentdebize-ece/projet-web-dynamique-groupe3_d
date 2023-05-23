<h1>
    suppression d'un professeurs 
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


$idProf = $_POST['selecRad'];

if(isset($_POST['selecRad']))
{
    echo "L id recu est  : " . $idProf . "<br>";
    $bdd->query('DELETE FROM professeurs WHERE IdProf = '.$idProf);
}


?>

<meta http-equiv="refresh" content="0;url=adminProf.php">
