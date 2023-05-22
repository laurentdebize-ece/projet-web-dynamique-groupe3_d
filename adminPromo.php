<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--icone du site-->
    <link rel="icon" href="./image/mathcat.ico" type="image/x-icon">
    <!--lien vers la page css-->
    <link href="adminStyle.css" rel="stylesheet" type="text/css" />
    <title>AdminPromo</title>
</head>

<body>
    <h1>Admin Promo</h1>
    <h2>Voici les promotions de l'établissement : </h2>

    <?php
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=omnes_skills;charset=utf8',
            'root',
            'root',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (Exception $e) {
        die('ERREUR : ' . $e->getMessage());
    }

    if($bdd){
    

        $reponse = $bdd->query('SELECT * FROM promotion');
        while ($donnees = $reponse->fetch()) {

    ?>
            <br>
            <button class="promo" type="button" onclick="openPromo()">
                <!--ouvre la page qui accede aux classes de la promo-->

                <?php echo $donnees['anneeDePromo']; ?>
            </button>
            <br>
    <?php

        }
    }
    else{
        echo "erreur d'accès à la bdd";

    }
    $reponse->closeCursor();

    ?>

    <button class="open-button" onclick="openForm()">+</button>



    <div class="form-popup" id="myForm">
        <form action="traitementAdminPromo.php" method="post" class="form-container">
            <h3>Création d'une nouvelle promotion</h3>

            <label for="newPromo"><b> ANNEE : <br><span class="exempleDate"> exemple "2021" </span></b></label>
            <input type="text" placeholder="Entrez l'année" id="newPromo" name="newPromo" pattern="[0-9]{4}" required>

            <button type="submit" class="btn">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>


</body>

</html>
