<?php
// $action : variable d'aiguillage
$action = $_REQUEST['action'];
if (empty($_SESSION['Id_profil'])) {
    $Id_profil = 'NULL';
} else {
    $Id_profil = $_SESSION['Id_profil'];
}

switch ($action) {
    case ('seance'):
        {
            $Id_spectacle=$_GET['Id_spectacle'];
            $lesSeance=$pdo->getLesSeanceById_spectacle($Id_spectacle);
            $lesDates=$pdo->getOuvertureParc();

            if ($Id_profil == 'Administrateur')
            {
                include("vues/v_addSeance.php");
            }	

            include("vues/v_viewSeance.php");
            break;
        }

    case ('traitAddSeance'):
        {
            $date_parc=$_POST['date_parc'];
            $heure_seance=$_POST['heure_seance'];
            $immersif=$_POST['immersif'];
            $Id_spectacle=$_GET['Id_spectacle'];
                if(0==$pdo->seanceExisteById_spectacleAndHeure_seanceAndDate_parc($Id_spectacle,$heure_seance,$date_parc)){
                    $newId_seance = intval($pdo->getMaxId_seanceOnSeanceById_spectacleAndDate_parc($Id_spectacle,$date_parc))+1;                  
                    $pdo->ajouterSeance($date_parc, $Id_spectacle, $heure_seance,$immersif,$newId_seance);
                }else{
                    ?><a> Il existe déjà une séance pour ce spectacle à cette date et cette heure</a><?php
                }
            
            $lesSeance=$pdo->getLesSeanceById_spectacle($Id_spectacle);
            
            if ($Id_profil == 'Administrateur')
            {
                    $lesDates=$pdo->getOuvertureParc();
                    include("vues/v_addSeance.php");
            }	

            include("vues/v_viewSeance.php");
            break;
        }

    case ('supprSeance'):
        {
            $Id_seance= $_GET['Id_seance'];
            $Id_spectacle=$_GET['Id_spectacle'];
            $date_parc=$_GET['date_parc'];

            $pdo->delSeanceById_seanceAndId_spectacle($Id_seance,$Id_spectacle,$date_parc);

            $lesSeance=$pdo->getLesSeanceById_spectacle($Id_spectacle);
            if ($Id_profil == 'Administrateur')
            {
                $lesDates=$pdo->getOuvertureParc();
                include("vues/v_addSeance.php");
            }	
            include("vues/v_viewSeance.php");
            break;
        }

    case ('modifSeance'):
        {
            $Id_seance= $_GET['Id_seance'];
            $Id_spectacle=$_GET['Id_spectacle'];
            $date_parc=$_GET['date_parc'];

            $laSeance = $pdo->getInfoSeanceById_seanceAndId_spectacleAnddate_parc($Id_seance,$Id_spectacle,$date_parc);
            include("vues/v_modifSeance.php");
            break;
        }

        case ('traitModifSeance'):
        {
            $Id_seance= $_GET['Id_seance'];
            $Id_spectacle=$_GET['Id_spectacle'];
            $date_parc=$_GET['date_parc'];
            $heure_seance=$_POST['heure_seance'];
            $immersif=$_POST['immersif'];
            if(0==$pdo->ancienSeanceExisteById_spectacleAndHeure_seanceAndDate_parc($Id_spectacle,$heure_seance,$date_parc,$Id_seance)){
                $pdo->modifSeance($date_parc, $Id_spectacle, $heure_seance,$Id_seance,$immersif);
                $lesSeance=$pdo->getLesSeanceById_spectacle($Id_spectacle);
                $lesDates=$pdo->getOuvertureParc();

                if ($Id_profil == 'Administrateur')
                {
                    include("vues/v_addSeance.php");
                }	

                include("vues/v_viewSeance.php");
            }else{
                ?><a> Il existe déjà une séance pour ce spectacle à cette date et cette heure</a><?php
                $laSeance = $pdo->getInfoSeanceById_seanceAndId_spectacleAnddate_parc($Id_seance,$Id_spectacle,$date_parc);
                include("vues/v_modifSeance.php");
            }
            break;
        }
}
