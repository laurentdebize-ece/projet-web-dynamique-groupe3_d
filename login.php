<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
	<title>Login Form</title>
<link rel="stylesheet" href="styleLogin.css">
</head>

<body>

	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form method="post" action="connexion.php">
				<h1>Identifies-toi ! </h1>
				<br>
				<input type="email" placeholder="prenom.nom@omnes.fr" name="ID">
				<input type="password" placeholder="Mot de passe" name="MdP">
				<button type="submit" value="connexion">Connexion</button>
			<!-- </form> -->
		</div>
		<div class="form-container sign-in-container">
			<!-- <form method="post" action="connexion.php"> -->
				<h1>Qui-es-tu ? </h1>
				<br>
				<p id=select>
					Selection du role : <br>
					<div><input type="radio" name="role" value="1">
					<label for="ALL">Etudiant</label><br></div>
					<input type="radio" name="role" value="2">
					<label for="ASC">Professeur</label><br>
					<input type="radio" name="role" value="3">
					<label for="DESC">Admin</label>
				</p>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Oups ! </h1>
					<p>Tu t'es trompé ? Pas de pannique ! </p>
					<button class="ghost" id="signIn">Retour</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Connecte - toi ! </h1>
					<button class="ghost" id="signUp">Connexion</button>
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