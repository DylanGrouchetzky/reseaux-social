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
	<h1>Modifier les paramétres du compte</h1>
	<section>
		<form style="text-align: center;" method="POST" action="index.php?action=parametre&id=<?= $userinfo['id'] ?>">
			<table style="text-align: center;">
				<tr>
					<td><label for="background">Changer la couleur de fond: </label></td>
					<td><input type="color" name="background" id="background" value="<?= $infoparametre['background'] ?>"></td>
				</tr>
				<tr>
					<td><label for="backgroundheader">Changer la couleur de fond du menu: </label></td>
					<td><input type="color" name="backgroundheader" id="backgroundheader" value="<?= $infoparametre['backgroundheader'] ?>"></td>
				</tr>
				<tr>
					<td><label for="backgroundbouton">Changer la couleur de fond du bouton du menu: </label></td>
					<td><input type="color" name="backgroundbouton" id="backgroundbouton" value="<?= $infoparametre['backgroundbouton'] ?>"></td>
				</tr>
				<tr>
					<td><label for="colorbouton">Changer la couleur d'écriture du bouton du menu: </label></td>
					<td><input type="color" name="colorbouton" id="colorbouton" value="<?= $infoparametre['colorbouton'] ?>"></td>
				</tr>
				<tr>
					<td><label for="backgroundboutonhover">Changer la couleur de fond du bouton du menu au passage de la souris: </label></td>
					<td><input type="color" name="backgroundboutonhover" id="backgroundboutonhover" value="<?= $infoparametre['backgroundboutonhover'] ?>"></td>
				</tr>
				<tr>
					<td><label for="colorboutonhover">Changer la couleur d'écriture du bouton du menu au passage de la souris: </label></td>
					<td><input type="color" name="colorboutonhover" id="colorboutonhover" value="<?= $infoparametre['colorboutonhover'] ?>"></td>
				</tr>
				<tr>
					<td><label for="backgroundprofil">Changer la couleur de fond du profil: </label></td>
					<td><input type="color" name="backgroundprofil" id="backgroundprofil" value="<?= $infoparametre['backgroundprofil'] ?>"></td>
				</tr>
				<tr>
					<td><label for="colorlien">Changer la couleur du lien: </label></td>
					<td><input type="color" name="colorlien" id="colorlien" value="<?= $infoparametre['colorlien'] ?>"></td>
				</tr>
				<tr>
					<td><label for="colordecorationlien">Changer la couleur du soulignement des liens: </label></td>
					<td><input type="color" name="colordecorationlien" id="colordecorationlien" value="<?= $infoparametre['colordecorationlien'] ?>"></td>
				</tr>
				<tr>
					<td><label for="backgroundboutonform">Changer la couleur de fond des boutons: </label></td>
					<td><input type="color" name="backgroundboutonform" id="backgroundboutonform" value="<?= $infoparametre['backgroundboutonform'] ?>"></td>
				</tr>
				<tr>
					<td><label for="colorboutonform">Changer la couleur d'écriture des boutons: </label></td>
					<td><input type="color" name="colorboutonform" id="colorboutonform" value="<?= $infoparametre['colorboutonform'] ?>"></td>
				</tr>
				<tr>
					<td><label for="backgroundboutonformhover">Changer la couleur de fond des bouton au passage de la souris: </label></td>
					<td><input type="color" name="backgroundboutonformhover" id="backgroundboutonformhover" value="<?= $infoparametre['backgroundboutonformhover'] ?>"></td>
				</tr>
				<tr>
					<td><label for="colorboutonformhover">Changer l'écriture des boutons au passage de la souris: </label></td>
					<td><input type="color" name="colorboutonformhover" id="colorboutonformhover" value="<?= $infoparametre['colorboutonformhover'] ?>"></td>
				</tr>
			</table>
			<input type="submit" value="Enregistrer les modifications" name="changeparametre" class="submit">
		</form>
	</section>
	<div style="text-align: center;">
		<h2 style="text-decoration: red underline">Supprimer votre compte</h2>
		<p>Cliquez sur "Supprimer mon compte" pour supprimer votre compte.<br>
		<font color="red" style="text-decoration: red underline;">Attention supprimer son compte implique qu'il n'y aura plus de traces de vous ici !</font></p>
		<form method="POST" action="index.php?action=parametre&id=<?= $userinfo['id'] ?>">
			<input type="hidden" name="name" value="<?= $userinfo['name'] ?>">
			<input type="hidden" name="id" value="<?= $userinfo['id'] ?>">
			<input type="submit" value="Supprimer mon compte" name="delete" class="submit">
		</form>
	</div>
</body>
</html>