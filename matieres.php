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
    <h1>Mes matières</h1>
    <?php
    $response =  $response = $bdd->query('SELECT * FROM matieres');

    while ($donnees = $response->fetch()) {
    ?>
        <ol>
            <li> <?php echo $donnees['nomMat']; ?> </li>
        </ol>
    <?php
    }

    ?>
    <h2>Mes compétences associées</h2>
    <?php
    $response =  $response = $bdd->query('SELECT * FROM competences');

    while ($donnees = $response->fetch()) {
    ?>
        <ol>
            <li> <?php echo $donnees['nomCompetence']; ?> </li>
        </ol>
    <?php
    }
    ?>
</body>

</html>