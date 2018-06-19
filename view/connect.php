<!DOCTYPE html>
<html>
<head>
	<title>Réseaux social</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body class="center">
	<h3>Connection</h3>
	<form method="POST" action="index.php">
		<table align="center" id="connect">
			<tr>
				<td align="right">
					<label for="mailconnect">Mail: </label>
				</td>
				<td>
					<input type="mail" name="mailconnect" id="mailconnect" placeholder="votre mail">
				</td>
			</tr>
			<tr>
				<td align="right">
					<label for="passwordconnect">Mot de passe: </label>
				</td>
				<td>
					<input type="password" name="passwordconnect" id="passwordconnect" placeholder="votre mot de passe">
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td><a href="index.php?action=inscription">Créé un compte</a></td>
				<td><input type="submit" name="connexion" value="Se connecter !"></td>
			</tr>
		</table>
		<?php
		if(isset($erreur)){
			echo '<font color="red">'.$erreur.'</font>';
		}
		?>
	</form>
</body>
</html>