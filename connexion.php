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
            switch ($_POST['selct']){
                case 1 : 
                    $response = $bdd->query('SELECT * FROM etudiant');
                    if(isset($_POST['MdP'], $_POST['ID'])){
                        while ($donnees = $response->fetch()) {
                            if ($donnees['mdp'] == $_POST['MdP'] && $donnees['mailEtu'] == $_POST['ID'] && $trouve==0) {
                                echo "<p> Bravo vous vous etes co!!!</p>";
                                $trouve=1;
                            }
                        }
                        if($trouve==0){
                            echo "<p> Mauvais ID ou MdP</p>";
                            echo '<p><a href="accueil.php">
                            Cliquez ici pour revenir à la page précédente</a></p>';
                        }
                    }
                    break;
                case 2 : 
                    $response = $bdd->query('SELECT * FROM professeurs');
                    if(isset($_POST['MdP'], $_POST['ID'])){
                        while ($donnees = $response->fetch()) {
                            if ($donnees['mdp'] == $_POST['MdP'] && $donnees['mailProf'] == $_POST['ID'] && $trouve==0) {
                                echo "<p> Bravo vous vous etes co!!!</p>";
                                $trouve=1;
                            }
                        }
                        if($trouve==0){
                            echo "<p> Mauvais ID ou MdP</p>";
                            echo '<p><a href="accueil.php">
                            Cliquez ici pour revenir à la page précédente</a></p>';
                        }
                    }
                    break;
                case 3 : 
                    $response = $bdd->query('SELECT * FROM administrateur');
                    if(isset($_POST['MdP'], $_POST['ID'])){
                        while ($donnees = $response->fetch()) {
                            if ($donnees['mdp'] == $_POST['MdP'] && $donnees['mailAdmin'] == $_POST['ID'] && $trouve==0) {
                                echo "<p> Bravo vous vous etes co!!!</p>";
                                $trouve=1;
                            }
                        }
                        if($trouve==0){
                            echo "<p> Mauvais ID ou MdP</p>";
                            echo '<p><a href="accueil.php">
                            Cliquez ici pour revenir à la page précédente</a></p>';
                        }
                    }
                    break;

            }
                ?>
</body>

</html>