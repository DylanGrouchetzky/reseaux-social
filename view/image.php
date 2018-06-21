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
				<li><a href="index.php?action=acceuil&id=<?= $infoprofil['id'] ?>">Acceuil</a></li>
				<li><a href="index.php?action=profil&id=<?= $infoprofil['id'] ?>">Profil</a></li>
				<li><a href="index.php?action=image&id=<?= $infoprofil['id'] ?>">Image</a></li>
				<li><a href="index.php?action=parametre&id=<?= $infoprofil['id'] ?>">Paramétre</a></li>
				<li><a href="index.php?action=deconnexion">Déconnexion</a></li>
			</ul>
		</nav>
	</header>
	<h1>Vous êtes sur votre bibliothéque d'image</h1>
		<div class="galeriefont">
			<form method="POST" action="index.php?action=image&id=<?= $infoprofil['id'] ?>">
				<div class="galerie" style="width: 170px; height: 100px;">
					<label for="newpicture">Nom de l'image: </label>
					<input type="text" name="newpicture" id="newpicture"><br>
					<select name="pourqui" id="pourqui">
						<option value="public">public</option>
						<option value="priver">priver</option>
					</select>
					<input type="submit" value="Ajouté" name="ajout" class="submit">
					<?php if(isset($erreur)){ ?> <p style="color: red"> <?= $erreur ?> </p> <?php } ?>
				</div>
			</form>
			<?php
			while($data = $infopicture->fetch()){
				?>
				<div class="galerie">
					<?php

					if($data['pourqui'] == 'public'){
						echo '<span style="text-decoration: red underline;">Cette image est public</span><br>';
					}elseif($data['pourqui'] == 'priver'){
						echo '<span style="text-decoration: red underline;"">Cette image est priver</span><br>';
					}

					?>
					<a href="public/image/<?= $data['picture'] ?>"><img src="public/image/<?= $data['picture'] ?>"></a>
					<form method="POST" action="index.php?action=image&id=<?= $infoprofil['id'] ?>">
						<input type="hidden" name="updateprofil" value="<?= $data['picture'] ?>">
						<input type="hidden" name="delete" value="<?= $data['id'] ?>">
						<input type="submit" value="Changer l'image de profil" name="updatepicture" class="submit"><br>
						<?php

						if($data['pourqui'] == 'public'){
							?>
							<input type="hidden" name="id" value="<?= $data['id'] ?>">
							<input type="submit" value="Changer en privée" name="priver" class="submit"><br>
							<?php
						}elseif($data['pourqui'] == 'priver'){
							?>
							<input type="hidden" name="id" value="<?= $data['id'] ?>">
							<input type="submit" value="Changer en public" name="public" class="submit"><br>
							<?php
						}
						?>
						<input type="submit" value="Supprimer l'image" name="deletepicture" class="submit">
					</form>
				</div>
				<?php
			}
			?>
		</div>
	</body>
</html>