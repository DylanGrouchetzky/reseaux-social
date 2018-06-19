<?php

require_once ('manager.php');

class Viewmanager extends Manager{

	public function infoprofil ($id){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM profil WHERE id = ?');
		$req->execute(array($id));

		return $req;
	}

	public function infoprofilview($name){
		$db= $this->dbConnect();
		$req = $db->prepare('SELECT * FROM profil WHERE name = ?');
		$req->execute(array($name));

		return $req;
	}

	public function topicality (){
		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM topicality ORDER BY id DESC');

		return $req;
	}

	public function topicalityprofil($id){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM topicality WHERE compte = ? ORDER BY id DESC');
		$req->execute(array($id));

		return $req;
	}

	public function comment($idtopicality){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM comment WHERE idtopicality = ?');
		$req->execute(array($idtopicality));

		return $req;
	}

	public function selectbillet($id){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM topicality WHERE id = ?');
		$req->execute(array($id));

		return $req;
	}

	public function bibliothequeimage($id){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM picture WHERE idcompte = ?');
		$req->execute(array($id));

		return $req;
	}
}
?>