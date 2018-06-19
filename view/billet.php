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
	<h1>Vous êtes sur l'acceuil</h1>
	<section>
		<div class="profil">
			<h1>Profil de <?= $userinfo['name']; ?></h1>
			<img src="public/image/<?= $userinfo['picture'] ?>" class="pictureprofil">
			<p>
				<?= $userinfo['age']; ?><br>
				<?php if(isset($anniversary) ){
					echo $anniversary;
				} 
				?>
				<br>
				<?= $userinfo['passion'];?>
			</p>
		</div>
		<div class="topicality">
			<table cellspacing="5">
				<tr>
					<td><img src="public/image/<?= $infobillet['picture'] ?>" class="picturetopicality"></td>
					<td>
						<p class="title">
							<a href="index.php?action=visited&name=<?= $infobillet['name'] ?>&id=<?= $userinfo['id'] ?>" class="pseudo"><?= $infobillet['name'] ?></a>à <?= $infobillet['heure']; ?> le <?= $infobillet['Jour']; ?> à publié :</a>
						</p>
						<p class="message">
							<?= $infobillet['message'] ?>
						</p>
					</td>
				</tr>
				<tr class="none">
					<td></td>
				</tr>
				<?php

				while($data = $comment->fetch()){
					?>
					<tr>
						<td><img src="public/image/<?= $data['picture'] ?>" class="picturetopicality"></td>
						<td>
							<p class="title">
								<a href="index.php?action=visited&name=<?= $data['name'] ?>&id=<?= $userinfo['id'] ?>" class="pseudo"><?= $data['name'] ?></a>à <?= $data['heure']; ?> le <?= $data['Jour']; ?> à publié :</a>
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
				<tr>
					<td><img src="public/image/<?= $userinfo['picture'] ?>" class="picturetopicality"></td>
					<td>
						<form method="POST" action="index.php?action=billet&idbillet=<?= $infobillet['id'] ?>&id=<?= $userinfo['id'] ?>">
							<label for="comment">Tapez votre message: </label><br>
							<textarea name="comment" id="comment"></textarea>
							<input type="hidden" name="idtopicality" value="<?= $infobillet['id'] ?>">
							<input type="submit" name="newcomment" value="Envoyer">
						</form>
						<?php if(isset($erreur)){ 
							?>
							<span style="color: red;"><?= $erreur ?></span>
						<?php 
						} ?>
					</td>
				</tr>
			</table>
		</div>
	</section>
</body>
</html>