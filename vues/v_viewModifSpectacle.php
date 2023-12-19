<div id="add_trajet">
    <fieldset>
        <legend>Modif Spectacle</legend>
        <form action="index.php?uc=planning&action=traitModifSpectacle" method="post">
            <p>
                <label>Spectacle  : </label>
                <input type="text" name="libelle" value="<?php echo $Id_spectacle['libelle'] ?>" required>
            </p>
            <p>
                <label>Durée  : </label>
                <input type="time" name="tps_spectacle" value="<?php echo  $Id_spectacle['tps_spectacle'] ?>" required>
            </p>
            <p>
                <input type="hidden" name="Id_spectacle" value="<?php echo  $Id_spectacle['Id_spectacle'] ?>" required>
            </p>
            <p>
                <input type="submit" value="Modifier">
            </form>
    </fieldset>
</div>
