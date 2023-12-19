<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sélection des Spectacles</title>
</head>
<body>
    <h1>Sélection des Spectacles</h1>

    <form action="index.php?uc=Parcours&action=confirmcreationvisite&date=<?php echo $date; ?>" method="post">
        <h2>Liste des Spectacles :</h2>

        <?php foreach ($lesSpectacles as $unSpectacle): ?>
            <input type="checkbox" id="spectacle_<?php echo $unSpectacle['Id_spectacle']; ?>" name="spectacles[]" value="<?php echo $unSpectacle['Id_spectacle']; ?>">
            <label for="spectacle_<?php echo $unSpectacle['Id_spectacle']; ?>"><?php echo $unSpectacle['libelle']; ?></label><br>
        <?php endforeach; ?>
        <br>
        <button type="submit">Valider</button>
    </form>
</body>
</html>
