<?php
// $action : variable d'aiguillage
if(!isset($_REQUEST['action']))
{$action = 'accueilPage';}   
else
{$action = $_REQUEST['action'];}
	

switch($action)
{
	case ('accueilPage') :
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

