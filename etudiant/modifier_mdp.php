<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veuillez patienter...</title>
</head>
<body>
    <h1>Veuillez patienter...</h1>
    <?php
        session_start();
        $new_pwd = $_POST['new_pwd'];
        $id_etudiant = $_SESSION['id'];
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

        $request = 'UPDATE etudiant SET mdp = :new_pwd WHERE IdEtudiant = :id_etudiant';
        $req = $bdd->prepare($request);
        $req->execute(array(
            'new_pwd' => $new_pwd,
            'id_etudiant' => $id_etudiant
        ));
        $_SESSION['mdp'] = $new_pwd;
        header('Location: mon_espace.php');
    ?>
</body>
</html>