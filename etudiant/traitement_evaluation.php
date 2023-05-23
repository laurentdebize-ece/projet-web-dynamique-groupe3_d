<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veuillez patienter...</title>
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

    $option = $_POST['option'];

    $etudiant = $bdd->query('SELECT * FROM etudiant WHERE IdEtudiant = '.$idEtu);
    $etudiant = $etudiant->fetch();

    $classe = $bdd->query('SELECT * FROM classe WHERE IdClasse = '.$etudiant['IdClasse']);
    $classe = $classe->fetch();

    $comp = $bdd->query('SELECT * FROM competence WHERE IdCompetence = '.$idComp);
    
    $matieres = $bdd->query('SELECT * FROM matieres 
    JOIN matcomp ON matieres.idMat = matcomp.IdMat
    JOIN competence ON matcomp.IdCompetence = competence.IdCompetence
    WHERE competence.IdCompetence = '.$idComp);

    $date = date("Y-m-d");
    $bdd->query('INSERT INTO eval (date, IdEtu, IdProf) VALUES (NOW(), ' . $idEtu . ')');

    ?>
</body>
</html>