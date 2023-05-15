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
            '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    ?>
    <?php
            $trouve=0;
            $value= $_POST['role'];
            $login= $_POST['ID']; 
            $pwd= $_POST['MdP'];
            switch ($value){
                case 1 : {
                    $response = $bdd->query('SELECT * FROM etudiant');
                    if(isset($pwd, $login)){
                        while ($donnees = $response->fetch()) {
                            if ($donnees['mdp'] == $pwd && $donnees['mailEtu'] == $login && $trouve==0) {
                                session_start(); 
                                $_SESSION ['nom'] = $donnees['nomEtu']; 
                                $_SESSION ['prenom'] = $donnees['prenomEtu']; 
                                $_SESSION ['mail'] = $donnees['mailEtu']; 
                                $_SESSION ['mdp'] = $donnees['mdp']; 
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
                                session_start(); 
                                $_SESSION ['nom'] = $donnees['nomProf']; 
                                $_SESSION ['prenom'] = $donnees['prenomProf']; 
                                $_SESSION ['mail'] = $donnees['mailProf']; 
                                $_SESSION ['mdp'] = $donnees['mdp']; 
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
                                session_start(); 
                                $_SESSION ['nom'] = $donnees['nomAdmin']; 
                                $_SESSION ['prenom'] = $donnees['prenomAdmin']; 
                                $_SESSION ['mail'] = $donnees['mailAdmin']; 
                                $_SESSION ['mdp'] = $donnees['mdp']; 
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