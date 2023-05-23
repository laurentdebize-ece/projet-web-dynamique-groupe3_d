<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail d'une matière</title>
    <!--<link rel="stylesheet" href="../etudiant/style.css">-->
    <link rel="stylesheet" href="adminStyle.css">
</head>
    <?php
    
    $idpromo = $_GET['id'];

    $json_idpromo = json_encode($idpromo);
    
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#supprimerClasse").click(function () {
            var id_classe = $('input[name="selecRad"]:checked').val();
                $.ajax({
                    url: 'supprimerClasseAdmin.php',
                    type: 'POST',
                    data: {
                        id_classe: id_classe
                    },
                    success: function (data) {
                        location.reload();
                    }
                });
        });

        $("#ajouterClasse").click(function () {
            var id_classe = $('#newClasse').val();
            var id_promo = <?php echo $json_idpromo;?>;
            
            $.ajax({
                    url: 'traitementAdminClasse.php',
                    type: 'POST',
                    data: {
                        id_classe: id_classe,
                        id_promo: id_promo
                    },
                    success: function (data) {
                        
                        location.reload();
                    }
                });
            
        });
    });
</script>
<body>


    <?php
    
    $idpromo = $_GET['id'];
    echo 
    "<script>
        var id_promo = ".$idpromo.";
    </script>";
    if (isset($_GET['id'])) {
        $idpromo = $_GET['id'];
    } else {
    }
    

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=omnes_skills; charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    
    $tabPromo = $bdd->query('SELECT * FROM promotion');
    while ($promotion = $tabPromo->fetch()) {
        if ($promotion['ID'] == $idpromo) {
            $ID = $promotion['ID'];
            $tabClasse = $bdd->query('SELECT * FROM classe JOIN promotion ON classe.IdPromotion = promotion.ID WHERE classe.IdPromotion = '.$ID);
    ?>
            <section>
                <h1 id='id_promo' name='<?php echo $promotion['ID'];?>'><?php echo ucfirst($promotion['anneeDePromo']); ?></h1>
                <div class="casier">
                    <?php
                    while ($classe = $tabClasse->fetch()) {
                    ?>
                        <a href="maClasse.php?IdClasse=<?php echo $classe['IdClasse']; ?>">
                            <div class="casier-container" id="<?php echo $classe['classeNum']; ?>" name="<?php echo $classe['classeNum']; ?>">
                                <div class="casier-titre">
                                    <div class="casier-container-img">
                                        <?php
                                        
                                            echo '<img src="../etudiant/images/default.jpg">';
                                        
                                        ?>
                                    </div>
                                    <?php
                                    $classeNum = ucfirst($classe['classeNum']);
                                    echo $classeNum;
                                    ?>
                                </div>
                            </div>
                        </a>
                    <?php

                    }
                    ?>

            </section>
    <?php
        }
    };


    ?>

<button class="open-button" onclick="openForm()">+</button>

<div class="form-popup" id="myForm">  <!-- ADD une classe a la promotion -->
    <form method="post" class="form-container" >
        <h3>Création d'une nouvelle classe :  </h3>

        <label for="newClasse"><b> Numero De Classe : <br></label>
        <input type="text" placeholder="Entrez le numéro" id="newClasse" name="newClasse" required>

        <button type="submit" class="btn" id="ajouterClasse" >Enregistrer</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>  <!-- FIN ADD une classe -->

<div> <!-- bouton supprimer -->

    <button type="button" class="btndelete" onclick="document.getElementById('id01').style.display='block'">Supprimer</button>



    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
        <form class="modal-content" action="supprimerClasseAdmin.php" method="post">
            <div class="container">
                <h1 value="<?php echo $promotion['ID']?>" name="idPromo">Quelle classe souhaitez vous supprimer ? </h1>

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


                    $reponse = $bdd->query('SELECT * FROM classe JOIN promotion
                    ON classe.IdPromotion = promotion.ID WHERE promotion.ID ='.$ID);
                    while ($donnees = $reponse->fetch()) {

                ?>

                        <br>
                        <input type="radio" id="<?php echo $donnees['IdClasse']; ?>" name='selecRad' value="<?php echo $donnees['IdClasse']; ?>">
                        <?php echo $donnees['classeNum']; ?>
                        
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
                    <button type="submit" onclick="document.getElementById('id01').style.display='none'" class="deletebtn" id ="supprimerClasse" >Supprimer</button>
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

        
    </section>
</body>

</html>