<?php
// $action : variable d'aiguillage
$action = $_REQUEST['action'];
switch($action)
{
	case ('viewPlanning') :
	{
		$lesSpectacle= $pdo->getLesSpectacle();
		include("vues/v_viewPlanning.php");
		break;
	}
	case 'contact':
	{	
		include("vues/v_contact.php");
		break;
	}
	case 'mentionsLegales':
	{	
		include("vues/v_mentionLegal.php");
		break;
	}
	
}
