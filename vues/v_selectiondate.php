<?php
$idvisiteur = $_SESSION['Id_profil'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sélection de la date</title>
</head>
<body>
    <h1>Sélection de la date</h1>

    <form action="index.php?uc=Parcours&action=selectionspectacle" method="post">
        <label for="date">Sélectionnez une date :</label>
        <input type="date" id="date" name="date" required min="<?= date('Y-m-d'); ?>">
        <br>
        <button type="submit">Suivant</button>
    </form>
</body>
</html>
