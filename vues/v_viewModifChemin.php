<div id="add_trajet">
    <fieldset>
        <legend>Modif trajet</legend>
        <form action="index.php?uc=chemin&action=traitModifChemin" method="post">
            <p>
                <label>Spectacle 1 : </label>
                <select id="Spectacle_1" name="Spectacle_1" value="<?php echo $spectacleOriginelle1 ?>">
                    <?php foreach ($lesSpectacle as $unSpectacle) {
                        $Id_spectacle = $unSpectacle['Id_spectacle'];
                        $libelle = $unSpectacle['libelle'];
                        ?>
                        <option value="<?php echo $Id_spectacle ?>"><?php echo $libelle ?></option>
                    <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>Spectacle 2 : </label>
                <select id="Spectacle_2" name="Spectacle_2" value="<?php echo $spectacleOriginelle2 ?>">
                    <?php foreach ($lesSpectacle as $unSpectacle) {
                        $Id_spectacle = $unSpectacle['Id_spectacle'];
                        $libelle = $unSpectacle['libelle'];
                        ?>
                        <option value="<?php echo $Id_spectacle ?>" <?php echo ($Id_spectacle == $spectacleOriginelle2) ? 'selected' : ''; ?>>
                            <?php echo $libelle ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>distance : </label>
                <input type="double" name="distance" value="<?php echo $distanceOriginelle ?>" required>
            </p>
            <p>
                <input type="hidden" name="spectacleOriginelle1" value="<?php echo $spectacleOriginelle1 ?>" required>
            </p>
            <p>
                <input type="hidden" name="spectacleOriginelle2" value="<?php echo $spectacleOriginelle2 ?>" required>
            </p>
            <p>
                <input type="submit" value="Modifier">
            </form>
    </fieldset>
</div>