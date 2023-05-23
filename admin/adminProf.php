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
    <title>AdminProf</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


<script>
    

    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }



    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>



<body>
<div class="header">
        <button id="retour"><a href="../admin.php">Retour</a></button>
        <h1>Les Professeurs </h1>
    </div>
    <h2>Voici les professeurs de l'établissement : </h2>
    <!--trier par promo ou par matiere BOUTON RADIO -->

    <div>
        <form method="post">

            <input type="radio" id="1" name="choix" value="1">
            <label for="1">afficher par ordre alphabétique </label><br>

            <input type="radio" id="2" name="choix" value="2">
            <label for="2">afficher par matières</label><br>

            <input type="submit" value="Valider">

        </form>
    </div>

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
        die('ERREUR : ' . $e->getMessage());
    }
    if (isset($_POST['choix'])) {
        $choix = $_POST['choix'];

        switch ($choix) {
            case 1:
                $reponse = $bdd->query('SELECT * FROM professeurs ORDER BY nomProf ASC');
                while ($donnees = $reponse->fetch()) {

    ?>
                    <br>
                    <button class="prof" type="button" onclick="openProf()" id="monProf">
                        <!--ouvre la page qui accede aux classes de la promo-->

                        <?php echo $donnees['nomProf']; ?>
                        <?php echo $donnees['prenomProf']; ?>
                    </button>
                    <br>
                <?php
                }
                break;
            case 2:
                $reponse = $bdd->query('SELECT professeurs.nomProf, professeurs.prenomProf, matieres.nomMat FROM professeurs JOIN 
                enseignerclassmatprof  ON professeurs.IdProf = enseignerclassmatprof.IdProf 
                JOIN matieres ON matieres.idMat = enseignerclassmatprof.IdMat ORDER BY matieres.nomMat ASC');




                while ($donnees = $reponse->fetch()) {

                ?>
                
                    <h3>
                        <?php echo $donnees['nomMat']; ?>
                    </h3>
                    <br>


                    <button class="prof" type="button" onclick="openProf()" id="monProf">
                        <!--ouvre la page qui accede aux classes de la promo-->

                        <?php echo $donnees['nomProf']; ?>
                        <?php echo $donnees['prenomProf']; ?>

                       <!-- <a href="detailProfAdmin.php?nomProf=<?php echo $donnees['nomProf'];?>"> -->

                    </button>
                    <br>
            <?php
                }
                break;
        }
        while ($donnees = $reponse->fetch()) {

            ?>
            <p>
                Nom : <?php echo $donnees['nomProf']; ?>,<br>
                Prenom : <?php echo $donnees['prenomProf']; ?>,<br>

            </p>
    <?php
        }
        $reponse->closeCursor();
    }
    ?>



    <div> <!-- bouton supprimer -->

        <button type="button" class="btndelete" onclick="document.getElementById('id01').style.display='block'">Supprimer</button>



        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
            <form class="modal-content" action="supprimerProfAdmin.php" method="post">
                <div class="container">
                    <h1>Qui souhaitez vous supprimer ? </h1>

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
                            <input type="radio" id="<?php echo $donnees['IdProf']; ?>" name='selecRad' value="<?php echo $donnees['IdProf']; ?>">
                            <?php echo $donnees['nomProf']; ?>
                            <?php echo $donnees['prenomProf']; ?>
                            </input>
                            <br>


                    <?php

                        }
                    } else {
                        echo "erreur d'accès à la bdd";
                    }
                    $reponse->closeCursor();

                    ?>


                    <div class="clearfix">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Annuler</button>
                        <button type="submit" onclick="document.getElementById('id01').style.display='none'" class="deletebtn">Supprimer</button>
                    </div>
                </div>
            </form>
        </div>



    </div> <!-- FIN bouton supprimer -->


    <button class="open-button" onclick="openForm()">+</button>


    <div class="form-popup" id="myForm"> <!-- formulaire création d'un enseignant -->
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


            <button type="submit" class="btn">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div><!-- FIN formulaire création d'un enseignant -->

</body>

</html>