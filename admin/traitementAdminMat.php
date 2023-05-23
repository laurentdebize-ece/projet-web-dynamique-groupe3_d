<h1>
    traitement des données de la matiere
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

$newNomMat = htmlspecialchars($_POST['newNomMat']);
$newVolumeHoraire = htmlspecialchars($_POST['newVolumeHoraire']);

$insertStatement = $bdd->prepare("INSERT INTO matieres ( nomMat, volumeHoraire) 
    VALUES (:newNomMat,  :newVolumeHoraire)");
echo 'Le nom reçu est : ' . $newNomMat . '<br>';
echo 'Le volume reçu est : ' . $newVolumeHoraire . '<br>';


$insertStatement->bindParam(':newNomMat', $newNomMat);
$insertStatement->bindParam(':newVolumeHoraire', $newVolumeHoraire);



if ($insertStatement->execute()) {
    echo "Nouveau enregistrement créé avec succès";
} else {
    echo "Impossible de créer l'enregistrement";
}

?>

<meta http-equiv="refresh" content="0;url=adminMatiere.php">
