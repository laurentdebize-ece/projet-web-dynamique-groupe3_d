<!DOCTYPE html>
<html lang="fr">

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
    <h1>Admin Prof</h1>
    <h2>Voici les professeurs de l'établissement : </h2>
    <!--A FAIRE :   trier par promo ou par matiere BOUTON RADIO -->
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

    if ($bdd) {


        $reponse = $bdd->query('SELECT * FROM professeurs');
        while ($donnees = $reponse->fetch()) {

    ?>
            <br>
            <button class="promo" type="button" onclick="openPromo()">
                <!--ouvre la page qui accede aux classes de la promo-->

                <?php echo $donnees['nomProf']; ?>
                <?php echo $donnees['prenomProf']; ?>
            </button>
            <br>
    <?php

        }
    } else {
        echo "erreur d'accès à la bdd";
    }
    $reponse->closeCursor();

    ?>

    <button class="open-button" onclick="openForm()">+</button>



    <div class="form-popup" id="myForm">
        <form action="traitementAdminProf.php" method="post" class="form-container">
            <h3>Création d'un nouvel enseignant</h3>

            <label for="newProf"><b> Nom : </b></label>
            <input type="text" placeholder="Entrez le nom" id="newNomProf" name="newNomProf" pattern="[A-Za-z]{*}" required>
           
            <label for="newProf"><b> Prénom : </b></label>
            <input type="text" placeholder="Entrez le prénom" id="newPrenomProf" name="newPrenomProf" pattern="[A-Za-z]{*}" required>
           
            <label for="newProf"><b> Adresse mail : </b></label>
            <input type="mail" placeholder="Créez l'adresse mail" id="newMailProf" name="newMailProf" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
            <br> <br>
            
            <label for="newProf"><b> Mot de passe : </b></label>
            <input type="text" placeholder="Créez le mot de passe" id="newMdp" name="newMdp" pattern="[A-Za-z]{*}" required>

            <fieldset>
                <legend>Choisissez sa ou ses matieres : </legend>

                <?php
                $reponse = $bdd->query('SELECT * FROM matieres');
                while ($donnees = $reponse->fetch()) {
                ?>
                    <div>
                        <input type="checkbox" id="<?php echo $donnees['nomMat']; ?>" name="liste_matiere[]" >
                        <label for="<?php echo $donnees['nomMat']; ?>"><?php echo $donnees['nomMat']; ?></label>
                    </div>
                <?php
                }
                $reponse->closeCursor();
                ?>
            </fieldset>

            <fieldset>
                <legend>Choisissez sa ou ses classes : </legend>


                <?php
                $reponse = $bdd->query('SELECT * FROM classe JOIN promotion ON classe.IdPromotion = promotion.ID ORDER BY promotion.anneeDePromo ASC');
                while ($donnees = $reponse->fetch()) {
                ?>
                    <div>
                        <input type="checkbox" id="'classe.IdPromotion'.'promotion.ID'" name="'classe.IdPromotion'.'promotion.ID'" >
                        <label for="'classe.IdPromotion'.'promotion.ID'">
                            <?php echo 'classe : '.$donnees['classeNum'] ?> 
                            <?php echo 'promo : ' .$donnees['anneeDePromo'] ?>
                        </label>
                    </div>
                <?php

                }
                $reponse->closeCursor();

                ?>
            </fieldset>
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