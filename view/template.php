<!DOCTYPE html>
<html>
	<head>
		<title>Réseaux Social</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
	</head>
	<body>
		<header>
			<nav>
				<ul>
					<li><a href="index.php">Acceuil</a></li>
					<li><a href="index.php?action=profil">Profil</a></li>
					<li><a href="index.php?action=image&id=<?= $userinfo['id'] ?>">Image</a></li>
					<li><a href="index.php?action=deconnexion">Déconnexion</a></li>
				</ul>
			</nav>
		</header>
		<?= $home ?>
	</body>
</html>