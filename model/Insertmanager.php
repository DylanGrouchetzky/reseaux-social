<?php

require_once ('manager.php');

class Insertmanager extends Manager{
	
	public function insertmbr($pseudo, $mdp, $mail){
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO profil (name, mdp, mail) VALUES (?,?,?)');
		$req->execute(array($pseudo, $mdp, $mail));
	}

	public function newparametre($idcompte){
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO parametrecolor (idcompte, background, backgroundheader, backgroundbouton, colorbouton, backgroundboutonhover, colorboutonhover, backgroundprofil) VALUES (?,?,?,?,?,?,?,?)');
		$background = '#ffffff';
		$backgroundheader = '#940b50';
		$backgroundbouton = '#6a0b3b';
		$colorbouton = '#ffffff';
		$backgroundboutonhover = '#ffffff';
		$colorboutonhover = '#6a0b3b';
		$backgroundprofil = '#ffffff';
		$req->execute(array($idcompte, $background, $backgroundheader, $backgroundbouton, $colorbouton, $backgroundboutonhover, $colorboutonhover, $backgroundprofil));
	}

	public function insertmes($id, $name, $picture, $heure, $jour, $message){
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO topicality (compte, name, picture, heure, Jour, message) VALUES (?,?,?,?,?,?)');
		$req->execute(array($id, $name, $picture, $heure, $jour, $message));
	}

	public function modifierprofil($id, $pseudo, $picture, $age, $jourani, $moisani, $anneani, $passion){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE profil SET name = :name, picture = :picture, age = :age, jourani = :jourani ,moisani = :moisani ,anneani = :anneani, passion = :passion WHERE id = :id');
		$update = $req->execute(array(
			'id' => $id,
			'name' => $pseudo,
			'picture' => $picture,
			'age' => $age,
			'jourani' => $jourani,
			'moisani' => $moisani,
			'anneani' => $anneani,
			'passion' => $passion,
		));
	}

	public function modifierpourqui($id, $pourqui){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE picture SET pourqui = :pourqui WHERE id = :id');
		$update = $req->execute(array(
			'id' => $id,
			'pourqui' => $pourqui,
		));
	}

	public function modifiertopicality($pseudo, $picture, $name){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE topicality SET name = :name, picture = :picture  WHERE name = :pseudo');
		$update = $req->execute(array(
			'pseudo' => $name,
			'name' => $pseudo,
			'picture' => $picture,
		));
	}

	public function updatecomment($pseudo, $picture, $name){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comment SET name = :name, picture = :picture  WHERE name = :pseudo');
		$update = $req->execute(array(
			'pseudo' => $name,
			'name' => $pseudo,
			'picture' => $picture,
		));
	}

	public function addcomment($id, $pseudo, $picture, $heure, $jour, $message){
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO comment (idtopicality, name, picture, heure, Jour, message) VALUES (?,?,?,?,?,?) ');
		$req->execute(array($id, $pseudo, $picture, $heure, $jour, $message));
	}

	public function newpicture($id, $picture, $newpourqui){
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO picture (idcompte, picture, pourqui) VALUES (?,?,?)');
		$req->execute(array($id, $picture, $newpourqui));
	}

	public function updatepicture($id, $picture){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE profil SET picture = :picture WHERE id = :id');
		$req->execute(array(
			'picture' => $picture,
			'id' => $id,
		));
	}

	public function updatepicturetopicality($name, $picture){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE topicality SET picture = :picture WHERE name = :name');
		$req->execute(array(
			'picture' => $picture,
			'name' => $name,
		));
	}

	public function updatepicturecomment($name, $picture){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE comment SET picture = :picture WHERE name = :name');
		$req->execute(array(
			'picture' => $picture,
			'name' => $name,
		));
	}
}

?>