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
<div class="header">
        <button id="retour"><a href="../admin.php">Retour</a></button>
        <h1>Les promotions & classes</h1>
    </div>
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

    if ($bdd) {


        $reponse = $bdd->query('SELECT * FROM promotion ORDER BY promotion.anneeDePromo ASC');
        while ($donnees = $reponse->fetch()) {

    ?>
            <br>
            <button class="prof" type="button" onclick="openPromo()">
                <!--ouvre la page qui accede aux classes de la promo-->
                
                <a href="detailPromoAdmin.php?id=<?php echo $donnees['ID'];?>">
                <?php echo $donnees['anneeDePromo']; ?></a>

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

    <div class="form-popup" id="myForm">  <!-- ADD une promotion -->
        <form action="traitementAdminPromo.php" method="post" class="form-container">
            <h3>Création d'une nouvelle promotion</h3>

            <label for="newPromo"><b> ANNEE : <br><span class="exempleDate"> exemple "2021" </span></b></label>
            <input type="text" placeholder="Entrez l'année" id="newPromo" name="newPromo" pattern="[0-9]{4}" required>

            <button type="submit" class="btn">Enregistrer</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>  <!-- FIN ADD une promotion -->

    <div> <!-- bouton supprimer -->

        <button type="button" class="btndelete" onclick="document.getElementById('id01').style.display='block'">Supprimer</button>



        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
            <form class="modal-content" action="supprimerPromoAdmin.php" method="post">
                <div class="container">
                    <h1>Quelle promotion souhaitez vous supprimer ? </h1>

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


                        $reponse = $bdd->query('SELECT * FROM promotion');
                        while ($donnees = $reponse->fetch()) {

                    ?>

                            <br>
                            <input type="radio" id="<?php echo $donnees['ID']; ?>" name='selecRad' value="<?php echo $donnees['ID']; ?>">
                            <?php echo $donnees['anneeDePromo']; ?>
                            
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


</body>

</html>