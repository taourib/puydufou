<?php
// $action : variable d'aiguillage
$action = $_REQUEST['action'];
$Id_profil=$_SESSION['Id_profil'];
switch($action)
{
	case ('viewPlanning') :
	{
		$lesSpectacle= $pdo->getLesSpectacle();
		if ($Id_profil == 'Administrateur')
		{
			include("vues/v_viewPlanning.php");
		}
		
		include("vues/v_viewPlanning.php");
		break;
	}
	case ('supprSpectacle') :
		{
			$Id_spectacle=$_REQUEST['spectacle'];
			$pdo->delEtapeBySpectacle($Id_spectacle);
			$pdo->delSeanceBySpectacle($Id_spectacle);
			$pdo->delSpectacleBySpectacle($Id_spectacle);
			$lesSpectacle= $pdo->getLesSpectacle();
			if ($Id_profil == 'Administrateur')
			{
				include("vues/v_viewPlanning.php");
			}
			
			include("vues/v_viewPlanning.php");
			break;
		}	
		
}
