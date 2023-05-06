<?php session_start(); ?>
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
    <p>
    <form>
        Nom: <?php echo $_SESSION['nom'] ?> <br>
        Prenom : <?php echo $_SESSION['prenom'] ?> <br>
        Mon identifiant : <?php echo $_SESSION['mail'] ?> <br>
        Mon mot de passe: <?php echo $_SESSION['mdp'] ?> <br>
        <button type="submit" value="m'auto-évaluer" name=evaluation>
            <a href="etudiant.php"><button type="submit" value="retour"></a>
    </form>
    </p>


</body>

</html>