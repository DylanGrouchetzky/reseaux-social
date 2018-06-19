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
				<li><a href="index.php?action=acceuil&id=<?= $profilvisiteur['id'] ?>">Acceuil</a></li>
				<li><a href="index.php?action=profil&id=<?= $profilvisiteur['id'] ?>">Profil</a></li>
				<li><a href="index.php?action=image&id=<?= $profilvisiteur['id'] ?>">Image</a></li>
				<li><a href="index.php?action=deconnexion">Déconnexion</a></li>
			</ul>
		</nav>
	</header>
	<h1>Vous êtes sur le profil de <?= $userinfo['name']; ?></h1>
	<section>
		<div class="profil">
			<h1>Profil de <?= $userinfo['name']; ?></h1>
			<a href="public/image/<?= $userinfo['picture'] ?>"><img src="public/image/<?= $userinfo['picture'] ?>" class="pictureprofil"></a>
			<p>
				<?= $userinfo['age']; ?><br>
				<?php if(isset($anniversary) ){
					echo $anniversary;
				} 
				?>
				<br>
				<?= $userinfo['passion'];?>
				<br>
				<a href="index.php?action=visitegalerie&name=<?= $userinfo['name']; ?>&id=<?= $profilvisiteur['id'] ?>">Sa galerie d'Image</a>
			</p>
		</div>
		<div class="topicality">
			<table cellspacing="5">
				<tr>
					<td><img src="public/image/<?= $profilvisiteur['picture'] ?>" class="picturetopicality"></td>
					<td>
						<form method="POST" action="index.php?action=visited&name=<?= $userinfo['name'] ?>&id=<?= $profilvisiteur['id']; ?>">
							<label for="messagetopicality">Tapez votre message: </label><br>
							<textarea name="messagetopicality" id="messagetopicality"></textarea>
							<input type="submit" name="topicality" value="Envoyer">
						</form>
					</td>
				</tr>
				<tr class="none">
					<td></td>
				</tr>
				<?php
				while($data = $reqtopicality->fetch()){
					?>
					<tr>
						<td>
							<img src="public/image/<?= $data['picture']; ?>" class="picturetopicality">
						</td>
						<td>
							<p class="title">
								<?= $data['name'] ?> à <?= $data['heure']; ?> le <?= $data['Jour']; ?> à publié :
							</p> 
							<p class="message">
								<?= $data['message'] ?>
							</p>
						</td>
					</tr>
					<tr class="none">
						<td></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</section>
</body>
</html>