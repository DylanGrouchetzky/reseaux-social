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
	<h1>Bonjour <?= $userinfo['name'] ?></h1>
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
			</p>
		</div>
		<div class="topicality">
			<table cellspacing="5">
				<tr>
					<td><img src="public/image/<?= $userinfo['picture'] ?>" class="picturetopicality"></td>
					<td>
						<form method="POST" action="index.php?action=acceuil&id=<?= $userinfo['id']; ?>">
							<label for="messagetopicality">Tapez votre message: </label><br>
							<textarea name="messagetopicality" id="messagetopicality"></textarea>
							<input type="submit" name="topicality" value="Envoyer" class="submit">
						</form>
						<?php if(isset($erreur)){ 
							?>
							<span style="color: red;"><?= $erreur ?></span>
						<?php 
						} ?>
					</td>
				</tr>
				<tr class="none">
					<td></td>
				</tr>
				<?php
				while($data = $topicality->fetch()){
					?>
					<tr>
						<td>
							<img src="public/image/<?= $data['picture']; ?>" class="picturetopicality">
							<?php

							if($data['compte'] == $userinfo['id']){
							?>
								<form method="POST" action="index.php?action=acceuil&id=<?= $userinfo['id'] ?>">
									<input type="hidden" name="idbillet" value="<?= $data['id'] ?>">
									<input type="submit" value="Supprimer le billet" name="deletebillet" class="submit">
								</form>
								<?php
							}
							?>
						</td>
						<td>
							<p class="title">
								<a href="index.php?action=visited&name=<?= $data['name'] ?>&id=<?= $userinfo['id'] ?>" class="pseudo"><?= $data['name'] ?></a><a href="index.php?action=billet&idbillet=<?= $data['id']; ?>&id=<?= $userinfo['id']; ?>" style="color: #000; text-decoration: red underline;"> à <?= $data['heure']; ?> le <?= $data['Jour']; ?> à publié :</a>
							</p> 
							<p class="message">
								<?= $data['message'] ?>
							</p>
							<p style="text-align: right; color: #fff;">Commentaire:
							<?php
							$commenttotal = totalcomment($data['id']);
							echo $commenttotal;
							?>
							</p>
							<form method="POST" action="index.php?action=acceuil&id=<?= $userinfo['id'] ?>" style="display: flex; justify-content: center;">
								<input type="hidden" name="idtopicality" value="<?= $data['id'] ?>">
								<input type="text" name="commentaire" style="width: 220px;">
								<input type="submit" value="Commenter" name="comment" class="submit">
							</form>
							<?php if(isset($erreur2) AND $iderreur == $data['id'] ){ 
							?>
							<span style="color: red;"><?= $erreur2 ?></span>
							<?php 
							} ?>
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