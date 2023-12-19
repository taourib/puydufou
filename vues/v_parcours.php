<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Parcours</title>
    <style>
        .parcours-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .etape-container {
            margin-left: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Liste des Parcours</h1>

    <?php foreach ($lesParcours as $unParcours): ?>
        <div class="parcours-container">
            <h2>Parcours <?php echo $unParcours['Id_Parcours']; ?></h2>

            <?php
            $Id_Parcours = $unParcours['Id_Parcours'];
            $ordre = 1;
            $lesEtapes = $pdo->selectalletape($datesaisie, $idvisiteur, $Id_Parcours, $idvisite);
            
            foreach ($lesEtapes as $uneEtape):
                if ($ordre != $uneEtape['ordre']) {
                    $b = $s;
                }

                $s = $uneEtape['Id_Spectacle'];

                if ($uneEtape['ordre'] == 1) {
                    $a = 0;
                }

                $dist = 0;
                $cheminarray = array();
                [$dist, $cheminarray] = calc_chemin($a, $s);
                $tempschemin = ceil($dist / $vitesse * 60);
            ?>
            <div class="etape-container">
                <p>Étape <?php echo $uneEtape['ordre']; ?> - Spectacle : <?php echo $uneEtape['libelle']; ?></p>
                <p>Temps de marche : <?php echo $tempschemin; ?> minutes par le chemin <?php echo $uneEtape['chemin']; ?></p>
                <p>Attente : <?php echo $uneEtape['tps_attente']; ?> minutes</p>

                <?php if ($uneEtape['immersif'] == 0): ?>
                    <p>Début du spectacle à <?php echo $uneEtape['heure_seance']; ?>, durée <?php echo $uneEtape['tps_spectacle']; ?></p>
                <?php else: ?>
                    <p>Spectacle immersif de <?php echo $uneEtape['immersif']; ?> à <?php echo $uneEtape['heure_seance']; ?></p>
                <?php endif; ?>

                <?php if ($uneEtape['ordre'] == $nbspectacles): 
                    $dist = 0;
                    $cheminarray = array();
                    [$dist, $cheminarray] = calc_chemin($s, 0);
                    $tempschemin = ceil($dist / $vitesse * 60);?>
                    <p>Temps de marche vers la sortie : <?php echo $tempschemin; ?> minutes.</p>
                    <p>Heure de fermeture parc : <?php echo $planning['heure_fermeture']; ?></p>
                <?php endif; ?>
            </div>

            <?php
            if ($ordre != $uneEtape['ordre']) {
                $a = $b;
            }
            $ordre = $uneEtape['ordre'];
            ?>

            <?php endforeach; ?>

            <form action="index.php?uc=Parcours&action=suprrimerparcours" method="post">
                <input type="hidden" name="date" value="<?php echo $datesaisie; ?>">
                <input type="hidden" name="idVisite" value="<?php echo $idvisite; ?>">
                <input type="hidden" name="idparcours" value="<?php echo $unParcours['Id_Parcours']; ?>">
                <input type="submit" value="Supprimer ce parcours">
            </form>

            <form action="index.php?uc=Parcours&action=validerparcours" method="post">
                <input type="hidden" name="date" value="<?php echo $datesaisie; ?>">
                <input type="hidden" name="idVisite" value="<?php echo $idvisite; ?>">
                <input type="hidden" name="idparcours" value="<?php echo $unParcours['Id_Parcours']; ?>">
                <input type="submit" value="Valider ce parcours">
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>
