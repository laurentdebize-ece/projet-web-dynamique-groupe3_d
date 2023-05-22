<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
    <title>navigation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylenavProf.css">
    <title>addEval</title>
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

    <h1>Ajouter une Evaluation</h1>

    <div class="container" id="formulaire">
        <form action="addEvalProf.php" method="post" id=form>
            <div class=dataform id=NumProm>
                <label for="Promo" class=labelEval>Promo :</label><br>
                <input type='text' id="promo" name='promo'><br>
            </div>
            <div class=dataform id=NumClasse>
                <label for="classe" class=labelEval>Classe :</label><br>
                <input type='text' id="classe" name='classe'><br>
            </div>
            <div class=dataform id=NumDate>
                <label for="Date" class=labelEval>Date :</label><br>
                <input type='date' id="date" name='date'><br>
            </div>
            <div class=dataform id=AddComp>
                <label for="Comp" class=labelEval>Nom de la Compétence :</label><br>
                <input type='text' id="NomComp" name='NomComp'>
                <button id=BouttonAddComp>+</button>
            </div>
            <div class=dataform id=divEnvoyer>
            <input type='submit' id="Envoyer" value=Envoyer>
            </div>
        </form>
    </div>

    <script>
        function retour(){
            location.href = 'prof.php';
        }
    </script>

    <button id=Retour onclick=retour()>RETOUR</button>

</body>

</html>