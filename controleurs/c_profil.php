<?php
// $action : variable d'aiguillage
$action = $_REQUEST['action'];
if (empty($_SESSION['Id_profil']) || $_SESSION['Id_profil'] == "Administrateur") {
    
	if (empty($_SESSION['Id_profil'])){
		$prenom = 'NULL';
		$nom = 'NULL';
		$email = 'NULL';
	}else{
		$nom = "Administrateur";
		$prenom = "Administrateur";
		$Id_profil = "Administrateur";
		$email = "Administrateur";
	}
	

} else {
    $nom = $_SESSION['nomClient'];
    $prenom = $_SESSION['prenomClient'];
    $Id_profil = $_SESSION['Id_profil'];
    $email = $pdo->getInfoMail($Id_profil);
}


switch($action)
{
	case ('viewProfil') :
	{
		include("vues/v_profil.php");
		break;
	}
	case 'deconnexion':
	{	
		if (!empty($_SESSION)){
			session_destroy();	
		}		
		echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Vous avez bien été déconnecté')
                    window.location.href='index.php';
                    </SCRIPT>");
		break;
	}
	case 'traitChangeProfil':
	{	
		if(empty($_POST['Nom'])){$Nom='';}
		else{$Nom=$_POST['Nom'];}
		if(empty($_POST['Prenom'])){$Prenom='';}
		else{$Prenom=$_POST['Prenom'];}
		if(empty($_POST['Mail'])){$Mail='';}
		else{$Mail=$_POST['Mail'];}
		if(empty($_POST['mdpA'])){$mdpA='';}
		else{$mdpA=$_POST['mdpA'];}
		if(empty($_POST['mdpN'])){$mdpN='';}
		else{$mdpN=$_POST['mdpN'];}
		$mdp=$pdo->getInfoMdp($Id_profil);
		$email=$pdo->getInfoMail($_SESSION['Id_profil']);

		if($mdpA==$mdp){
			$pdo->modifProfil($Id_profil,$Nom,$Prenom,$mdpN,$Mail);
			$_SESSION['nomClient']=$Nom;
			$_SESSION['prenomClient']=$Prenom;
			$nom = $_SESSION['nomClient'];
			$prenom = $_SESSION['prenomClient'];
			include("vues/v_profil.php");
			break;
		}	
		else{
			include("vues/v_alertModifProfil.php");
			include("vues/v_profil.php");
			break;
		}
	}
}

