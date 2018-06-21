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
	<h1>Vous êtes sur la bibliothéque d'image de <?= $viewid['name'] ?></h1>
	<section>
		<?php

		while($data = $pictureview->fetch()){
			if($data['pourqui'] == 'public'){
			?>
			<div class="galerie">
				<a href="public/image/<?= $data['picture'] ?>"><img src="public/image/<?= $data['picture'] ?>"></a>
			</div>
			<?php
			}
		}
		?>
	</section>
</body>
</html>