<h1>
    traitement des données de la nouvelle classe 
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

$promo = htmlspecialchars($_POST['ID']);
$reponse = htmlspecialchars($_POST['newClasse']);
$insertStatement = $bdd->prepare("INSERT INTO classe (IdPromotion, classeNum) VALUES (:promo, :reponse)");
echo 'L année reçu est : ' . $reponse . '<br>';
echo 'La promo est : ' . $promo . '<br>';
$insertStatement->bindParam(':reponse', $reponse);
$insertStatement->bindParam(':promo', $promo);
if ($insertStatement->execute()) {
    echo "Nouveau enregistrement créé avec succès";
} else {
    echo "Impossible de créer l'enregistrement";
}

?>
<meta http-equiv="refresh" content="0;url=detailPromoAdmin.php">