<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>IDK</title>
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
    <?php
            $trouve=0;
            $value= $_POST['role'];
            switch ($value){
                case 1 : {
                    $response = $bdd->query('SELECT * FROM etudiant');
                    if(isset($_POST['MdP'], $_POST['ID'])){
                        while ($donnees = $response->fetch()) {
                            if ($donnees['mdp'] == $_POST['MdP'] && $donnees['mailEtu'] == $_POST['ID'] && $trouve==0) {
                                header("Location: etudiant.php");
                                $trouve=1;
                            }
                        }
                        if($trouve==0){
                            echo "<p> Mauvais ID ou MdP. Vous allez être redirigé vers la page d'accueil dans 5s</p>";
                            header("refresh:5;url=login.php"); 
                        }
                    }
                    break;
                }
                case 2 : {
                    $response = $bdd->query('SELECT * FROM professeurs');
                    if(isset($_POST['MdP'], $_POST['ID'])){
                        while ($donnees = $response->fetch()) {
                            if ($donnees['mdp'] == $_POST['MdP'] && $donnees['mailProf'] == $_POST['ID'] && $trouve==0) {
                                header("Location: prof.php");
                                $trouve=1;

                            }
                        }
                        if($trouve==0){
                            echo "<p> Mauvais ID ou MdP. Vous allez être redirigé vers la page d'accueil dans 5s</p>";
                            header("refresh:5;url=login.php"); 
                        }
                    }
                    break;
                }
                case 3 : {
                    $response = $bdd->query('SELECT * FROM administrateur');
                    if(isset($_POST['MdP'], $_POST['ID'])){
                        while ($donnees = $response->fetch()) {
                            if ($donnees['mdp'] == $_POST['MdP'] && $donnees['mailAdmin'] == $_POST['ID'] && $trouve==0) {
                                header("Location: admin.php");
                                $trouve=1;
                            }
                        }
                        if($trouve==0){
                            echo "<p> Mauvais ID ou MdP. Vous allez être redirigé vers la page d'accueil dans 5s</p>";
                            header("refresh:5;url=login.php"); 
                        }
                    }
                    break;
                }

            }
                ?>
</body>

</html>