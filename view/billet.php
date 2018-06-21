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
	<h1>Vous regarder les commentaires</h1>
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
							<?php

							if($data['name'] == $userinfo['name']){
								?>
								<form method="POST" action="index.php?action=billet&idbillet=<?= $idbillet ?>&id=<?= $userinfo['id'] ?>">
									<input type="hidden" name="idcomment" value="<?= $data['id'] ?>">
									<input type="submit" value="Supprimer commentaire" name="deletecomment" class="submit">
								</form>
								<?php
							}

							?>
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
							<input type="submit" name="newcomment" value="Envoyer" class="submit">
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