<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body class="center">
	<h3>Inscription</h3>
	<p id="text">Veuillez remplir les champs suivants: </p>
	<form action="index.php?action=inscription" method="POST">
		<table align="center" id="inscription">
			<tr>
				<td style="text-align: right"><label for="pseudo">Pseudo: </label></td>
				<td><input type="text" name="pseudo" id="pseudo"></td>
			</tr>
			<tr>
				<td style="text-align: right"><label for="mail">Mail: </label></td>
				<td><input type="email" name="mail" id="mail"></td>
			</tr>
			<tr>
				<td style="text-align: right"><label for="mail2">Confirmer votre ail: </label></td>
				<td><input type="email" name="mail2" id="mail2"></td>
			</tr>
			<tr>
				<td style="text-align: right"><label for="mdp">Votre mot de passe: </label></td>
				<td><input type="password" name="mdp" id="mdp"></td>
			</tr>
			<tr>
				<td style="text-align: right"><label for="mdp2">Confirmation du mot de passe: </label></td>
				<td><input type="password" name="mdp2" id="mdp2"></td>
			</tr>
			<tr>
				<td><a href="index.php" class="retour">Retour</a></td>
				<td><input type="submit" name="inscription" value="S'inscrire"></td>
			</tr>
		</table>
		<?php
		if(isset($erreur)){
			echo '<font color="red">'.$erreur.'</font>';
		}elseif (isset($congratulation)){
			echo '<font color="green">'.$congratulation.'</font>';
		}
		?>
	</form>
	<br>
	
</body>
</html>