<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails d'une compétences</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">
    </script>
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

    if (isset($_GET['nomComp']) && isset($_GET['idComp'])) {
        $nomCompSelect = $_GET['nomComp'];
        $idCompSelect = $_GET['idComp'];
        $idEtudiant = $_SESSION['id'];
    }
    
    $request = $bdd->query('SELECT * FROM eval JOIN evalcomp ON eval.idEval = evalcomp.IdEval AND evalcomp.IdComp = '.$idCompSelect);
    if ($request->rowCount() == 0){
        ?>
        <div class='competence-casier-container-4'>
            <div class='competence-casier-container-title'>
                <h1><?php echo $nomCompSelect; ?></h1>
            </div>
            <div class='competence-casier-container-corps'>
                <p>Vous n'avez pas encore d'évaluation pour cette compétence</p>   
            </div>
            <div class='competence-casier-container-button'>
                    <a href="evaluation.php?idComp=<?php echo $idCompSelect;?>">S'évaluer</a>
            </div>
            <div class='competence-casier-container-button'>
                    <a href="etudiant.php">Retour</a>
            </div>
        </div>
        <?php
    }
    else{
        $eval = $request->fetch();
    
        $request = $bdd->query('SELECT * FROM niveau JOIN competences ON niveau.idNiv = competences.IdNiv AND competences.IdCompetence = '.$idCompSelect);
        $niveau = $request->fetch();
        
        $request = $bdd->query('SELECT * FROM commentaire WHERE IdNiv = '.$niveau['idNiv']);
        $commentaire = $request->fetch();
        
        
        ?>
        
            <div class='competence-casier-container-<?php echo $niveau['idNiv']; ?>'>
                <div class='competence-casier-container-title'>
                    <h1><?php echo $nomCompSelect; ?></h1>
                </div>
                <div class='competence-casier-container-corps'>
                    <p>Evaluation du <?php echo date("d/m/Y", strtotime($eval['date'])); ?>.</p>
                    <p>Progression : <?php echo $niveau['niv']; ?></p>   
                    <p>Commentaire : <?php echo (isset($commentaire['texte']))? $commentaire['texte'] : "En attente de validation"; ?></p>
                </div>
                <div class='competence-casier-container-button'>
                    <a href="evaluation.php?idComp=<?php echo $idCompSelect;?>&idEval=<?php echo $eval['idEval'];?>">S'évaluer</a>
                </div>
                <div class='competence-casier-container-button'>
                        <a href="etudiant.php">Retour</a>
                </div>
            </div>
        <?php
        
    }
    
    ?>
</body>

</html>