<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>addEval</title>
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

    <form action="addEvalProf.php" method="post">
        <label for="Promo">Promo :</label><br>
        <input type='text' id="promo" name='promo'><br>
        <label for="classe">Classe :</label><br>
        <input type='text' id="classe" name='classe'><br>
        <label for="Date">Date :</label><br>
        <input type='date' id="date" name='date'><br>
        <label for="Comp">Nom de la Compétence :</label><br>
        <input type='text' id="NomComp" name='NomComp'><br>
        <input type='submit' id="Envoyer" value=Envoyer>
    </form>
    
</body>

</html>