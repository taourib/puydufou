<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sélection des Spectacles</title>
</head>
<body>
    <h1>Sélection des Spectacles</h1>

    <form action="index.php?uc=Parcours&action=confirmmodifiervisite" method="post">
        <h2>Liste des Spectacles :</h2>

        <?php foreach ($lesSpectacles as $unSpectacle): ?>
            <div>
                <input type="checkbox" id="spectacle_<?php echo $unSpectacle['Id_spectacle']; ?>" name="spectacles[]" value="<?php echo $unSpectacle['Id_spectacle']; ?>">
                <label for="spectacle_<?php echo $unSpectacle['Id_spectacle']; ?>"><?php echo $unSpectacle['libelle']; ?></label>
            </div>
        <?php endforeach; ?>

        <br>
        <input type="hidden" name="date" value="<?php echo $date; ?>">
        <input type="hidden" name="idVisite" value="<?php echo $idVisite; ?>">
        <button type="submit">Valider</button>
    </form>
</body>
</html>
