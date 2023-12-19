<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Visites</title>
    <style>
        li {
            margin-bottom: 20px;
        }

        form {
            display: inline;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Liste des Visites Programmées</h1>

    <ul>
        <?php foreach ($LesVisites as $uneVisite): ?>
            <li>
                Visite n° <?php echo $uneVisite['Id_visite']; ?> du : <?php echo $uneVisite['date_parc']; ?>

                <form action="index.php?uc=Parcours&action=afficherparcours" method="post">
                    <input type="hidden" name="idVisite" value="<?php echo $uneVisite['Id_visite']; ?>">
                    <input type="hidden" name="date" value="<?php echo $uneVisite['date_parc']; ?>">
                    <button type="submit">Voir les parcours</button>
                </form>

                <form action="index.php?uc=Parcours&action=supprimervisite" method="post">
                    <input type="hidden" name="idVisite" value="<?php echo $uneVisite['Id_visite']; ?>">
                    <input type="hidden" name="date" value="<?php echo $uneVisite['date_parc']; ?>">
                    <button type="submit">Supprimer la visite</button>
                </form>

                <form action="index.php?uc=Parcours&action=modifiervisite" method="post">
                    <input type="hidden" name="idVisite" value="<?php echo $uneVisite['Id_visite']; ?>">
                    <input type="hidden" name="date" value="<?php echo $uneVisite['date_parc']; ?>">
                    <button type="submit">Modifier les spectacles choisis pour cette visite</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
