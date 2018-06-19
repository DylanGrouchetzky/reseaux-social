<?php

require_once ('manager.php');

class Insertmanager extends Manager{
	
	public function insertmbr($pseudo, $mdp, $mail){
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO profil (name, mdp, mail) VALUES (?,?,?)');
		$req->execute(array($pseudo, $mdp, $mail));
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

	public function newpicture($id, $picture){
		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO picture (idcompte, picture) VALUES (?,?)');
		$req->execute(array($id, $picture));
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