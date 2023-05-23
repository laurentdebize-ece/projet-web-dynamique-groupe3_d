<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouter etudiant </title>
</head>
<body>
    <?php
        $id_classe = $_POST['id_classe'];
        $id_nomEtu= $_POST['id_nomEtu'];
        $id_prenomEtu= $_POST['id_prenomEtu'];
        $id_mailEtu= $_POST['id_mailEtu'];
        $id_mdpEtu= $_POST['id_mdpEtu'];

        
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
        $request = 'INSERT INTO etudiant (nomEtu, prenomEtu, mdp, IdClasse, mailEtu) VALUES (:nomEtu, :prenomEtu, :mdp, :IdClasse, :mailEtu)';
        $req = $bdd->prepare($request);
        $req->bindValue(':nomEtu', $id_nomEtu );
        $req->bindValue(':prenomEtu', $id_prenomEtu);
        $req->bindValue(':mdp', $id_mdpEtu);
        $req->bindValue(':IdClasse', $id_classe);
        $req->bindValue(':mailEtu', $id_mailEtu);
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

