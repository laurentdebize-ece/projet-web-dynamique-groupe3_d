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

$reponse = htmlspecialchars($_POST['newPromo']);
$insertStatement = $bdd->prepare("INSERT INTO promotion (anneeDePromo) VALUES (:reponse)");
echo 'L année reçu est : ' . $reponse . '<br>';
$insertStatement->bindParam(':reponse', $reponse);

if ($insertStatement->execute()) {
    echo "Nouveau enregistrement créé avec succès";
} else {
    echo "Impossible de créer l'enregistrement";
}

?>
<meta http-equiv="refresh" content="0;url=adminPromo.php">