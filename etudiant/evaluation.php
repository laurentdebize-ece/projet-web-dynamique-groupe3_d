<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Evaluation</title>
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
        try {
            $bdd = new PDO(
                'mysql:host=localhost;dbname=omnes_skills;
        charset=utf8',
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    if (isset($_GET['idComp']) && isset($_SESSION['id'])) {
        $idComp = $_GET['idComp'];
        $idEtu = $_SESSION['id'];
    }
    if(isset($_GET['idEval'])){
        $idEval = $_GET['idEval'];
    }
    ?>
    <div class="head"> 
    <h1>Vous pouvez à présent vous évaluer !</h1>
    <a href="etudiant.php"><button type="submit" id="retour" value=retour>Retour</button></a>
    </div>
    <form method='post' action='traitement_evaluation.php?idComp=<?php echo $idComp; echo (isset($_GET['idEval']))? "&idEval=".$_GET['idEval'] : ''?>'>
        <select>
            <option name='option' value="1">Acquis</option>
            <option name='option' value="2">En cours d'acqisition</option>
            <option name='option' value="3">Non acquis</option>
        </select>
        <input type='submit' value='Valider'>
    </form>
</body>
</html>