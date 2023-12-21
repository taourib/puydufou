	<div id="add_trajet">
		<fieldset>
			<legend>Inscription</legend>
			<form action="index.php?uc=connexion&action=confirmInscription" method="post">
				<p>
					<label>Nom : </label>
					<input type="text" name="nomClient" required>
				</p>
				<p>
					<label>Prénom : </label>
					<input type="text" name="prenomClient" required>
				</p>
				<p>
					<label>Mail : </label>
					<input type="email" name="mailClient" required>
				</p>
				<p>
				<p>
					<label>Mot de passe : </label>
					<input type="password" name="mdpClient" required>
				</p>
				<input type="submit" value="Valider" class="button">
			</form>
		</fieldset>
	</div>
