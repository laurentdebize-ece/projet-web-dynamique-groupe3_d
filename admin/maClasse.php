<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma classe </title>
    <link rel="stylesheet" href="adminStyle.css">
</head>

<?php
//je recupere l id de la classe dans laquelle je suis
$idclasse = $_GET['IdClasse'];
$json_idclasse = json_encode($idclasse);


?>
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

    $(document).ready(function() {
        $("#supprimerEleve").click(function() {
            var id_classe = $('input[name="selecRad"]:checked').val();
            $.ajax({
                url: 'supprimerEleveAdmin.php',
                type: 'POST',
                data: {
                    id_eleve: id_eleve
                },
                success: function(data) {
                    location.reload();
                }
            });
        });

        $("#ajouterEleve").click(function() {
            var id_nomEtu = $('#newNomEtu').val();
            var id_prenomEtu = $('#newPrenomEtu').val();
            var id_mailEtu = $('#newMailEtu').val();
            var id_mdpEtu = $('#newMdp').val();
            var id_classe = <?php echo $json_idclasse; ?>;

            $.ajax({
                url: 'ajouterEleveAdmin.php',
                type: 'POST',
                data: {
                    id_nomEtu: id_nomEtu,
                    id_prenomEtu: id_prenomEtu,
                    id_mailEtu: id_mailEtu,
                    id_mdpEtu: id_mdpEtu,
                    id_classe: id_classe,
                },
                success: function(data) {

                    location.reload();
                }
            });

        });
    });
</script>

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
    }

    //je recupere l id de la classe dans laquelle je suis
    $idclasse = $_GET['IdClasse'];
    $json_idclasse = json_encode($idclasse);

    $classe = $bdd->query('SELECT * FROM classe WHERE classe.IdClasse =' . $idclasse);
    $tabEleve = $bdd->query('SELECT * FROM etudiant');
    ?>

    <section>

        <h3><?php echo $idclasse; ?></h3>


        <?php
        while ($etudiant = $tabEleve->fetch()) {

            if ($etudiant['IdClasse'] == $idclasse) {
                $tabEtu = $bdd->query('SELECT * FROM classe JOIN etudiant ON classe.IdClasse = etudiant.IdClasse WHERE classe.IdClasse = ' . $idclasse);
        ?>



                <div class="casier">
                    <?php
                    while ($classe = $tabEtu->fetch()) {
                    ?>
                        <div class="casier-container" id="<?php echo $etudiant['nomEtu']; ?>" name="<?php echo $etudiant['nomEtu']; ?>">
                            <div class="casier-titre">
                                <div class="casier-container-img">
                                    <?php

                                    echo '<img src="../etudiant/images/default.jpg">';

                                    ?>
                                </div>
                                <?php
                                echo $etudiant['prenomEtu'];
                                echo $etudiant['nomEtu'];
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

<!-- ADD un eleve a la promotion -->
<div class="form-popup" id="myForm">
    <form method="post" class="form-container">
        <h3>Création d'un nouvel élève : </h3>

        <label for="newEleve"><b> Nom : </b></label>
        <input type="text" placeholder="Entrez le nom" id="newNomEtu" name="newNomEtu" pattern="[A-Za-z]{*}" required>

        <label for="newEleve"><b> Prénom : </b></label>
        <input type="text" placeholder="Entrez le prénom" id="newPrenomEtu" name="newPrenomEtu" pattern="[A-Za-z]{*}" required>

        <label for="newEleve"><b> Adresse mail : </b></label>
        <input type="mail" placeholder="Créez l'adresse mail" id="newMailEtu" name="newMailEtu" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
        <br> <br>

        <label for="newEleve"><b> Mot de passe : </b></label>
        <input type="text" placeholder="Créez le mot de passe" id="newMdp" name="newMdp" pattern="[A-Za-z]{*}" required>

        <button type="submit" class="btn" id="ajouterEleve">Enregistrer</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>

</div> <!-- FIN ADD un eleve -->

<div> <!-- bouton supprimer -->

    <button type="button" class="btndelete" onclick="document.getElementById('id01').style.display='block'">Supprimer</button>



    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
        <form class="modal-content" action="supprimerEleveAdmin.php" method="post">
            <div class="container">
                <h1 value="<?php echo $etudiant['IdEtudiant'] ?>" name="idEtu">Quel eleve souhaitez vous supprimer ? </h1>

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

                    $reponse = $bdd->query('SELECT * FROM classe JOIN etudiant
                    ON classe.IdClasse = etudiant.IdClasse WHERE classe.IdClasse =' . $idclasse);
                    while ($donnees = $reponse->fetch()) {

                ?>
                        <br>
                        <input type="radio" id="<?php echo $donnees['IdEtudiant']; ?>" name='selecRad' value="<?php echo $donnees['IdEtudiant']; ?>">
                        <?php echo $donnees['nomEtu']; ?>
                        <?php echo $donnees['prenomEtu']; ?>

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
                    <button type="submit" onclick="document.getElementById('id01').style.display='none'" class="deletebtn" id="supprimerEleve">Supprimer</button>
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