<h1>
    traitement des données
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

$newMailProf = htmlspecialchars($_POST['newMailProf']);
$newNomProf = htmlspecialchars($_POST['newNomProf']);
$newPrenomProf = htmlspecialchars($_POST['newPrenomProf']);
$newMdp = htmlspecialchars($_POST['newMdp']);

$insertStatement = $bdd->prepare("INSERT INTO professeurs (mailProf, nomProf, prenomProf, mdp) 
    VALUES (:newMailProf, :newNomProf, :newPrenomProf, :newMdp)");
echo 'Le mail reçu est : ' . $newMailProf . '<br>';
echo 'Le nom reçu est : ' . $newNomProf . '<br>';
echo 'Le prenom reçu est : ' . $newPrenomProf . '<br>';
echo 'Le mdp reçu est : ' . $newMdp . '<br>';

$insertStatement->bindParam(':newMailProf', $newMailProf);
$insertStatement->bindParam(':newNomProf', $newNomProf);
$insertStatement->bindParam(':newPrenomProf', $newPrenomProf);
$insertStatement->bindParam(':newMdp', $newMdp);


if ($insertStatement->execute()) {
    echo "Nouveau enregistrement créé avec succès";
} else {
    echo "Impossible de créer l'enregistrement";
}

?>

<meta http-equiv="refresh" content="0;url=adminProf.php">
