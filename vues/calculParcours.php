<?php

include_once 'fonctions_parcours.php';
include "connexionbd.php";

echo "Calcul des parcours";
echo "<br>";

/* saisie */
ob_implicit_flush ();
$datesaisie='2023-10-13';
$idvisiteur =5;

$pdo->exec('SET NAMES utf8');

// suppression des parcours avant recalcul
$req="delete from etape where Id_Visiteur =" . $idvisiteur." and date_parc='".$datesaisie."';";
$result = $pdo->query($req);

$req="delete from parcours where Id_Visiteur =".$idvisiteur." and date_parc='".$datesaisie. "';";
$result = $pdo->query($req);

// chargement des distances dans le tableau $_distances
// chargement de la symétrie au cas où ce ne soit pas fait en base
$_distances = array();
$req = 'SELECT Id_Spectacle, Id_Spectacle_1, distance_km_ from trajet';
foreach ($pdo->query($req) as $distance)
    {
    $_distances[$distance['Id_Spectacle']][$distance['Id_Spectacle_1']] = $distance['distance_km_'];
    $_distances[$distance['Id_Spectacle_1']][$distance['Id_Spectacle']] = $distance['distance_km_'];
    }
// vitesse du visiteur
$req = "SELECT vitesse from visiteur where Id_visiteur =" . $idvisiteur.";";
$result = $pdo->query($req);
$visiteur = $result->fetch();
$vitesse =$visiteur['vitesse'];

// heures du parc
$req = "SELECT heure_ouverture, heure_fermeture from parc where date_parc='".$datesaisie."'";
$result = $pdo->query($req);
$planning = $result->fetch();

// chargement des spectacles sélectionnés et de leur durée et attente
$req = "SELECT spectacle.Id_Spectacle, tps_spectacle, tps_attente 
from selection 
inner join spectacle on selection.Id_Spectacle=spectacle.Id_Spectacle 
inner join programme on selection.Id_Spectacle=programme.Id_Spectacle 
where programme.date_parc= '".$datesaisie."' and selection.date_parc= '".$datesaisie."' and Id_Visiteur =" . $idvisiteur. ";";

foreach ($pdo->query($req) as $selection)
        {
            $ids=$selection['Id_Spectacle'];
            $sel[]=$ids;
            $duree [$ids] =$selection ['tps_spectacle'];
            $attente [$ids] =$selection ['tps_attente'];
        }

// calcul nombre de spectacles
$nbspectacles =count ($sel);
echo "nb spectacles ".$nbspectacles.": ".implode(',',$sel);
echo "<br/>";

// calcul des permutations dans $tabper

$tabper= array();
permutations($sel);
$nbpermut =count($tabper);

echo "nb permutation ".$nbpermut;
ob_flush();

// initialisation de la barre de progression
//Initialize (50, 60, 200, 30, '#000000','#FFCC00','#006699');

// nombre de parcours $p à zero
$p=0;

// boucle sur les permutations
    for ($i=0; $i<$nbpermut; $i++)
    {
    //ProgressBar (ceil(($i/$nbpermut) *100)); // barre de progression
    $a=0; // point précédent = 0 entrée sortie
    $heureparcours=$planning['heure_ouverture']; // heure début initialisée à l'heure d'ouverture du parc
    $ok=1; // flag ok mis à 1
    $tabparcours= []; // table des étapes du parcours initialisée

    //boucle sur les les spectacles de la permutation si toujours ok
    for ($j=0; ($j<$nbspectacles and $ok == 1); $j++)
    {
    $s=$tabper [$i] [$j]; // spectacle concerné
    $b = $s;

    //recherche du chemin jusqu'à $b = $s
    $dist=0;
    $cheminarray=array();

    [$dist, $cheminarray] =calc_chemin ($a, $b); // calcul du chemin

    $tempschemin=ceil ($dist/$vitesse*60); // en minutes
    $chem=implode (",", $cheminarray); // recupération du chemin en chaine de caractères
    $heureparcours=add_time ($heureparcours, $tempschemin); // ajout du temps de parcours
    list ($hours, $minutes) = explode(':', $attente [$s]);
    $att = ((60* $hours) + $minutes );
    $heureparcours=add_time ($heureparcours, $att); // ajout de l'attente
    // recherche de la séance la plus tôt
    $req = "SELECT immersif, heure_seance from seance where Id_Spectacle = ".$s." and heure_seance >= '".$heureparcours."' and date_parc = '". $datesaisie ."' order by heure_seance limit 1; ";
    $result = $pdo->query($req);
    $seance = $result->fetch();

        if ($seance) // séance trouvée
        {
        if ($seance ['immersif'] <> 0)
            {$heureparcours=max ($heureparcours, $seance ['heure_seance']);
        }
        else
            {$heureparcours=$seance ['heure_seance']; }
        // heure suivante du parcours

        // calcul du chemin pour sortir
        $dists=0;
        $cheminarrays=array();
        [$dists, $cheminarrays] =calc_chemin($b, 0);
        $tempssortie=ceil($dists/$vitesse*60);
        // calcul duree
        list ($hours, $minutes) = explode(':', $duree [$s]);
        $dur = ((60* $hours) + $minutes );
        $heureparcours=add_time($heureparcours, $dur); // ajout à l'heure du parcours
        if (add_time ($heureparcours,$tempssortie) <= $planning ['heure_fermeture'])
        // test si dépassement
        {
            $a=$s; // on conserve le spectacle précédent
            // stockage du spectacle de la séance et du chemin

            $parcours=[$s, $seance['heure_seance'], $chem];
            $tabparcours[] = $parcours;
        }
            else // trop tard.
            {$ok=0;}
            }
            else // pas de séance trouvée
            {$ok=0; }
        }
            // fin de la permutation si ok on insère le parcours et les étapes en bdd
            // incrémentation num parcours.
            if ($ok==1)
            {
            $p++;

            $req = "select Id_visite from visite where id_visiteur = ".$idvisiteur." and date_parc ='".$datesaisie."';";
            $result = $pdo->query($req);
            $idvisite = $result->fetch();

            $res = $pdo->prepare('insert into parcours
            (Id_parcours, date_parc, Id_visiteur, Id_visite) values
            (:Id_parcours, :date_parc,:Id_visiteur, :Id_visite)');
            $res->bindValue (':Id_parcours', $p);
            $res->bindValue (':date_parc', $datesaisie);
            $res->bindValue (':Id_visiteur', $idvisiteur);
            $res->bindValue (':Id_visite', $idvisite['Id_visite']);
            $res->execute();


            for ($j=0; ($j<$nbspectacles); $j++)
            {

                $req = "select Id_seance from seance where Id_Spectacle = ".$tabparcours [$j][0]." and heure_seance ='".$tabparcours [$j][1]."' and date_parc = '". $datesaisie ."';";
                $result = $pdo->query($req);
                $id_seance = $result->fetch();

            $res = $pdo->prepare('insert into etape
            (date_parc_1, Id_Parcours, date_parc, Id_Visiteur, ordre, chemin, Id_Spectacle,heure_seance, Id_visite, Id_seance)
            values
            (:Dateparc_1, :Id_Parcours, :date_parc, :Id_Visiteur, :ordre, :chemin, :Id_Spectacle, :heure_seance, :Id_visite, :Id_seance)');
            $res->bindValue (':Id_Parcours', $p);
            $res->bindValue (':date_parc', $datesaisie);
            $res->bindValue (':Dateparc_1', $datesaisie);
            $res->bindValue (':Id_Visiteur', $idvisiteur) ;
            $res->bindValue (':ordre', $j+1);
            $res->bindValue (':chemin', $tabparcours [$j] [2]);
            $res->bindValue (':Id_Spectacle', $tabparcours [$j] [0]);
            $res->bindValue (':heure_seance', $tabparcours [$j] [1]);
            $res->bindValue (':Id_visite', $idvisite['Id_visite']);
            $res->bindValue (':Id_seance', $id_seance['Id_seance']);
            $res->execute();
            }
        }
    }
// fin des permutations, combien de parcours possibles
echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>";
echo "nombre de parcours ".$p;
echo "<br>";

// Affichage des parcours
    echo "visiteur : ".$idvisiteur." date : ".$datesaisie;
    echo "<br>";
    $req = "SELECT Id_Parcours from parcours
        where date_parc='".$datesaisie. "' and Id_Visiteur =".$idvisiteur. ";";
    foreach ($pdo->query($req) as $parcours)
    {
        echo "------------------Parcours ".$parcours ['Id_Parcours'];
        echo "<br>";
        echo "Heure ouverture parc ".$planning [ 'heure_ouverture'];
        echo "<br>";
        
        $req = "SELECT ordre, spectacle.Id_Spectacle, spectacle.libelle, etape.heure_seance, chemin, tps_spectacle, tps_attente, immersif 
        from etape
        inner join spectacle on etape.Id_Spectacle=spectacle.Id_Spectacle
        inner join seance on seance.Id_Spectacle=spectacle.Id_Spectacle and
        etape.heure_seance=seance.heure_seance and etape.date_parc=seance.date_parc inner join programme on spectacle.Id_Spectacle = programme.Id_Spectacle
        where etape. date_parc='".$datesaisie."' and Id_Visiteur =" . $idvisiteur." and Id_Parcours=".$parcours['Id_Parcours']." order by ordre;";

        $ordre = 1;

        foreach ($pdo->query($req) as $etape)
        {

        if($ordre!=$etape['ordre'])
            {$b=$s;}
        $s = $etape['Id_Spectacle'];

        if ($etape['ordre'] ==1)
            {$a=0;}
        $dist=0;
        $cheminarray=array();
        [$dist, $cheminarray] =calc_chemin($a, $s);
        $tempschemin=ceil($dist/$vitesse*60);

        echo " ----> Etape ".$etape['ordre']." Spectacle ".$s." nom ".$etape['libelle'];
        echo "<br>";
        echo "Temps de marche ".$tempschemin. " minutes par le chemin".$etape['chemin'];
        echo "<br>";

        echo "Attente de ".date('i', strtotime($etape['tps_attente']))."minutes";
        echo "<br>";

        if ($etape['immersif'] == 0)
            {echo "Début spectacle à " . $etape['heure_seance'] . " durée " . $etape['tps_spectacle'];
            echo "<br>";
            }
            else
            {echo "Spectacle immersif de ".$etape['immersif']." à ". $etape['heure_seance'];
            echo "<br>";}
        if ($etape['ordre'] ==$nbspectacles)
        {$dist=0;
        $cheminarray=array();
        [$dist, $cheminarray] =calc_chemin($s, 0);
        $tempschemin=ceil($dist/$vitesse*60);
        echo "temps de marche vers la sortie ".$tempschemin." minutes par le chemin ".implode (",", $cheminarray);
        echo "<br>";
        echo "Heure fermeture parc ".$planning ['heure_fermeture'];
        echo "<br>";
        }
        echo "<br>";

        if($ordre!=$etape[$ordre])
        {$a=$b;}
        $ordre=$etape['ordre'];
    }
}
?>