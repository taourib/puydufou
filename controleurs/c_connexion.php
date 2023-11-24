<?php
// $action : variable d'aiguillage
$action = $_REQUEST['action'];

switch($action)
{
	case 'connexion':
	{
		include("vues/v_connexion.php");
		break;
	}
	case 'traitConnexion':
	{	
		if(empty($_POST['mailU'])){$adresse_mail='';}else{$adresse_mail=$_POST['mailU'];}
		if(empty($_POST['mdpU'])){$mdp='';}else{$mdp=$_POST['mdpU'];}

		$leClient=$pdo->getInformationsConnexion($adresse_mail,$mdp);

		if (empty($leClient)){
			include("vues/v_alertConnection.php");
			include("vues/v_connexion.php");
			break;	
		}else{
			$_SESSION['Id_profil']=$leClient['Id_profil'];
			$_SESSION['nomClient']=$leClient['nom'];
			$_SESSION['prenomClient']=$leClient['prenom'];

			if($leClient['is_admin'] == '1')
			{
				$_SESSION['idClient']="Administrateur";
				$_SESSION['nomClient']=NULL;
				$_SESSION['prenomClient']="Administrateur";
			}
			include("vues/v_mentionLegal.php");
			break;
		}	
	}
	case 'mentionsLegales':
	{	
		include("vues/v_mentionLegal.php");
		break;
	}
	
}
