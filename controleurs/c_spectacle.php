<?php
// $action : variable d'aiguillage
$action = 'accueilPage';

switch($action)
{
	case ('viewSpectacle') :
	{
		include("vues/v_accueil.php");
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

