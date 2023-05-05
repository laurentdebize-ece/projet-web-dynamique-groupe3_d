<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Accueil</title>

    <link rel="stylesheet" href="style.css">
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
    <h1>Mon compte</h1>
    <?php
    $response =  $response = $bdd->query('SELECT * FROM etudiant');

    while ($donnees = $response->fetch()) {
    ?>
        <p>
            Nom: <?php echo $donnees['nomEtu']; ?><br>
            Prenom : <?php echo $donnees['prenomEtu']; ?><br>
            Mon identifiant : <?php echo $donnees['mailEtu']; ?> <br>
             Mon mot de passe: <?php echo $donnees['mdp'] ?> ; <br>
                <input type="submit" value="m'auto-évaluer" name=evaluation>
                <a href="etudiant.php"><input type="button" value="retour"></a> 
        </p>

    <?php
    }
    ?>

</body>

</html>