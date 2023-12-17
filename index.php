<?php
// création d'une session
session_start();
include("vues/v_entete.php") ;
// inclusion en une seule fois du fichier des fonctions et du modèle
require_once("util/class.puyDuFou.inc.php");
$pdo = PDOpuyDuFou::getPDOpuyDuFou();

include("vues/v_navBar.php");

if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];
?><main><?php
switch($uc)
{
	case 'accueil':
		{include("controleurs/c_accueil.php");break;}
	case 'profil' :
		{ include("controleurs/c_profil.php");break; }
	case 'connexion' :
		{ include("controleurs/c_connexion.php");break; }
	case 'chemin' :
		{ include("controleurs/c_chemin.php");break; }
	case 'planning' :
		{ include("controleurs/c_planning.php");break; }
	case 'parc' :
		{ include("controleurs/c_parc.php");break; }
	case 'seance' :
		{ include("controleurs/c_seance.php");break; }
}

?></main><?php

include("vues/v_footer.php") ;
?>

