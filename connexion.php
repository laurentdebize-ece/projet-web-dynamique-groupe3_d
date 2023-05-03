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


    <p>Bonjour <?php
            $trouve=0;
            if(isset($_POST['MdP'], $_POST['ID'])){
                $response = $bdd->query('SELECT * FROM administrateur');
                while ($donnees = $response->fetch()) {
                    if ($donnees['mdp'] == $_POST['MdP'] && $donnees['mailAdmin'] == $_POST['ID'] && $trouve==0) {
                        echo "<p> connexion!!!</p>";
                        $trouve=1;
                    } else if ($donnees['mdp'] == $_POST['MdP'] && $trouve==0 || $donnees['mailAdmin'] == $_POST['ID'] && $trouve==0 ) {
                        echo "<p> identifiant ou mot de passe incorrect</p>";
                        echo '<p><a href="accueil.php">
                        Cliquez ici pour revenir à la page précédente</a></p>';
                        $trouve=1;
                    }

                }
                if($trouve==0){
                    echo "<p> Mauvais ID ou MdP</p>";
                    echo '<p> <a href="index.php">
                    Cliquez ici pour revenir à la page précédente</a></p>';
                }
            }
                ?>
</body>

</html>