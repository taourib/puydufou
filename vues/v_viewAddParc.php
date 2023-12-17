<div id="add_trajet">
    <fieldset>
        <legend>Modif Jour Parc</legend>
        <form action="index.php?uc=parc&action=traitAddParc" method="post">
            <p>
                <label>date parc : </label>
                <a><input type="date" name="date" required></a>
            </p>
            <p>
                <label>heure d'ouverture : </label>
                <input type="time" name="heure_ouverture" required>
            </p>
            <p>
                <label>heure de fermeture : </label>
                <input type="time" name="heure_fermeture" required>
            </p>
            <p>
                <input type="submit" value="Ajouter" class="button">
            </form>
    </fieldset>
</div>
