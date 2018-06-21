<?php

require_once ('manager.php');

class Parametremanager extends Manager{

	public function selectparametre($id){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM parametrecolor WHERE idcompte = ?');
		$req->execute(array($id));
		$liste = $req->fetch();

		return $liste;
	}

	public function updateparametre($idcompte, $background, $backgroundheader, $backgroundbouton, $colorbouton, $backgroundboutonhover, $colorboutonhover, $backgroundprofil, $colorlien, $colordecorationlien, $backgroundboutonform, $colorboutonform, $backgroundboutonformhover, $colorboutonformhover){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE parametrecolor SET background = :background, backgroundheader = :backgroundheader, backgroundbouton = :backgroundbouton, colorbouton = :colorbouton, backgroundboutonhover = :backgroundboutonhover, colorboutonhover = :colorboutonhover, backgroundprofil = :backgroundprofil, colorlien = :colorlien, colordecorationlien = :colordecorationlien , backgroundboutonform = :backgroundboutonform, colorboutonform = :colorboutonform, backgroundboutonformhover = :backgroundboutonformhover, colorboutonformhover = :colorboutonformhover WHERE idcompte = :idcompte');
		$update = $req->execute(array(
			'idcompte' => $idcompte,
			'background' => $background,
			'backgroundheader' => $backgroundheader,
			'backgroundbouton' => $backgroundbouton,
			'colorbouton' => $colorbouton,
			'backgroundboutonhover' => $backgroundboutonhover,
			'colorboutonhover' => $colorboutonhover,
			'backgroundprofil' => $backgroundprofil,
			'colorlien' => $colorlien,
			'colordecorationlien' => $colordecorationlien,
			'backgroundboutonform' => $backgroundboutonform,
			'colorboutonform' => $colorboutonform,
			'backgroundboutonformhover' => $backgroundboutonformhover,
			'colorboutonformhover' => $colorboutonformhover,


		));
	}

}

?>