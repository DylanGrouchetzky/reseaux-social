<?php

require_once ('manager.php');

class Deletemanager extends Manager{

	public function deletepicturegalerie($id){
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE  FROM picture WHERE id = ?');
		$req->execute(array($id));
	}
}

?>