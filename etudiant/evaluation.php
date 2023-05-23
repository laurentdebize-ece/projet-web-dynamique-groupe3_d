<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation</title>
</head>
<body>
    <h1>Evaluation</h1>
    <!-- Page de test d'évaluation, elle sert à entrer une note nous-même pour l'instant. cette note sera utilisée pour créer une nouvelle note et remplacer la précédente -->
    <form action="evaluation.php" method="post">
        <label for="note">Note</label>
        <input type="number" name="note" id="note" min="0" max="20" step="0.01">
        <input type="submit" value="Valider">
    </form>
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
    if (isset($_POST['note'])) {
        $note = $_POST['note'];
        $idEtudiant = $_SESSION['id'];
        $idMatiere = 1;
        $req = $bdd->prepare('INSERT INTO note (note, idEtu, idMat) VALUES (:note, :idEtudiant, :idMatiere)');
        $req->execute(array(
            'note' => $note,
            'idEtudiant' => $idEtudiant,
            'idMatiere' => $idMatiere
        ));
        $req = $bdd->prepare('SELECT idNote FROM note ORDER BY idNote DESC LIMIT 1');
        $req->execute();
        $idNote = $req->fetch();
        $idNote = $idNote['idNote'];
        $req = $bdd->prepare('UPDATE etumat SET idNote = :idNote WHERE idEtu = :idEtudiant AND idMat = :idMatiere');
        $req->execute(array(
            'idNote' => $idNote,
            'idEtudiant' => $idEtudiant,
            'idMatiere' => $idMatiere
        ));
    }

    ?>
</body>
</html>