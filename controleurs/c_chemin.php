<?php
// $action : variable d'aiguillage
$action = $_REQUEST['action'];
if (empty($_SESSION['Id_profil'])) {
    $Id_profil = 'NULL';
} else {
    $Id_profil = $_SESSION['Id_profil'];
}
switch ($action) {
    case ('chemin'):
        {
            if ($Id_profil == "Administrateur") {
                $lesSpectacle = $pdo->getLesSpectacle();
                include("vues/v_addChemin.php");
            }

            $lesChemin = $pdo->getLesChemin();
            include("vues/v_viewChemin.php");

            break;
        }

    case ('traitAddChemin'):
        {
            $spectacle = $_POST['Spectacle_1'];
            $spectacle2 = $_POST['Spectacle_2'];
            $distance = $_POST['distance'];
            if ($Id_profil == "Administrateur") {
                $lesSpectacle = $pdo->getLesSpectacle();
                include("vues/v_addChemin.php");
            }

            $nbtrajet = 0;
            $nbtrajet += $pdo->Trajet1avec2($spectacle, $spectacle2);

            if ($spectacle == $spectacle2) {
                echo '<a> les deux spectacle sont les même </a>';
            } elseif ($nbtrajet == 0) {
                $pdo->ajouterTrajet($spectacle, $spectacle2, $distance);
                $pdo->ajouterTrajet($spectacle2, $spectacle, $distance);
            } else {
                echo '<a> le chemin exsiste déjà </a>';
            }

            $lesChemin = $pdo->getLesChemin();
            include("vues/v_viewChemin.php");

            break;
        }

    case ('supprChemin'):
        {
            $spectacle = $_REQUEST['spectacle'];
            $spectacle2 = $_REQUEST['spectacle2'];
            $pdo->delTrajetByDoubleID($spectacle, $spectacle2);
            $lesChemin = $pdo->getLesChemin();
            if ($Id_profil == "Administrateur") {
                $lesSpectacle = $pdo->getLesSpectacle();
                include("vues/v_addChemin.php");
            }
            include("vues/v_viewChemin.php");

            break;
        }

    case ('modifChemin'):
        {
            $spectacleOriginelle1 = $_REQUEST['spectacle'];
            $spectacleOriginelle2 = $_REQUEST['spectacle2'];
            $distanceOriginelle = $_REQUEST['distance'];
            $lesSpectacle = $pdo->getLesSpectacle();
            include("vues/v_viewModifChemin.php");
            break;
        }

        case ('traitModifChemin'):
            {
                $Spectacle_1 = $_POST['Spectacle_1'];
                $Spectacle_2 = $_POST['Spectacle_2'];
                $distance = $_POST['distance'];
                $spectacleOriginelle1 = $_POST['spectacleOriginelle1'];
                $spectacleOriginelle2 = $_POST['spectacleOriginelle2'];

                $pdo->modifTrajet($Spectacle_1, $Spectacle_2, $distance,$spectacleOriginelle1,$spectacleOriginelle2);
                $pdo->modifTrajet($Spectacle_2, $Spectacle_1, $distance,$spectacleOriginelle2,$spectacleOriginelle1);

                if ($Id_profil == "Administrateur") {
                    $lesSpectacle = $pdo->getLesSpectacle();
                    include("vues/v_addChemin.php");
                }
    
                $lesChemin = $pdo->getLesChemin();
                include("vues/v_viewChemin.php");
                break;
            }
}
