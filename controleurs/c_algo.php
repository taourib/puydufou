<?php
// Chargement des distances dans le tableau $_distances
// Chargement de la symétrie au cas où ce ne soit pas fait en base
$lesDistances = $pdo->distancespec();
$_distances = array();
foreach ($lesDistances as $distance) {
    $_distances[$distance['Id_Spectacle']][$distance['Id_Spectacle_1']] = $distance['distance_km_'];
    $_distances[$distance['Id_Spectacle_1']][$distance['Id_Spectacle']] = $distance['distance_km_'];
}

// Vitesse du visiteur
$vitesse = $pdo->getvitessevisiteur($idvisiteur);

// Heures du parc
$planning = $pdo->getheureparc($datesaisie);

// Chargement des spectacles sélectionnés et de leur durée et attente
$lesSpectaclesSelectionnes = $pdo->selectionspec($datesaisie, $idvisiteur, $idvisite);
$sel = $duree = $attente = array(); // Initialisation des tableaux
foreach ($lesSpectaclesSelectionnes as $selection) {
    $ids = $selection['Id_Spectacle'];
    $sel[] = $ids;
    $duree[$ids] = $selection['tps_spectacle'];
    $attente[$ids] = $selection['tps_attente'];
}

// Calcul du nombre de spectacles
$nbspectacles = count($sel);

// Calcul des permutations dans $tabper
$tabper = array();
permutations($sel);
$nbpermut = count($tabper);

// Nombre de parcours $p à zéro
$p = 0;

// Boucle sur les permutations
for ($i = 0; $i < $nbpermut; $i++) {
    $a = 0; // Point précédent = 0 (entrée sortie)
    $heureparcours = $planning['heure_ouverture']; // Heure début initialisée à l'heure d'ouverture du parc
    $ok = 1; // Flag ok mis à 1
    $tabparcours = []; // Table des étapes du parcours initialisée

    // Boucle sur les spectacles de la permutation si toujours ok
    for ($j = 0; ($j < $nbspectacles and $ok == 1); $j++) {
        $s = $tabper[$i][$j]; // Spectacle concerné
        $b = $s;

        // Recherche du chemin jusqu'à $b = $s
        $dist = 0;
        $cheminarray = array();

        [$dist, $cheminarray] = calc_chemin($a, $b); // Calcul du chemin

        $tempschemin = ceil($dist / $vitesse * 60); // En minutes
        $chem = implode(",", $cheminarray); // Récupération du chemin en chaîne de caractères
        $heureparcours = add_time($heureparcours, $tempschemin); // Ajout du temps de parcours
        list($hours, $minutes) = explode(':', $attente[$s]);
        $att = ((60 * $hours) + $minutes);
        $heureparcours = add_time($heureparcours, $att); // Ajout de l'attente

        // Recherche de la séance la plus tôt
        $seance = $pdo->premseance($s, $heureparcours, $datesaisie);

        if ($seance) { // Séance trouvée
            if ($seance['immersif'] <> 0) {
                $heureparcours = max($heureparcours, $seance['heure_seance']);
            } else {
                $heureparcours = $seance['heure_seance'];
            }

            // Heure suivante du parcours
            // Calcul du chemin pour sortir
            $dists = 0;
            $cheminarrays = array();
            [$dists, $cheminarrays] = calc_chemin($b, 0);
            $tempssortie = ceil($dists / $vitesse * 60);

            // Calcul de la durée
            list($hours, $minutes) = explode(':', $duree[$s]);
            $dur = ((60 * $hours) + $minutes);
            $heureparcours = add_time($heureparcours, $dur); // Ajout à l'heure du parcours

            if (add_time($heureparcours, $tempssortie) <= $planning['heure_fermeture']) {
                // Test si dépassement
                $a = $s; // On conserve le spectacle précédent
                // Stockage du spectacle de la séance et du chemin
                $parcours = [$s, $seance['heure_seance'], $chem];
                $tabparcours[] = $parcours;
            } else {
                // Trop tard.
                $ok = 0;
            }
        } else {
            // Pas de séance trouvée
            $ok = 0;
        }
    }
}
?>
