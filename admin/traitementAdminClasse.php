<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouter classe </title>
</head>
<body>
    <?php
        $id_classe = $_POST['id_classe'];
        $id_promo= $_POST['id_promo'];
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
        $request = 'INSERT INTO classe (classeNum, IdPromotion) VALUES (:idClasse, :idPromo)';
        $req = $bdd->prepare($request);
        $req->bindValue(':idClasse', $id_classe);
        $req->bindValue(':idPromo', $id_promo);
        $req->execute();
        $data = array();

        if($req->rowCount()>0){
            $data['status'] = 'reussi 1';
            $data['message'] = 'classe créée avec succes';
            //fait moi un message d'alert 
            $data['alert'] = 'alert-success';
        }
        
        //header('Location: mon_espace.php');
    ?>
</body>
</html>

