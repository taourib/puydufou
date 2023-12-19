<?php

// $action : variable d'aiguillage
$action = $_REQUEST['action'];

switch ($action) 
{
    case 'Visite':
        include("vues/v_visite.php");
        break;

    case 'selectiondate':
        include("vues/v_selectiondate.php");
        break;

    case 'selectionspectacle':
        if (!empty($_POST['date'])) {
            $date = $_POST['date'];
            $lesSpectacles = $pdo->getLesSpectacle();
            include("vues/v_selectionspectacle.php");
        }
        break;

    case 'confirmcreationvisite':
        if (isset($_GET['date'], $_SESSION['Id_profil'], $_POST['spectacles'])) {
            // Récupérez la date et l'id du visiteur
            $datesaisie = $_GET['date']; // Réassigner la valeur correcte
            $idvisiteur = $_SESSION['Id_profil'];
            $spectacles = $_POST['spectacles'];
            $pass = 0;

            $idvisite = $pdo->getidvisite($idvisiteur, $datesaisie);
            $pdo->ajoutervisite($idvisiteur, $datesaisie, $pass, $idvisite);
            $idvisite = $pdo->getidvisite($idvisiteur, $datesaisie);

            foreach ($spectacles as $spectacleId) {
                $pdo->ajouterselection($idvisiteur, $datesaisie, $spectacleId, $idvisite);
            }

            // Suppression des parcours avant recalcul
            $pdo->delparcours($idvisiteur, $datesaisie, $idvisite);

            include("controleurs/c_algo.php");

            // Fin de la permutation si ok on insère le parcours et les étapes en bdd
            // Incrémentation num parcours.
            if ($ok == 1) {
                $p++;

                $idvisite = $pdo->getidvisite($idvisiteur, $datesaisie);

                $pdo->ajouterparcours($p, $datesaisie, $idvisiteur, $idvisite);

                for ($j = 0; ($j < $nbspectacles); $j++) {
                    $id_seance = $pdo->idseance($tabparcours, $j, $datesaisie);
                    $pdo->ajouterseance($p, $datesaisie, $idvisiteur, $j, $tabparcours, $idvisite, $id_seance);
                }
            }
        }
        $lesParcours = $pdo->selectallparcours($datesaisie, $idvisiteur, $idvisite);
        include 'vues/v_parcours.php';
        break;

    case 'consulterparcours':
        $idvisiteur = $_SESSION['Id_profil'];
        $LesVisites = $pdo->getlesvisites($idvisiteur);
        include("vues/v_liste_visites.php");
        break;

    case 'afficherparcours':
        $idvisite = $_POST['idVisite'];
        $idvisiteur = $_SESSION['Id_profil'];
        $datesaisie = $_POST['date'];

        include("controleurs/c_algo.php");

        if ($idvisite !== null) {
            $lesParcours = $pdo->selectallparcours($datesaisie, $idvisiteur, $idvisite);
            include("vues/v_parcours.php");
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Vous n'avez pas de parcours pour cette date')
                    window.location.href='index.php?uc=Parcours&action=Visite';
                    </SCRIPT>");
        }
        break;

    case 'suprrimerparcours':
        $idparcours = $_POST['idparcours'];
        $idvisite = $_POST['idVisite'];
        $idvisiteur = $_SESSION['Id_profil'];
        $datesaisie = $_POST['date'];

        include("controleurs/c_algo.php");

        $pdo->delUnparcours($idvisiteur, $datesaisie, $idvisite, $idparcours);

        echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Le parcours a bien été supprimé')
                window.location.href='index.php?uc=Parcours&action=consulterparcours';
                </SCRIPT>");
        break;

    case 'modifiervisite':
        $date = $_POST['date'];
        $idVisite = $_POST['idVisite'];
        $lesSpectacles = $pdo->getLesSpectacle();
        include("vues/v_modifselectionspectacle.php");
        break;

    case 'confirmmodifiervisite':
        // Récupérez la date et l'id du visiteur
        $datesaisie = $_POST['date'];
        $idvisiteur = $_SESSION['Id_profil'];
        $spectacles = $_POST['spectacles'];
        $idvisite = $_POST['idVisite'];
        $pass = 0;

        foreach ($spectacles as $spectacleId) {
            $pdo->modifselection($idvisiteur, $datesaisie, $spectacleId, $idvisite);
        }

        // Suppression des parcours avant recalcul
        $pdo->delparcours($idvisiteur, $datesaisie, $idvisite);

        include("controleurs/c_algo.php");

        // Fin de la permutation si ok on insère le parcours et les étapes en bdd
        // Incrémentation num parcours.
        if ($ok == 1) {
            $p++;

            $idvisite = $pdo->getidvisite($idvisiteur, $datesaisie);

            $pdo->ajouterparcours($p, $datesaisie, $idvisiteur, $idvisite);

            for ($j = 0; ($j < $nbspectacles); $j++) {
                $id_seance = $pdo->idseance($tabparcours, $j, $datesaisie);
                $pdo->ajouterseance($p, $datesaisie, $idvisiteur, $j, $tabparcours, $idvisite, $id_seance);
            }
        }

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Les spectacles ont bien été modifiés')
        window.location.href='index.php?uc=Parcours&action=consulterparcours';
        </SCRIPT>");
        break;

    case 'validerparcours':
        $idparcours = $_POST['idparcours'];
        $idvisite = $_POST['idVisite'];
        $idvisiteur = $_SESSION['Id_profil'];
        $datesaisie = $_POST['date'];

        include("controleurs/c_algo.php");

        $pdo->parcourschoisi($idvisiteur, $datesaisie, $idvisite, $idparcours);

        echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Tous les autres parcours ont été supprimés')
                window.location.href='index.php?uc=Parcours&action=consulterparcours';
                </SCRIPT>");
        break;

    case 'supprimervisite':
        $idvisite = $_POST['idVisite'];
        $idvisiteur = $_SESSION['Id_profil'];
        $datesaisie = $_POST['date'];

        include("controleurs/c_algo.php");

        $pdo->delvisite($idvisite, $idvisiteur, $datesaisie);

        echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('La visite a été supprimée')
                window.location.href='index.php?uc=Parcours&action=consulterparcours';
                </SCRIPT>");
        break;
}
