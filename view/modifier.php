<!DOCTYPE html>
<html>
<head>
	<style>
		body{
			background: <?= $infoparametre['background'] ?> !important;
		}
		header{
			background: <?= $infoparametre['backgroundheader'] ?> !important;
		}
		header a{
			background: <?= $infoparametre['backgroundbouton'] ?> !important;
			color: <?= $infoparametre['colorbouton'] ?> !important;
		}
		header a:hover{
			background: <?= $infoparametre['backgroundboutonhover'] ?> !important;
			color: <?= $infoparametre['colorboutonhover'] ?> !important;
		}
		.profil{
			background: <?= $infoparametre['backgroundprofil'] ?> !important;
		}
		form .submit{
			background: <?= $infoparametre['backgroundboutonform'] ?> !important;
			color: <?= $infoparametre['colorboutonform'] ?> !important;
		}
		form .submit:hover{
			background: <?= $infoparametre['backgroundboutonformhover'] ?> !important;
			color: <?= $infoparametre['colorboutonformhover'] ?> !important;
		}
	</style>
	<title>Profil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="index.php?action=acceuil&id=<?= $userinfo['id'] ?>">Acceuil</a></li>
				<li><a href="index.php?action=profil&id=<?= $userinfo['id'] ?>">Profil</a></li>
				<li><a href="index.php?action=image&id=<?= $userinfo['id'] ?>">Image</a></li>
				<li><a href="index.php?action=parametre&id=<?= $userinfo['id'] ?>">Paramétre</a></li>
				<li><a href="index.php?action=deconnexion">Déconnexion</a></li>
			</ul>
		</nav>
	</header>

	<section id="modifier">
		<h1 style="text-decoration: red underline;">Modifier votre profil</h1>
		<form method="POST" action="index.php?action=modifier&id=<?= $userinfo['id'] ?>">
			<table align="center" style="border: 3px red solid; padding: 3px;">
				<tr>
					<td><label for="pseudo">Votre pseudo: </label></td>
					<td><input type="text" name="pseudo" id="pseudo" value="<?= $userinfo['name'] ?>"></td>
				</tr>
				<tr>
					<td><label for="picture">Nom de l'image: </label></td>
					<td><input type="text" name="picture" id="picture" value="<?= $userinfo['picture'] ?>"></td>
				</tr>
				<tr>
					<td><label for="anniversary">Votre date d'anniversaire(jour/mois/anné): </label></td>
					<td>
						<input type="number" name="jourani" id="anniversary" style="width: 50px;" max="31" value="<?= $userinfo['jourani'] ?>">
						<input type="number" name="moisani" id="anniversary" style="width: 50px;" max="12" value="<?= $userinfo['moisani'] ?>">
						<input type="number" name="anneani" id="anniversary" style="width: 50px;" min="1900" max="<?= $anne ?>" value="<?= $userinfo['anneani'] ?>">
					</td>
				</tr>
				<tr>
					<td><label for="passion">Votre passion: </label></td>
					<td><input type="text" name="passion" id="passion" value="<?= $userinfo['passion'] ?>"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Modifier" name="modifier" class="submit"></td>
				</tr>
			</table>
		</form>
		
		<p>
			<?php

			if(isset($erreur)){
				echo '<font color="red">'.$erreur.'</font>';
			}

			?>
		</p>
	</section>
</body>
</html>