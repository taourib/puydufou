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
		$req = "SELECT Id_spectacle, libelle, tps_spectacle from spectacle where Id_spectacle != 0";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function getLesSeance()
	{
		$req = "SELECT Id_spectacle, heure_seance, Id_seance, immersif from seance";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function getLesSeanceById_spectacle($id_spectacle)
	{
		$req = "SELECT date_parc,Id_spectacle, heure_seance, Id_seance, immersif from seance where id_spectacle = $id_spectacle";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function getOuvertureParc()
	{
		$req = "SELECT * FROM `parc` ";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function getId_spectacleBydate_parc($Id_spectacle)
	{
		$req = "SELECT Id_seance FROM `seance` where Id_spectacle = $Id_spectacle order by Id_seance asc limit 1";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetch();
		return $lesLignes; 	
	}

	public function seanceExisteById_spectacleAndHeure_seanceAndDate_parc($Id_spectacle,$heure_seance,$date_parc)
	{
		$req = "SELECT count(*)as nb FROM `seance` WHERE Id_spectacle = :Id_spectacle AND heure_seance = :heure_seance AND date_parc = :date_parc";
		$res = PDOpuyDuFou::$monPdo->prepare($req);
		$res->bindParam(':Id_spectacle', $Id_spectacle);
		$res->bindParam(':heure_seance', $heure_seance);
		$res->bindParam(':date_parc', $date_parc);
		$res->execute();
		$result = $res->fetch(PDO::FETCH_ASSOC);
		return $result['nb']; 	
	}

	public function ancienSeanceExisteById_spectacleAndHeure_seanceAndDate_parc($Id_spectacle,$heure_seance,$date_parc,$Id_seance)
	{
		$req = "SELECT count(*)as nb FROM `seance` WHERE Id_spectacle = :Id_spectacle AND heure_seance = :heure_seance AND date_parc = :date_parc AND Id_seance != :Id_seance";
		$res = PDOpuyDuFou::$monPdo->prepare($req);
		$res->bindParam(':Id_spectacle', $Id_spectacle);
		$res->bindParam(':heure_seance', $heure_seance);
		$res->bindParam(':date_parc', $date_parc);
		$res->bindParam(':Id_seance', $Id_seance);
		$res->execute();
		$result = $res->fetch(PDO::FETCH_ASSOC);
		return $result['nb']; 	
	}

	public function getMaxId_seanceOnSeanceById_spectacleAndDate_parc($Id_spectacle,$date_parc)
	{
		$req = "SELECT MAX(Id_seance) as maxId FROM `seance` WHERE Id_spectacle = :Id_spectacle AND date_parc = :date_parc";
		$res = PDOpuyDuFou::$monPdo->prepare($req);
		$res->bindParam(':Id_spectacle', $Id_spectacle, PDO::PARAM_INT);
		$res->bindParam(':date_parc', $date_parc, PDO::PARAM_STR);
		$res->execute();
		$result = $res->fetch(PDO::FETCH_ASSOC);
		return $result['maxId'];
	}

	public function getInfoSeanceById_seanceAndId_spectacleAnddate_parc($Id_seance,$Id_spectacle,$date_parc)
	{
		$req = "SELECT date_parc, Id_spectacle, heure_seance, Id_seance, immersif FROM `seance` WHERE Id_seance = :Id_seance AND Id_spectacle = :Id_spectacle AND date_parc = :date_parc";
		$res = PDOpuyDuFou::$monPdo->prepare($req);
		$res->bindParam(':Id_seance', $Id_seance, PDO::PARAM_INT);
		$res->bindParam(':Id_spectacle', $Id_spectacle, PDO::PARAM_INT);
		$res->bindParam(':date_parc', $date_parc, PDO::PARAM_STR);
		$res->execute();
		$lesLignes = $res->fetch(PDO::FETCH_ASSOC);

		return $lesLignes;
	}

	public function Trajet1avec2($Id_spectacle,$Id_spectacle_1)
	{
		$req = "SELECT count(*)as trajet FROM `trajet` WHERE Id_spectacle = $Id_spectacle and Id_spectacle_1 = $Id_spectacle_1  or Id_spectacle = $Id_spectacle_1 and Id_spectacle_1 = $Id_spectacle";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$resultat = $res->fetch(PDO::FETCH_ASSOC);
		return $resultat['trajet'];
	}

	public function countdate_parcByDate($date_parc)
	{
		$req = "SELECT count(*)as nb FROM `parc` WHERE date_parc = $date_parc ";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$resultat = $res->fetch(PDO::FETCH_ASSOC);
		return $resultat['nb'];
	}

	public function getLesChemin()
	{
		$req = "SELECT t.Id_spectacle, t.Id_spectacle_1, t.distance_km_, s.libelle, 
		(select s.libelle from spectacle s where s.Id_spectacle = t.Id_spectacle_1) as libelle2
		from trajet t
		inner join spectacle s on t.Id_spectacle = s.Id_spectacle;";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function getInfoConnexion($adresse_mail, $mdp)
	{
		$req = "SELECT Id_profil, nom, prenom, is_admin from profil where mdp = '$mdp' and adresse_mail = '$adresse_mail'";
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

	public function getHeureByDate_Parc($date)
	{
		$req = "SELECT heure_ouverture,heure_fermeture FROM parc WHERE date_parc = '$date'";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$ligne = $res->fetch(PDO::FETCH_ASSOC);
		return $ligne;
	}

	public function getInfoMdp($Id_profil)
	{
		$req = "SELECT mdp FROM profil WHERE Id_profil = '$Id_profil'";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$ligne = $res->fetch(PDO::FETCH_ASSOC);
		return $ligne['mdp'];
	}

	public function getInfoSpectaclebyID($Id_spectacle)
	{
		$req = "SELECT Id_spectacle,libelle,tps_spectacle FROM spectacle WHERE Id_spectacle = '$Id_spectacle'";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$ligne = $res->fetch(PDO::FETCH_ASSOC);
		return $ligne;
	}

	public function modifParcByDate_parc($date_parc, $heure_ouverture, $heure_fermeture)
	{
		$req = "UPDATE parc SET heure_ouverture = '$heure_ouverture', heure_fermeture = '$heure_fermeture' WHERE date_parc = '$date_parc'";
		$res = PDOpuyDuFou::$monPdo->exec($req);
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

	public function delSeanceById_seanceAndId_spectacle($Id_seance,$Id_spectacle,$date_parc)
	{
		$req = "DELETE FROM `seance` WHERE Id_seance = :Id_seance AND Id_spectacle = :Id_spectacle AND date_parc = :date_parc";
		$res = PDOpuyDuFou::$monPdo->prepare($req);
		$res->bindParam(':Id_seance', $Id_seance);
		$res->bindParam(':Id_spectacle', $Id_spectacle);
		$res->bindParam(':date_parc', $date_parc);
		$res->execute();

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
	
public function delFromByDate_parc($From,$date)
	{
		$req = "DELETE FROM `$From` where date_parc='$date'";
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

	public function modifSpectacle($Id_spectacle, $libelle, $tps_spectacle)
	{
		$req = "UPDATE `spectacle` SET libelle = :libelle, tps_spectacle = :tps_spectacle WHERE (Id_spectacle = :Id_spectacle)";
    
		$stmt = PDOpuyDuFou::$monPdo->prepare($req);
		
		$stmt->bindValue(':libelle', $libelle, PDO::PARAM_STR);
		$stmt->bindValue(':tps_spectacle', $tps_spectacle, PDO::PARAM_STR);
		$stmt->bindValue(':Id_spectacle', $Id_spectacle, PDO::PARAM_INT);
		
		$res = $stmt->execute();
	}


	public function modifSeance($date_parc, $Id_spectacle, $heure_seance,$Id_seance,$immersif)
	{
		$req = "UPDATE `seance` SET heure_seance = :heure_seance, immersif = :immersif WHERE date_parc = :date_parc AND Id_spectacle=:Id_spectacle AND Id_seance=:Id_seance";
	
		$stmt = PDOpuyDuFou::$monPdo->prepare($req);
		
		$stmt->bindValue(':date_parc', $date_parc);
		$stmt->bindValue(':Id_spectacle', $Id_spectacle);
		$stmt->bindValue(':heure_seance', $heure_seance);
		$stmt->bindValue(':Id_seance', $Id_seance);
		$stmt->bindValue(':immersif', $immersif);
		
		$res = $stmt->execute();
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

	public function ajouterDateParc($date, $heure_ouverture, $heure_fermeture)
	{
		$req = "INSERT INTO parc (date_parc, heure_ouverture, heure_fermeture) VALUES (:date_parc, :heure_ouverture, :heure_fermeture)";

		$res = PDOpuyDuFou::$monPdo->prepare($req);

		$res->bindParam(':date_parc', $date);
		$res->bindParam(':heure_ouverture', $heure_ouverture);
		$res->bindParam(':heure_fermeture', $heure_fermeture);
		$res->execute();
	}

	public function getvitessevisiteur($idvisiteur){
		$req = "SELECT vitesse from visiteur where Id_visiteur =" . $idvisiteur.";";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$vitesse = $res->fetch();
		return $vitesse['vitesse'];
	}

	public function getheureparc($datesaisie){
		$req = "SELECT heure_ouverture, heure_fermeture from parc where date_parc='".$datesaisie."'";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$planning = $res->fetch();
		return $planning;
	}

	public function delparcours($idvisiteur, $datesaisie, $idvisite){
		$req="delete from etape where Id_Visiteur =" . $idvisiteur." and date_parc='".$datesaisie."' and Id_visite=".$idvisite." ;";
		$res = PDOpuyDuFou::$monPdo->exec($req);

		$req="delete from parcours where Id_Visiteur =".$idvisiteur." and date_parc='".$datesaisie."' and Id_visite=".$idvisite.";";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}

	public function distancespec(){

		$req = 'SELECT Id_Spectacle, Id_Spectacle_1, distance_km_ from trajet';
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesDistances = $res->fetchAll();
		return $lesDistances;
	}

	public function selectionspec($datesaisie, $idvisiteur , $idvisite){
		$req = "SELECT spectacle.Id_Spectacle, tps_spectacle, tps_attente 
		from selection 
		inner join spectacle on selection.Id_Spectacle=spectacle.Id_Spectacle 
		inner join programme on selection.Id_Spectacle=programme.Id_Spectacle 
		where programme.date_parc= '".$datesaisie."' and selection.date_parc= '".$datesaisie."' and Id_Visiteur =" . $idvisiteur. " and Id_visite='".$idvisite."';";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesSpectaclesSelectionnes = $res->fetchAll();
		return $lesSpectaclesSelectionnes;
	}

	public function premseance($s,$heureparcours,$datesaisie){
		$req = "SELECT immersif, heure_seance from seance where Id_Spectacle = ".$s." and heure_seance >= '".$heureparcours."' and date_parc = '". $datesaisie ."' order by heure_seance limit 1; ";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$seance = $res->fetch();
		return $seance;
	}

	public function ajouterparcours($p, $datesaisie, $idvisiteur, $idvisite)
	{
		$req = "insert into parcours
		(Id_parcours, date_parc, Id_visiteur, Id_visite) values
		(:Id_parcours, :date_parc,:Id_visiteur, :Id_visite)";

		$res = PDOpuyDuFou::$monPdo->prepare($req);

		$res->bindValue (':Id_parcours', $p);
		$res->bindValue (':date_parc', $datesaisie);
		$res->bindValue (':Id_visiteur', $idvisiteur);
		$res->bindValue (':Id_visite', $idvisite);

		$res->execute();
	}

	public function idseance($tabparcours,$j,$datesaisie){
		$req = "select Id_seance from seance where Id_Spectacle = ".$tabparcours [$j][0]." and heure_seance ='".$tabparcours [$j][1]."' and date_parc = '". $datesaisie ."';";
        $res = PDOpuyDuFou::$monPdo->query($req);
        $id_seance = $res->fetch();
		return $id_seance;
	}

	public function ajouterseance($p, $datesaisie, $idvisiteur, $j, $tabparcours, $idvisite, $id_seance)
	{
		$req = "insert into etape
		(date_parc_1, Id_Parcours, date_parc, Id_Visiteur, ordre, chemin, Id_Spectacle,heure_seance, Id_visite, Id_seance)
		values
		(:Dateparc_1, :Id_Parcours, :date_parc, :Id_Visiteur, :ordre, :chemin, :Id_Spectacle, :heure_seance, :Id_visite, :Id_seance)";

		$res = PDOpuyDuFou::$monPdo->prepare($req);

		$res->bindValue (':Id_Parcours', $p);
		$res->bindValue (':date_parc', $datesaisie);
		$res->bindValue (':Dateparc_1', $datesaisie);
		$res->bindValue (':Id_Visiteur', $idvisiteur) ;
		$res->bindValue (':ordre', $j+1);
		$res->bindValue (':chemin', $tabparcours[$j][2]);
		$res->bindValue (':Id_Spectacle', $tabparcours[$j][0]);
		$res->bindValue (':heure_seance', $tabparcours[$j][1]);
		$res->bindValue (':Id_visite', $idvisite);
		$res->bindValue (':Id_seance', $id_seance['Id_seance']);
		$res->execute();
	}

	public function selectallparcours($datesaisie,$idvisiteur, $idvisite)
	{
		$req = "SELECT Id_Parcours from parcours
        where date_parc='".$datesaisie. "' and Id_Visiteur =".$idvisiteur. " and Id_visite=".$idvisite.";";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesParcours = $res->fetchAll();
		return $lesParcours;
	}

	public function selectalletape($datesaisie,$idvisiteur,$Id_Parcours,$idvisite)
	{
		$req = "SELECT ordre, spectacle.Id_Spectacle, spectacle.libelle, etape.heure_seance, chemin, tps_spectacle, tps_attente, immersif 
        from etape
        inner join spectacle on etape.Id_Spectacle=spectacle.Id_Spectacle
        inner join seance on seance.Id_Spectacle=spectacle.Id_Spectacle and
        etape.heure_seance=seance.heure_seance and etape.date_parc=seance.date_parc inner join programme on spectacle.Id_Spectacle = programme.Id_Spectacle
        where etape.date_parc='".$datesaisie."' and Id_Visiteur =" . $idvisiteur." and Id_Parcours=".$Id_Parcours." and programme.date_parc='".$datesaisie."' and Id_visite=".$idvisite." order by ordre;";
		$res = PDOpuyDuFou::$monPdo->query($req);
		$lesEtapes = $res->fetchAll();
		return $lesEtapes;
	}

	public function ajoutervisite($idvisiteur,$datesaisie,$pass,$idvisite)
	{
		$req = "insert into visite
		(Id_visiteur, date_parc, pass, Id_visite) values
		(:Id_visiteur, :date_parc,:pass, :Id_visite)";

		$res = PDOpuyDuFou::$monPdo->prepare($req);

		$res->bindValue (':Id_visiteur', $idvisiteur);
		$res->bindValue (':date_parc', $datesaisie);
		$res->bindValue (':pass', $pass);
		$res->bindValue (':Id_visite', $idvisite+1);

		$res->execute();
	}

	public function ajouterselection($idvisiteur,$datesaisie,$spectacleId, $idvisite)
	{
		$req = "insert into selection
		(Id_spectacle, Id_visiteur, date_parc, Id_visite) values
		(:Id_spectacle, :Id_visiteur,:date_parc, :Id_visite)";

		$res = PDOpuyDuFou::$monPdo->prepare($req);

		$res->bindValue (':Id_spectacle', $spectacleId);
		$res->bindValue (':Id_visiteur', $idvisiteur);
		$res->bindValue (':date_parc', $datesaisie);
		$res->bindValue (':Id_visite', $idvisite);

		$res->execute();
	}

	public function ajouterSpectacle($titre, $Duree)
	{
		$req = "INSERT INTO spectacle (libelle, tps_spectacle) VALUES (:libelle, :tps_spectacle)";

		$res = PDOpuyDuFou::$monPdo->prepare($req);

		$res->bindParam(':libelle', $titre);
		$res->bindParam(':tps_spectacle', $Duree);
		$res->execute();
	}

	public function getidvisite($idvisiteur,$datesaisie)
	{
		$req = "SELECT MAX(Id_visite) AS idvisite 
        from visite
		where date_parc='".$datesaisie."' and Id_visiteur =" . $idvisiteur."";
		$res = PDOpuyDuFou::$monPdo->query($req);
        $id_visite = $res->fetch();
		return $id_visite['idvisite'];
	}

	public function getlesvisites($idvisiteur){
		$req = "SELECT * 
        from visite
		where Id_visiteur =" . $idvisiteur."";
		$res = PDOpuyDuFou::$monPdo->query($req);
        $LesVisites = $res->fetchAll();;
		return $LesVisites;
	}

	public function delUnparcours($idvisiteur, $datesaisie, $idvisite,$idparcours){
		$req="delete from etape where Id_Visiteur =" . $idvisiteur." and date_parc='".$datesaisie."' and Id_visite=".$idvisite." and Id_parcours = ".$idparcours." ;";
		$res = PDOpuyDuFou::$monPdo->exec($req);

		$req="delete from parcours where Id_Visiteur =".$idvisiteur." and date_parc='".$datesaisie."' and Id_visite=".$idvisite." and Id_parcours = ".$idparcours.";";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}

	public function parcourschoisi($idvisiteur, $datesaisie, $idvisite,$idparcours){
		$req="delete from etape where Id_Visiteur =" . $idvisiteur." and date_parc ='".$datesaisie."' and Id_visite =".$idvisite." and Id_parcours != ".$idparcours." ;";
		$res = PDOpuyDuFou::$monPdo->exec($req);

		$req="delete from parcours where Id_Visiteur =".$idvisiteur." and date_parc ='".$datesaisie."' and Id_visite =".$idvisite." and Id_parcours != ".$idparcours.";";
		$res = PDOpuyDuFou::$monPdo->exec($req);
	}

	public function delvisite($idvisite, $idvisiteur, $datesaisie){
		$req="delete from etape where Id_Visiteur =" . $idvisiteur." and date_parc='".$datesaisie."' and Id_visite=".$idvisite." ;";
		$res = PDOpuyDuFou::$monPdo->exec($req);

		$req="delete from parcours where Id_Visiteur =".$idvisiteur." and date_parc='".$datesaisie."' and Id_visite=".$idvisite.";";
		$res = PDOpuyDuFou::$monPdo->exec($req);

		$req="delete from selection where Id_Visiteur =".$idvisiteur." and date_parc='".$datesaisie."' and Id_visite=".$idvisite.";";
		$res = PDOpuyDuFou::$monPdo->exec($req);

		$req="delete from visite where Id_visiteur =".$idvisiteur." and date_parc='".$datesaisie."' and Id_visite=".$idvisite.";";
		$res = PDOpuyDuFou::$monPdo->exec($req);

	}

	public function modifselection($idvisiteur, $datesaisie, $spectacleId, $idvisite){

		$req="delete from selection where Id_Visiteur =".$idvisiteur." and date_parc='".$datesaisie."' and Id_visite=".$idvisite.";";
		$res = PDOpuyDuFou::$monPdo->exec($req);

		$req = "insert into selection
		(Id_spectacle, Id_visiteur, date_parc, Id_visite) values
		(:Id_spectacle, :Id_visiteur,:date_parc, :Id_visite)";
	
		$res = PDOpuyDuFou::$monPdo->prepare($req);

		$res->bindValue (':Id_spectacle', $spectacleId);
		$res->bindValue (':Id_visiteur', $idvisiteur);
		$res->bindValue (':date_parc', $datesaisie);
		$res->bindValue (':Id_visite', $idvisite);

		$res->execute();
	}


	
}
