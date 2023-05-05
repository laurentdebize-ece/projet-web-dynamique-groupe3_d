<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
	<title>Login Form</title>
	
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">-->
</head>

<body>

<?php
if(isset($_GET['error']) && $_GET['error'] ==1){
    echo "<p>Mauvais login ou mot de passe</p>";
}

?>
	
	<p>&nbsp;</p>
    <div class="container" id="container">
	  <div class="form-container sign-up-container">
		<form action="connexion.php" method="post">
            <h1>Administrateur ?</h1>
            <!--<div class="social-container">
                <a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
            </div>
            <span> or use your email for registration</span>-->
            <br>
            <input type="email" placeholder="prenom.nom@omnes.fr" name="ID">
            <input type="password" placeholder="Mot de passe" name="MdP">
            <button type="submit" value="connexion">Connexion</button>
		</form>
	  </div>
	  <div class="form-container sign-in-container">
		<form action="connexion.php" method="post">
		  <h1>Étudiant ? </h1>
		 <!--<div class="social-container">
			<a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
			<a href="#" class="social"><i class="fa fa-google-plus"></i></a>
			<a href="#" class="social"><i class="fa fa-linkedin"></i></a>
		  </div>
		  <span>or use your account</span>-->
          <br>
         <input type="email" name="ID" id="ID" placeholder="nom.prenom@omnes.fr">
		  <input type="password" placeholder="Mot de passe" name="MdP">
		  <a href="#" class="forgot-password">Mot de passe oublié ?</a>
		  <button type="submit" value="Connexion">Connexion</button>
		</form>
	  </div>
	  <div class="overlay-container">
		<div class="overlay">
		  <div class="overlay-panel overlay-left">
			<h1>Welcome Back !</h1>
			<p>Tu as déja un compte ? Connecte-toi directement ! </p>
			<button class="ghost" id="signIn">S'identifier</button>
		  </div>
		  <div class="overlay-panel overlay-right">
			<h1>Hello, Friend!</h1>
			<p>Créer ton compte et commence ton voyage avec nous !</p>
			<button class="ghost" id="signUp">S'inscrire</button>
		  </div>
		</div>
	  </div>
	</div>

	<script id="rendered-js">
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');

		signUpButton.addEventListener('click', () => container.classList.add('right-panel-active'));

		signInButton.addEventListener('click', () => container.classList.remove('right-panel-active'));
    </script>

</body>
</html>