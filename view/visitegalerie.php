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
				<li><a href="index.php?action=acceuil&id=<?= $userinfo['id'] ?>">Acceuil</a></li>
				<li><a href="index.php?action=profil&id=<?= $userinfo['id'] ?>">Profil</a></li>
				<li><a href="index.php?action=image&id=<?= $userinfo['id'] ?>">Image</a></li>
				<li><a href="index.php?action=deconnexion">Déconnexion</a></li>
			</ul>
		</nav>
	</header>
	<h1>Vous êtes sur la bibliothéque d'image de <?= $viewid['name'] ?></h1>
	<section>
		<?php

		while($data = $pictureview->fetch()){
			?>
			<div class="galerie">
				<a href="public/image/<?= $data['picture'] ?>"><img src="public/image/<?= $data['picture'] ?>"></a>
			</div>
			<?php
		}
		?>
	</section>
</body>
</html>