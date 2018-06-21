<?php
 
require ('controller/frontend.php');


if (isset($_GET['action'])){
	if($_GET['action'] == 'inscription'){
		inscription();
	}elseif($_GET['action'] == 'acceuil'){
		acceuil();
	}elseif($_GET['action'] == 'deconnexion'){
		deconnexion();
	}elseif($_GET['action'] == 'profil'){
		profil($_GET['id']);
	}elseif($_GET['action'] == 'modifier'){
		modifier($_GET['id']);
	}elseif($_GET['action'] == 'visited'){
		visited($_GET['name'], $_GET['id']);
	}elseif($_GET['action'] == 'billet'){
		billet($_GET['idbillet'], $_GET['id']);
	}elseif($_GET['action'] == 'image'){
		image($_GET['id']);
	}elseif($_GET['action'] == 'visitegalerie'){
		visitegalerie($_GET['name'], $_GET['id']);
	}elseif($_GET['action'] == 'parametre'){
		parametre($_GET['id']);
	}
}
else{
	connect();
}

?>