<?php

require_once ('manager.php');

class Deletemanager extends Manager{

	public function deletepicturegalerie($id){
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE  FROM picture WHERE id = ?');
		$req->execute(array($id));
	}

	public function deletetprofil($id){
		$db = $this->dbConnect();
		$reqprofil = $db->prepare('DELETE FROM profil WHERE id = ?');
		$reqprofil->execute(array($id));
	}

	public function deletepicture($id){
		$db = $this->dbConnect();
		$reqpicture = $db->prepare('DELETE FROM picture WHERE idcompte = ?');
		$reqpicture->execute(array($id));
	}

	public function deletetopicality($id){
		$db = $this->dbConnect();
		$reqtopicality = $db->prepare('DELETE FROM topicality WHERE compte = ?');
		$reqtopicality->execute(array($id));
		$db = $this->dbConnect();
	}

	public function deleteparametrecolor($id){
		$db = $this->dbConnect();
		$reqparametre = $db->prepare('DELETE FROM parametrecolor WHERE idcompte = ?');
		$reqparametre->execute(array($id));
	}

	public function deletecomment($name){
		$db = $this->dbConnect();
		$reqcomment = $db->prepare('DELETE FROM comment WHERE name = ?');
		$reqcomment->execute(array($name));
	}

	public function deleteonecomment($id){
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comment WHERE id = ?');
		$req->execute(array($id));
	}

	public function deleteonetopicality($id){
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM topicality WHERE id = ?');
		$req->execute(array($id));
	}

	public function deletecommenttopicality($id){
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comment WHERE idtopicality = ?');
		$req->execute(array($id));
	}
}

?>