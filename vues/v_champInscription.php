	<div id="inscrire">
		<fieldset>
			<legend>Inscription</legend>
			<form action="index.php?uc=connexion&action=confirmInscription" method="post">
				<p>
					<label>Nom : </label>
					<input type="text" name="nomClient">
				</p>
				<p>
					<label>Prénom : </label>
					<input type="text" name="prenomClient">
				</p>
				<p>
					<label>Mail : </label>
					<input type="text" name="mailClient">
				</p>
				<p>
				<p>
					<label>Mot de passe : </label>
					<input type="password" name="mdpClient">
				</p>
				<input type="submit" name="Valider">
			</form>
		</fieldset>
	</div>




	<style>
	#inscrire{
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh; /* Set the height to 100% of the viewport height */
		}

	legend{
		font-size: 1.5rem;
	}

	form{
		font-size: 1.4rem;
		text-align: right;
	}
	</style>

