<?php

require_once ('manager.php');

class Verifymanager extends Manager{

	public function emailverify($mail){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM profil WHERE mail = ?');
		$req->execute(array($mail));

		return $req;
	}

	public function pseudoverify($pseudo){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM profil WHERE name = ?');
		$req->execute(array($pseudo));

		return $req;
	}

	public function userverify($mdp, $mail){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM profil WHERE mdp = ? AND mail = ?');
		$req->execute(array($mdp, $mail));
		
		return $req;
	}
}
