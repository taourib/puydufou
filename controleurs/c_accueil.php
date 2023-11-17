<?php
// $action : variable d'aiguillage
if(!isset($_REQUEST['action']))
     $action = 'accueil';
else
	$action = $_REQUEST['action'];

switch($action)
{
	case '':
	{
		include("vues/v_connection.php");
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

