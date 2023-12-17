<div id="add_trajet">
    <fieldset>
        <legend>Modif Jour Parc</legend>
        <form action="index.php?uc=parc&action=traitModifJourParc&date=<?php echo $date ?>" method="post">
            <p>
                <label>date parc : </label>
                <a><?php echo $date ?></a>
            </p>
            <p>
                <label>heure d'ouverture : </label>
                <input type="time" name="heure_ouverture" value="<?php echo $lesheure['heure_ouverture'] ?>" required>
            </p>
            <p>
                <label>heure de fermeture : </label>
                <input type="time" name="heure_fermeture" value="<?php echo $lesheure['heure_fermeture'] ?>" required>
            </p>
            <p>
                <input type="submit" value="Modifier" class="button">
            </form>
    </fieldset>
</div>
