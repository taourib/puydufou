<div id="add_trajet">
    <fieldset>
        <legend>Ajouter un Spectacle</legend>
        <form action="index.php?uc=planning&action=traitAddSpectacle" method="post">
            <p>
                <label>titre Spectacle : </label>
                <a><input type="text" name="titre" required></a>
            </p>
            <p>
                <label>Durée du Spectacle : </label>
                <input type="time" name="Duree" required>
            </p>
            <p>
                <input type="submit" value="Ajouter" class="button">
            </form>
    </fieldset>
</div>
