<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Accueil</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <section id="section1">
            <div class="section1_partition1">
                <div class="partition1_head">
                    <div class="img_container">
                        <div class="img"> </div>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="accueil.html">Accueil</a></li>
                            <li><a href="competences.html">Mes compétences</a></li>
                            <li><a href="transverses.html">Compétences transverses</a></li>
                            <li><a href="eval.html">S'auto-évaluer</a></li>
                        </ul>
                    </nav>
                </div>
                <h1 class=" welcom_mess">Omnes Skills</h1>
            </div>
            <div class="section1_partition2">
                <div class="carte-container">
                    <div class="carte carte1">

                        <div class="carte_img carte_img1">

                            <h3>Mes compétences</h3>

                        </div>

                    </div>
                    <div class="carte carte2">

                        <div class="carte_img carte_img2">
                            <h3>S'auto-évaluer</h3>

                        </div>

                    </div>
                    <div class="carte carte3">

                        <div class="carte_img carte_img3">

                            <h3>Compétences Transverses</h3>

                        </div>
                    </div>
                    <div class="carte carte4">

                        <div class="carte_img carte_img4">

                            <h3>Mon espace</h3>

                        </div>

                    </div>

                </div>
            </div>
            <div class="section1_partition3">
            <form method="post" action="connexion.php">
                <p id=select>
                    Selection du role :<br>
                    <input type="radio" name="selct" value="1">
                    <label for="ALL">Etudiant</label><br>
                    <input type="radio" name="selct" value="2">
                    <label for="ASC">Professeur</label><br>
                    <input type="radio" name="selct" value="3">
                    <label for="DESC">Admin</label><br>
                </p>
                    <p>Texte à l'intérieur du formulaire</p>
                    <label for="ID">ID:</label>
                    <input type="text" name="ID" id="ID"><br>
                    <label for="MdP">MdP:</label>
                    <input type="text" name="MdP" id="MdP"><br>
                    <input type="submit" value="Valider">
            </form>
            </div>


        </section>
    </header>
</body>

</html>