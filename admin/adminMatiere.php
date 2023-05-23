<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--icone du site-->
    <link rel="icon" href="image/mathcat.ico" type="image/x-icon">
    <!--lien vers la page css-->
    <link href="adminStyle.css" rel="stylesheet" type="text/css" />
    <title>AdminMatieres</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


<script>
    var creaProf = document.getElementById("myForm");


    window.onclick = function(event) {
        if (event.target == creaProf) {
            creaProf.style.display = "none";
        }
    }


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
    <h1>Admin Matieres </h1>
    <h2>Voici les matières proposées par l'établissement : </h2>
    <!--trier par promo ou par matiere BOUTON RADIO -->

    <div>
        <form method="post">

            <input type="radio" id="1" name="choix" value="1">
            <label for="1">afficher par ordre alphabétique </label><br>

            <input type="radio" id="2" name="choix" value="2">
            <label for="2">afficher par promotion </label><br>

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
                $reponse = $bdd->query('SELECT * FROM matieres ORDER BY nomMat ASC');
                while ($donnees = $reponse->fetch()) {

    ?>
                    <br>
                    <button class="prof" type="button" onclick="openMat()" id="maMatiere">
                        <!--ouvre la page qui accede aux classes de la promo-->

                        <?php echo $donnees['nomMat']; ?>
                        
                    </button>
                    <br>
                <?php
                }
                break;
            case 2:
                $reponse = $bdd->query('SELECT matieres.nomMat, promotion.anneeDePromo FROM enseignerclassmatprof 
                JOIN matieres ON matieres.idMat = enseignerclassmatprof.IdMat JOIN classe ON classe.IdClasse = enseignerclassmatprof.IdClasse 
                JOIN promotion ON promotion.ID = classe.IdPromotion ORDER BY promotion.anneeDePromo ASC');




                while ($donnees = $reponse->fetch()) {

                ?>
                
                    <h3>
                        <?php echo $donnees['anneeDePromo']; ?>
                    </h3>
                    <br>


                    <button class="prof" type="button" onclick="openMat()" id="maMatiere">
                        <!--ouvre la page qui accede aux classes de la promo-->

                        <?php echo $donnees['nomMat']; ?>

                    
                    </button>
                    <br>
            <?php
                }
                break;
        }
        while ($donnees = $reponse->fetch()) {

            ?>
            <p>
            <?php echo $donnees['nomMat']; ?>

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
            <form class="modal-content" action="supprimerMatiereAdmin.php" method="post">
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


                        $reponse = $bdd->query('SELECT * FROM matieres');
                        while ($donnees = $reponse->fetch()) {

                    ?>

                            <br>
                            <input type="radio" id="<?php echo $donnees['idMat']; ?>" name='selecRad' value="<?php echo $donnees['idMat']; ?>">
                            <?php echo $donnees['nomMat']; ?>
                           
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
        <form action="traitementAdminMat.php" method="post" class="form-container">
            <h3>Création d'une nouvelle matière </h3>

            <label for="newNomMat"><b> Nom : </b></label>
            <input type="text" placeholder="Entrez le nom" id="newNomMat" name="newNomMat" pattern="[A-Za-z]{*}" required>

            <label for="newVolumeHoraire"><b> Volume Horaire: </b></label>
            <input type="number" placeholder="Entrez le volume hoaraire" id="newVolumeHoraire" name="newVolumeHoraire" required>
<br>
<br>
            
            <button type="submit" class="btn">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Fermer</button>
        </form>
    </div><!-- FIN formulaire création d'un enseignant -->

</body>

</html>