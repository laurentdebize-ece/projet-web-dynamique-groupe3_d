<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Mon espace</title>

    <link rel="stylesheet" href="style.css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#new_pwd').hide();
        $('#confirm_new_pwd').hide();
        $('#annuler').hide();
        $('#confirmer').hide();
        $("#modifier").click(function () {
            $('#new_pwd').show();
            $('#confirm_new_pwd').show();
            $('#annuler').show();
            $('#confirmer').show();
            $('#modifier').hide();
            $('#retour').hide();
        });
        $("#annuler").click(function () {
            $('#new_pwd').hide();
            $('#new_pwd').val('');
            $('#confirm_new_pwd').hide();
            $('#confirm_new_pwd').val('');
            $('#annuler').hide();
            $('#confirmer').hide();
            $('#modifier').show();
            $('#retour').show();
        });
        $("#confirmer").click(function () {
            var new_pwd = $('#new_pwd').val();
            var confirm_new_pwd = $('#confirm_new_pwd').val();
            if (new_pwd == confirm_new_pwd && new_pwd != '' && new_pwd != null) {
                $.ajax({
                    url: 'modifier_mdp.php',
                    type: 'POST',
                    data: {
                        new_pwd: new_pwd
                    },
                    success: function (data) {
                        alert("Mot de passe changé avec succès !");
                        location.reload();
                    }
                });
            } else {
                alert("Les mots de passe ne correspondent pas ou sont invalides.");
            }
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
    ?>
    <div class="casier-compte">
        <h1>Mon compte</h1>
        
        <p>Nom: <?php echo str_replace('_', ' ',$_SESSION['nom']) ?></p>
        <p>Prenom : <?php echo $_SESSION['prenom'] ?></p>
        <p>Mon identifiant : <?php echo $_SESSION['mail'] ?></p>
        <p>Mon mot de passe: <?php echo $_SESSION['mdp'] ?></p>
        
        <div class="casier-compte-place-buttons">
            <button id="modifier">Modifier</button>
            <input type="password" id="new_pwd" placeholder="Nouveau mot de passe">
            <input type="password" id="confirm_new_pwd"placeholder="Confirmez">
            <button id="retour"><a href="etudiant.php">Retour</a></button>
            <button id="annuler">Annuler</button>
            <button id="confirmer"> Confirmer </button>
        </div>
        
            
    </div>


</body>

</html>