<?php

require_once ('model/insertmanager.php');
require_once ('model/viewmanager.php');
require_once ('model/Verifymanager.php');
require_once ('model/Deletemanager.php');
require_once ('model/Parametremanager.php');

function connect(){
	session_start();
	if(isset($_POST['connexion'])){
		$mailconnect = htmlspecialchars($_POST['mailconnect']);
		$mdpconnect = sha1($_POST['passwordconnect']);
		if (!empty($mailconnect) AND !empty($mdpconnect)){
			$verifymanager = new Verifymanager();
			$requser = $verifymanager->userverify($mdpconnect, $mailconnect);
			$userexist = $requser->rowCount();
			if($userexist == 1){
				$userinfo = $requser->fetch();
				$id = $userinfo['id'];
				header('Location: index.php?action=acceuil&id='.$id);
			}
			else{
				$erreur = "Mauvais mail ou mot de passe !";
			}
		}
		else{
			$erreur = "Tous les champs doivent être remplit !";
		}
	}
	require ('view/connect.php');
}

function inscription (){
	if(isset($_POST['inscription'])){
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail2 = htmlspecialchars($_POST['mail2']);
		$mdp = ($_POST['mdp']);
		$mdp2 = ($_POST['mdp2']);

		if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){
			$pseudolenght = strlen($pseudo);
			if ($pseudolenght <= 255) {

				$verifymanager = new Verifymanager();
				$reqpseudo = $verifymanager->pseudoverify($pseudo);
				$pseudoexist = $reqpseudo->rowCount();

				if($pseudoexist == 0){
					if ($mail == $mail2){
						if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
							

							$reqmail = $verifymanager->emailverify($mail);
							$mailexist = $reqmail->rowCount();

							if ($mailexist == 0){
								if($mdp == $mdp2){

									$mdp = sha1($mdp);
									$insertmanager = new Insertmanager();
									$insertmbr = $insertmanager->insertmbr($pseudo, $mdp, $mail);
									$viewmanager = new Viewmanager();
									$infoprofil = $viewmanager->infoprofilview($pseudo);
									$userinfo = $infoprofil->fetch();
									$insertpara = $insertmanager->newparametre($userinfo['id']);
									$pseudo = "";
									$mail = "";
									$mail2 = "";
									$mdp = "";
									$mdp2 = "";
									session_start();
									$congratulation = 'Votre compte a bien était créé <a href="index.php" id="boutonconnect">Se connecter</a>';
								}
								else{
									$erreur = "Vos mot de passe ne corresponde pas !";
								}
							}
							else{
								$erreur = "Cette adresse mail à déjà était utilisé";
							}
						}
						else{
							$erreur = "Cette adresse mail n'est pas valide";
						}
					}
					else{
						$erreur = "Vos adresse mail ne correspondant pas";
					}
				}
				else{
					$erreur = "Ce pseudo est déjà utilisé";
				}
			}
			else{
				$erreur = "Votre pseudo ne peut pas dépasser 255 caractére";
			}
		}
		else{
			$erreur = "Tout les champs doivent être remplit";
		}
	}
	require ('view/inscription.php');
}

function acceuil(){
	session_start();
	
	if(isset($_GET['id']) AND $_GET['id'] > 0){

		$_GET['id'] = intval($_GET['id']);
		$viewmanager = new Viewmanager();
		$parametremanager = new Parametremanager();
		$topicality = $viewmanager->topicality();
		$requser = $viewmanager->infoprofil($_GET['id']);
		$userinfo = $requser->fetch();
		$infoparametre = $parametremanager->selectparametre($userinfo['id']);
		$jouractuel = date('d');
		$moisactuel = date('m');
		if (empty($userinfo['picture'])){
			$userinfo['picture'] = 'inconnu.png';
		}
		if ($userinfo['age'] == 0){
			$userinfo['age'] = "Temps que l'anniversaire n'as pas été renseigner";
		}elseif($jouractuel == $userinfo['jourani'] AND $moisactuel == $userinfo['moisani']){
			$userinfo['age'] = $userinfo['age']." ans, Joyeux anniversaire";
		}else{
			$userinfo['age'] = $userinfo['age']." ans";
		}
		if (empty($userinfo['jourani']) AND empty($userinfo['moisani']) AND empty($userinfo['anneani'])){
			$anniversary = "L'anniversaire n'as pas été renseigner";
		}else{
		$anniversary = "Son anniversaire est le: ".$userinfo['jourani'].'-'.$userinfo['moisani'].'-'.$userinfo['anneani'];
		}
		if (empty($userinfo['passion'])){
			$userinfo['passion'] = "La passion n'as pas été renseigner";
		}
		if(isset($_POST['topicality']) AND !empty($_POST['messagetopicality'])) {
		$message = htmlspecialchars($_POST['messagetopicality']);
		$date = date('d/m/Y');
		$heure = date('H:i');
		$insertmanager = new Insertmanager();
		$insertmes = $insertmanager->insertmes($userinfo['id'], $userinfo['name'], $userinfo['picture'], $heure, $date, $message);
		$_POST['messagetopicality']="";
		header('Location: index.php?action=acceuil&id='.$userinfo['id']);
		}elseif (isset($_POST['topicality']) AND empty($_POST['messagetopicality'])) {
			$erreur = "Le champ de votre message est vide";
		}
		if (isset($_POST['comment']) AND !empty($_POST['commentaire'])){
			$message = $_POST['commentaire'];
			$date = date('d/m/Y');
			$heure = date('H:i');
			$id = $_POST['idtopicality'];
			$name = $userinfo['name'];
			$picture = $userinfo['picture'];
			$insertmanager = new Insertmanager();
			$inserttopicality = $insertmanager->addcomment($id, $name, $picture, $heure, $date, $message);
			$_POST['commentaire']="";
			header('Location: index.php?action=acceuil&id='.$userinfo['id']);
		}elseif (isset($_POST['comment']) AND empty($_POST['messagetopicality'])) {
			$iderreur = $_POST['idtopicality'];
			$erreur2 = "Le champ de votre message est vide";
		}
		if(isset($_POST['deletebillet'])){
			$deletemanager = new Deletemanager();
			$deletebillet = $deletemanager->deleteonetopicality($_POST['idbillet']);
			$deletecomment = $deletemanager->deletecommenttopicality($_POST['idbillet']);
			header('Location: index.php?action=acceuil&id='.$userinfo['id']);
		}

		require ('view/acceuil.php');
	}
}

function totalcomment($id){
	$viewmanager = new Viewmanager();
	$comment = $viewmanager->comment($id);
	$totalcomment = $comment->rowCount();

	return $totalcomment;
}

function profil($id){
	$viewmanager = new Viewmanager();
	$requser = $viewmanager->infoprofil($id);
	$userinfo = $requser->fetch();
	$reqtopicality = $viewmanager->topicalityprofil($userinfo['id']);
	$parametremanager = new Parametremanager();
	$infoparametre = $parametremanager->selectparametre($userinfo['id']);
	$jouractuel = date('d');
	$moisactuel = date('m');
	if (empty($userinfo['picture'])){
			$userinfo['picture'] = 'inconnu.png';
	}
	if ($userinfo['age'] == 0){
		$userinfo['age'] = "Temps que l'anniversaire n'as pas été renseigner";
	}elseif($jouractuel == $userinfo['jourani'] AND $moisactuel == $userinfo['moisani']){
		$userinfo['age'] = $userinfo['age']." ans, Joyeux anniversaire";
	}else{
		$userinfo['age'] = $userinfo['age']." ans";
	}
	if (empty($userinfo['jourani']) AND empty($userinfo['moisani']) AND empty($userinfo['anneani'])){
			$anniversary = "L'anniversaire n'as pas été renseigner";
	}else{
		$anniversary = "Son anniversaire est le: ".$userinfo['jourani'].'-'.$userinfo['moisani'].'-'.$userinfo['anneani'];
	}
	if (empty($userinfo['passion'])){
		$userinfo['passion'] = "La passion n'as pas été renseigner";
	}else{
		$userinfo['passion'] = "Ces passion sont :".$userinfo['passion'];
	}
	if(isset($_POST['topicality']) AND !empty($_POST['messagetopicality'])) {
		$message = htmlspecialchars($_POST['messagetopicality']);
		$date = date('d/m/Y');
		$heure = date('H:i');
		$insertmanager = new Insertmanager();
		$insertmes = $insertmanager->insertmes($userinfo['id'], $userinfo['name'], $userinfo['picture'], $heure, $date, $message);
		$_POST['messagetopicality']="";
		header('Location: index.php?action=profil&id='.$userinfo['id']);
		}elseif (isset($_POST['topicality']) AND empty($_POST['messagetopicality'])) {
			$erreur = "Le champ de votre message est vide";
		}
		if (isset($_POST['comment']) AND !empty($_POST['commentaire'])){
			$message = $_POST['commentaire'];
			$date = date('d/m/Y');
			$heure = date('H:i');
			$id = $_POST['idtopicality'];
			$name = $userinfo['name'];
			$picture = $userinfo['picture'];
			$insertmanager = new Insertmanager();
			$inserttopicality = $insertmanager->addcomment($id, $name, $picture, $heure, $date, $message);
			$_POST['commentaire']="";
			header('Location: index.php?action=profil&id='.$userinfo['id']);
		}elseif (isset($_POST['comment']) AND empty($_POST['messagetopicality'])) {
			$iderreur = $_POST['idtopicality'];
			$erreur2 = "Le champ de votre message est vide";
		}
		if(isset($_POST['deletebillet'])){
			$deletemanager = new Deletemanager();
			$deletebillet = $deletemanager->deleteonetopicality($_POST['idbillet']);
			$deletecomment = $deletemanager->deletecommenttopicality($_POST['idbillet']);
			header('Location: index.php?action=profil&id='.$userinfo['id']);
		}

	require ('view/profil.php');
}

function visited ($name, $id){
	$viewmanager = new Viewmanager();
	$idvisiteur = $viewmanager->infoprofil($id);
	$profilvisiteur = $idvisiteur->fetch();
	$requser = $viewmanager->infoprofilview($name);
	$userinfo = $requser->fetch();
	$reqtopicality = $viewmanager->topicalityprofil($userinfo['id']);
	$parametremanager = new Parametremanager();
	$infoparametre = $parametremanager->selectparametre($userinfo['id']);
	$jouractuel = date('d');
	$moisactuel = date('m');
	if (empty($userinfo['picture'])){
			$userinfo['picture'] = 'inconnu.png';
	}
	if ($userinfo['age'] == 0){
		$userinfo['age'] = "Temps que l'anniversaire n'as pas été renseigner";
	}elseif($jouractuel == $userinfo['jourani'] AND $moisactuel == $userinfo['moisani']){
		$userinfo['age'] = $userinfo['age']." ans, C'est son anniversaire";
	}else{
		$userinfo['age'] = $userinfo['age']." ans";
	}
	if (empty($userinfo['jourani']) AND empty($userinfo['moisani']) AND empty($userinfo['anneani'])){
			$anniversary = "L'anniversaire n'as pas été renseigner";
	}else{
		$anniversary = "Son anniversaire est le: ".$userinfo['jourani'].'-'.$userinfo['moisani'].'-'.$userinfo['anneani'];
	}
	if (empty($userinfo['passion'])){
		$userinfo['passion'] = "La passion n'as pas été renseigner";
	}else{
		$userinfo['passion'] = "Ces passion sont :".$userinfo['passion'];
	}
	if(isset($_POST['topicality']) AND !empty($_POST['messagetopicality'])) {
		$message = htmlspecialchars($_POST['messagetopicality']);
		$date = date('d/m/Y');
		$heure = date('H:i');
		$insertmanager = new Insertmanager();
		$insertmes = $insertmanager->insertmes($userinfo['id'], $profilvisiteur['name'], $profilvisiteur['picture'], $heure, $date, $message);
		$_POST['messagetopicality']="";
		header('Location: index.php?action=visited&name='.$userinfo['name'].'&id='.$profilvisiteur['id']);
		}elseif (isset($_POST['topicality']) AND empty($_POST['messagetopicality'])) {
			$erreur = "Le champ de votre message est vide";
		}

	require ('view/visite.php');
}

function visitegalerie($name, $id){
	$viewmanager = new Viewmanager();
	$infoprofil = $viewmanager->infoprofil($id);
	$userinfo = $infoprofil->fetch();
	$parametremanager = new Parametremanager();
	$infoparametre = $parametremanager->selectparametre($userinfo['id']);
	$infoprofilview = $viewmanager->infoprofilview($name);
	$viewid = $infoprofilview->fetch();
	$pictureview = $viewmanager->bibliothequeimage($viewid['id']);
	require ('view/visitegalerie.php');
}

function modifier($id){
	$viewmanager = new Viewmanager();
	$requser = $viewmanager->infoprofil($id);
	$userinfo = $requser->fetch();
	$parametremanager = new Parametremanager();
	$infoparametre = $parametremanager->selectparametre($userinfo['id']);
	$anne = date('Y');
	if (isset($_POST['modifier'])){
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$picture = htmlspecialchars($_POST['picture']);
		$jourani = intval($_POST['jourani']);
		$moisani = intval($_POST['moisani']);
		$anneani = intval($_POST['anneani']);
		$passion = htmlspecialchars($_POST['passion']);
		$age = $anne - $anneani;
		$longeurpseudo = strlen($pseudo);
		if ($longeurpseudo <= 255){
			$longeurpassion = strlen($passion);
			if ($longeurpassion <= 255){
				$insertmanager = new Insertmanager();
				$modifierprofil = $insertmanager->modifierprofil($id, $pseudo, $picture, $age, $jourani, $moisani, $anneani, $passion);
				$modifiertopicality = $insertmanager->modifiertopicality($pseudo, $picture, $userinfo['name']);
				$modifiercomment = $insertmanager->updatecomment($pseudo, $picture, $userinfo['name']);
				header('Location: index.php?action=profil&id='.$id);
			}else{
				$erreur = "La passion est trop longue (max 255charactére";
			}
		}else{
			$erreur = "Le pseudo est trop long (max 255 charactére)";
		}
	}
	require ('view/modifier.php');
}

function deconnexion(){
	session_start();
	$_SESSION = array();
	session_destroy();
	header('Location: index.php');
}

function billet($idbillet, $id){
	$viewmanager = new Viewmanager();
	$idbillet = $idbillet;
	$billet = $viewmanager->selectbillet($idbillet);
	$infobillet = $billet->fetch();
	$requser = $viewmanager->infoprofil($id);
	$userinfo = $requser->fetch();
	$comment = $viewmanager->comment($idbillet);
	$jouractuel = date('d');
	$moisactuel = date('m');
	$parametremanager = new Parametremanager();
	$infoparametre = $parametremanager->selectparametre($userinfo['id']);
	if (empty($userinfo['picture'])){
			$userinfo['picture'] = 'inconnu.png';
	}
	if ($userinfo['age'] == 0){
		$userinfo['age'] = "Temps que l'anniversaire n'as pas été renseigner";
	}elseif($jouractuel == $userinfo['jourani'] AND $moisactuel == $userinfo['moisani']){
		$userinfo['age'] = $userinfo['age']." ans, Joyeux anniversaire";
	}else{
		$userinfo['age'] = $userinfo['age']." ans";
	}
	if (empty($userinfo['jourani']) AND empty($userinfo['moisani']) AND empty($userinfo['anneani'])){
			$anniversary = "L'anniversaire n'as pas été renseigner";
	}else{
		$anniversary = "Son anniversaire est le: ".$userinfo['jourani'].'-'.$userinfo['moisani'].'-'.$userinfo['anneani'];
	}
	if (empty($userinfo['passion'])){
		$userinfo['passion'] = "La passion n'as pas été renseigner";
	}else{
		$userinfo['passion'] = "Ces passion sont :".$userinfo['passion'];
	}
	if (isset($_POST['newcomment']) AND !empty($_POST['comment'])){
		$message = $_POST['comment'];
		$date = date('d/m/Y');
		$heure = date('H:i');
		$id = $_POST['idtopicality'];
		$name = $userinfo['name'];
		$picture = $userinfo['picture'];
		$insertmanager = new Insertmanager();
		$inserttopicality = $insertmanager->addcomment($id, $name, $picture, $heure, $date, $message);
		$_POST['comment']="";
		header('Location: index.php?action=billet&idbillet='.$infobillet['id'].'&id='.$userinfo['id']);
	}elseif (isset($_POST['topicality']) AND empty($_POST['messagetopicality'])) {
		$erreur = "Le champ de votre message est vide";
	}
	if(isset($_POST['deletecomment'])){
		$deletemanager = new Deletemanager();
		$deletecomment = $deletemanager->deleteonecomment($_POST['idcomment']);
		header('Location: index.php?action=billet&idbillet='.$idbillet.'&id='.$userinfo['id']);
	}

	require ('view/billet.php');
}

function image($id){
	$viewmanager = new Viewmanager();
	$requser = $viewmanager->infoprofil($id);
	$infoprofil = $requser->fetch();
	$infopicture = $viewmanager->bibliothequeimage($id);
	$parametremanager = new Parametremanager();
	$infoparametre = $parametremanager->selectparametre($infoprofil['id']);
	if(isset($_POST['ajout']) AND !empty($_POST['newpicture'])){
		$newpicture = htmlspecialchars($_POST['newpicture']);
		$newpourqui = htmlspecialchars($_POST['pourqui']);
		$id = $infoprofil['id'];
		$insertmanager = new Insertmanager();
		$insertpicture = $insertmanager->newpicture($id, $newpicture, $newpourqui);
		$_POST['newpicture'] = "";
		header('Location: index.php?action=image&id='.$id);
	}elseif(isset($_POST['ajout']) AND empty($_POST['newpicture'])){
		$erreur = "Le champs est vide";
	}
	if(isset($_POST['updatepicture'])){
		$insertmanager = new Insertmanager();
		$updatepicture = $insertmanager->updatepicture($infoprofil['id'], $_POST['updateprofil']);
		$updatepicturetopicality = $insertmanager->updatepicturetopicality($infoprofil['name'], $_POST['updateprofil']);
		$updatecomment = $insertmanager->updatepicturecomment($infoprofil['name'], $_POST['updateprofil']);
		header('Location: index.php?action=profil&id='.$infoprofil['id']);
	}
	if(isset($_POST['public'])){
		$id = $_POST['id'];
		$pourqui = 'public';
		$insertmanager = new Insertmanager();
		$update = $insertmanager->modifierpourqui($id, $pourqui);
		header('Location: index.php?action=image&id='.$infoprofil['id']);
	}
	if(isset($_POST['priver'])){
		$id = $_POST['id'];
		$pourqui = 'priver';
		$insertmanager = new Insertmanager();
		$update = $insertmanager->modifierpourqui($id, $pourqui);
		header('Location: index.php?action=image&id='.$infoprofil['id']);
	}
	if(isset($_POST['deletepicture'])){
		$deletemanager = new Deletemanager();
		if($_POST['updateprofil'] == $infoprofil['picture']){
			$newnamepicture = "inconnu.png";
			$insertmanager = new Insertmanager();
			$updatepicture = $insertmanager->updatepicture($infoprofil['id'], $newnamepicture);
			$updatepicturetopicality = $insertmanager->updatepicturetopicality($infoprofil['name'], $newnamepicture);
			$updatecomment = $insertmanager->updatepicturecomment($infoprofil['name'], $newnamepicture);
		}
		$deletepicture = $deletemanager->deletepicturegalerie($_POST['delete']);
		header('Location: index.php?action=image&id='.$id);
	}
	require ('view/image.php');
}

function parametre($id){
	$viewmanager = new Viewmanager();
	$requser = $viewmanager->infoprofil($id);
	$userinfo = $requser->fetch();
	$parametremanager = new Parametremanager();
	$infoparametre = $parametremanager->selectparametre($userinfo['id']);
	if (isset($_POST['changeparametre'])){
		$parametremanager = new Parametremanager();
		$update = $parametremanager->updateparametre($userinfo['id'], $_POST['background'], $_POST['backgroundheader'], $_POST['backgroundbouton'], $_POST['colorbouton'], $_POST['backgroundboutonhover'], $_POST['colorboutonhover'], $_POST['backgroundprofil'], $_POST['colorlien'], $_POST['colordecorationlien'], $_POST['backgroundboutonform'], $_POST['colorboutonform'], $_POST['backgroundboutonformhover'], $_POST['colorboutonformhover']);
		header('Location: index.php?action=acceuil&id='.$userinfo['id']);
	}
	if(isset($_POST['delete'])){
		$deletemanager = new Deletemanager();
		$deletetprofil = $deletemanager->deletetprofil($_POST['id']);
		$deletetpicture = $deletemanager->deletepicture($_POST['id']);
		$deletetopicality = $deletemanager->deletetopicality($_POST['id']);
		$deleteparametrecolor = $deletemanager->deleteparametrecolor($_POST['id']);
		$deletecomment = $deletemanager->deletecomment($_POST['name']);
		header('Location: index.php');
	}
	
	require ('view/parametre.php');
}

?>