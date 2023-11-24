<?php
class PDOpuyDuFou
{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=puydufou';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
		private static $monPdo;
		private static $monPDOpuyDuFou = null;

        private function __construct()
	{
        PDOpuyDuFou::$monPdo = new PDO(PDOpuyDuFou::$serveur.';'.PDOpuyDuFou::$bdd, PDOpuyDuFou::$user, PDOpuyDuFou::$mdp); 
        PDOpuyDuFou::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PDOpuyDuFou::$monPdo = null;
	}

	public  static function getPDOpuyDuFou()
	{
		if(PDOpuyDuFou::$monPDOpuyDuFou == null)
		{
			PDOpuyDuFou::$monPDOpuyDuFou= new PDOpuyDuFou();
		}
		return PDOpuyDuFou::$monPDOpuyDuFou;  
	}

	public function getLesSpectacle()
	{
		$req = "select Id_spectacle, libelle, tps_spectacle from spectacle";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function getLesSeance()
	{
		$req = "select Id_spectacle, heure_seance, Id_seance, immersif from seance";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function getInformationsConnexion($adresse_mail,$mdp)
	{
		$req = "select Id_profil, nom, prenom, is_admin from profil where mdp = '$mdp' and adresse_mail = '$adresse_mail'";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetch();
		return $lesLignes;
	}	

}



