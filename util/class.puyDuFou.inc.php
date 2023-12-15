<?php
class PDOpuyDuFou
{
	private static $serveur = 'mysql:host=localhost';
	private static $bdd = 'dbname=puydufou';
	private static $user = 'root';
	private static $mdp = '';
	private static $monPdo;
	private static $monPDOpuyDuFou = null;

	private function __construct()
	{
		PDOpuyDuFou::$monPdo = new PDO(PDOpuyDuFou::$serveur . ';' . PDOpuyDuFou::$bdd, PDOpuyDuFou::$user, PDOpuyDuFou::$mdp);
		PDOpuyDuFou::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct()
	{
		PDOpuyDuFou::$monPdo = null;
	}

	public  static function getPDOpuyDuFou()
	{
		if (PDOpuyDuFou::$monPDOpuyDuFou == null) {
			PDOpuyDuFou::$monPDOpuyDuFou = new PDOpuyDuFou();
		}
		return PDOpuyDuFou::$monPDOpuyDuFou;
	}

	public function getLesSpectacle()
	{
		$req = "select Id_spectacle, libelle, tps_spectacle from spectacle where Id_spectacle != 0";
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

	public function Trajet1avec2($Id_spectacle,$Id_spectacle_1)
	{
		$req = "SELECT count(*)as trajet FROM `trajet` WHERE Id_spectacle = $Id_spectacle and Id_spectacle_1 = $Id_spectacle_1  or Id_spectacle = $Id_spectacle_1 and Id_spectacle_1 = $Id_spectacle";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$resultat = $res->fetch(PDO::FETCH_ASSOC);
		return $resultat['trajet'];
	}

	public function getLesChemin()
	{
		$req = "select t.Id_spectacle, t.Id_spectacle_1, t.distance_km_, s.libelle, 
		(select s.libelle from spectacle s where s.Id_spectacle = t.Id_spectacle_1) as libelle2
		from trajet t
		inner join spectacle s on t.Id_spectacle = s.Id_spectacle;";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function getInfoConnexion($adresse_mail, $mdp)
	{
		$req = "select Id_profil, nom, prenom, is_admin from profil where mdp = '$mdp' and adresse_mail = '$adresse_mail'";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetch();
		return $lesLignes;
	}

	public function getInfoMail($Id_profil)
	{
		$req = "SELECT adresse_mail FROM profil WHERE Id_profil = '$Id_profil'";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$ligne = $res->fetch(PDO::FETCH_ASSOC);
		return $ligne['adresse_mail'];
	}

	public function getInfoMdp($Id_profil)
	{
		$req = "SELECT mdp FROM profil WHERE Id_profil = '$Id_profil'";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$ligne = $res->fetch(PDO::FETCH_ASSOC);
		return $ligne['mdp'];
	}

	public function modifProfil($Id_profil, $Nom, $Prenom, $mdpN, $Mail)
	{
		$req = "UPDATE profil SET nom = '$Nom', prenom = '$Prenom', mdp = '$mdpN', adresse_mail = '$Mail' WHERE Id_profil = '$Id_profil'";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}

	public function delEtapeBySpectacle($Id_spectacle)
	{
		$req = "DELETE FROM `etape` where Id_spectacle='$Id_spectacle'";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}

	public function delSeanceBySpectacle($Id_spectacle)
	{
		$req = "DELETE FROM `seance` where Id_spectacle='$Id_spectacle'";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}
	public function delTrajetBySpectacle($Id_spectacle)
	{
		$req = "DELETE FROM `trajet` where Id_spectacle='$Id_spectacle'or Id_spectacle_1='$Id_spectacle' ";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}

	public function delTrajetByDoubleID($Id_spectacle,$Id_spectacle_1)
	{
		$req = "DELETE FROM `trajet` where (Id_spectacle='$Id_spectacle'and Id_spectacle_1='$Id_spectacle_1') or (Id_spectacle='$Id_spectacle_1'and Id_spectacle_1='$Id_spectacle') ";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}
	public function delSelectionBySpectacle($Id_spectacle)
	{
		$req = "DELETE FROM `selection` where Id_spectacle='$Id_spectacle'";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}
	public function delProgrammeBySpectacle($Id_spectacle)
	{
		$req = "DELETE FROM `programme` where Id_spectacle='$Id_spectacle'";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}
	public function delSpectacleBySpectacle($Id_spectacle)
	{
		$req = "DELETE FROM `spectacle` where Id_spectacle='$Id_spectacle'";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}

	public function ajouterTrajet($Id_spectacle, $Id_spectacle_2, $distance)
	{
		$req = "INSERT INTO trajet (Id_spectacle, Id_spectacle_1, distance_km_) VALUES (:Id_spectacle, :Id_spectacle_1, :distance_km_)";

		$res = PDOpuyDuFou::$monPdo->prepare($req);

		$res->bindParam(':Id_spectacle', $Id_spectacle);
		$res->bindParam(':Id_spectacle_1', $Id_spectacle_2);
		$res->bindParam(':distance_km_', $distance);

		$res->execute();
	}

	public function modifTrajet($Spectacle_1, $Spectacle_2, $distance, $spectacleOriginelle1, $spectacleOriginelle2)
	{
		$req = "UPDATE `trajet` SET Id_spectacle = $Spectacle_1, Id_spectacle_1 = $Spectacle_2, distance_km_ = $distance 
		WHERE (Id_spectacle = $spectacleOriginelle1 AND Id_spectacle_1 = $spectacleOriginelle2)";

		$res = PDOpuyDuFou::$monPdo->exec($req);
	}



	

	public function ajouterClient($nomClient, $prenomClient, $mailClient, $mdpClient)
	{
		$req = "INSERT INTO profil (nom, prenom, adresse_mail, mdp) VALUES (:nom, :prenom, :mail, :mdp)";

		$res = PDOpuyDuFou::$monPdo->prepare($req);

		$res->bindParam(':nom', $nomClient);
		$res->bindParam(':prenom', $prenomClient);
		$res->bindParam(':mail', $mailClient);
		$res->bindParam(':mdp', $mdpClient);

		$res->execute();
	}
}
