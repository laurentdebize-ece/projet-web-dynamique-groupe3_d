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
    session_start();
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
    $idMat = $_POST['idMat'];
    $idEtudiant = $_SESSION['id'];
    $req = $bdd->prepare('INSERT INTO etumat(idMat, idEtu) VALUES(:idMatiere, :idEtudiant)');
    $req->execute(array(
        'idMatiere' => $idMat,
        'idEtudiant' => $idEtudiant
    ));
    ?>
</body>
</html>