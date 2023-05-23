<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supp classe </title>
</head>
<body>
    <?php
        $id_classe = $_POST['id_classe'];
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
        $request = 'DELETE FROM enseignerclassmatprof WHERE IdClasse = :idClasse';
        $req = $bdd->prepare($request);
        $req->bindValue(':idClasse', $id_classe);
        $req->execute();
        $data = array();

        if($req->rowCount()>0){
            $data['status'] = 'reussi 1';
            $data['message'] = 'Enseignant supprimé avec succès';
        }

        $request = 'DELETE FROM etudiant WHERE IdClasse = :idClasse';
        $req = $bdd->prepare($request);
        $req->bindValue(':idClasse', $id_classe);
        $req->execute();


        $request = 'DELETE FROM classe WHERE IdClasse = :idClasse';
        $req = $bdd->prepare($request);
        $req->bindValue(':idClasse', $id_classe);
        $req->execute();
        
        //header('Location: mon_espace.php');
    ?>
</body>
</html>