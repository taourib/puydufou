<?php
// $action : variable d'aiguillage
$action = $_REQUEST['action'];
if (empty($_SESSION['Id_profil'])) {
    $Id_profil = 'NULL';
} else {
    $Id_profil = $_SESSION['Id_profil'];
}

switch ($action) {
    case ('viewParc'):
        {
            if ($Id_profil == 'Administrateur')
			{
				include("vues/v_viewAddParc.php");
			}	
            $lesDates=$pdo->getOuvertureParc();
            include("vues/v_viewParc.php");
            break;
        }

    case ('traitAddParc'):
        {
            $date = $_POST['date'];
            $heure_ouverture = $_POST['heure_ouverture'];
            $heure_fermeture = $_POST['heure_fermeture'];

            $nb = $pdo->countdate_parcByDate($date);

            if($nb != 0)
            {
                echo "cette date a déjà été ajouté";
            }else{
                $pdo->ajouterDateParc($date, $heure_ouverture, $heure_fermeture);
            }

            include("vues/v_viewAddParc.php");
            $lesDates=$pdo->getOuvertureParc();
            include("vues/v_viewParc.php");
            break;
        }

    case ('supprJourParc'):
        {
            $date = $_GET['date'];

            $pdo->delFromByDate_parc('parcours',$date);
            $pdo->delFromByDate_parc('etape',$date);
            $pdo->delFromByDate_parc('seance',$date);
            $pdo->delFromByDate_parc('selection',$date);
            $pdo->delFromByDate_parc('programme',$date);
            $pdo->delFromByDate_parc('visite',$date);
            $pdo->delFromByDate_parc('parc',$date);

            if ($Id_profil == 'Administrateur')
			{
				include("vues/v_viewAddParc.php");
			}	
            $lesDates=$pdo->getOuvertureParc();
            include("vues/v_viewParc.php");
            break;
        }

    case ('modifJourParc'):
        {
            $date = $_GET['date'];
            $lesheure=$pdo->getHeureByDate_Parc($date);
            include("vues/v_ModifJourParc.php");
            break;
        }

        case ('traitModifJourParc'):
        {
            $date_parc=$_GET['date'];
            $heure_ouverture=$_POST['heure_ouverture'];
            $heure_fermeture=$_POST['heure_fermeture'];
            $pdo->modifParcByDate_parc($date_parc, $heure_ouverture, $heure_fermeture);
            if ($Id_profil == 'Administrateur')
			{
				include("vues/v_viewAddParc.php");
			}	
            $lesDates=$pdo->getOuvertureParc();
            include("vues/v_viewParc.php");
            break;
        }
}
