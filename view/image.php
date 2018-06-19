 <!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="index.php?action=acceuil&id=<?= $infoprofil['id'] ?>">Acceuil</a></li>
				<li><a href="index.php?action=profil&id=<?= $infoprofil['id'] ?>">Profil</a></li>
				<li><a href="index.php?action=image&id=<?= $infoprofil['id'] ?>">Image</a></li>
				<li><a href="index.php?action=deconnexion">Déconnexion</a></li>
			</ul>
		</nav>
	</header>
	<h1>Vous êtes sur votre bibliothéque d'image</h1>
	<section>
		<?php

		while($data = $infopicture->fetch()){
			?>
			<div class="galerie">
				<a href="public/image/<?= $data['picture'] ?>"><img src="public/image/<?= $data['picture'] ?>"></a>
				<form method="POST" action="index.php?action=image&id=<?= $infoprofil['id'] ?>">
					<input type="hidden" name="updateprofil" value="<?= $data['picture'] ?>">
					<input type="hidden" name="delete" value="<?= $data['id'] ?>">
					<input type="submit" value="Changer l'image de profil" name="updatepicture"><br>
					<input type="submit" value="Supprimer l'image" name="deletepicture">
				</form>
			</div>
			<?php
		}
		?>
		<form method="POST" action="index.php?action=image&id=<?= $infoprofil['id'] ?>">
			<div class="galerie" style="width: 170px; height: 100px;">
				<label for="newpicture">Nom de l'image: </label>
				<input type="text" name="newpicture" id="newpicture"><br>
				<input type="submit" value="Ajouté" name="ajout">
				<?php if(isset($erreur)){ ?> <p style="color: red"> <?= $erreur ?> </p> <?php } ?>
			</div>
		</form>
	</section>
</body>
</html>