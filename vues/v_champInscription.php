	<div id="inscrire">
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
				<input type="submit" value="Valider">
			</form>
		</fieldset>
	</div>




	<style>
		#inscrire {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		legend {
			font-size: 1.5rem;
		}

		form {
			font-size: 1.4rem;
			text-align: right;
		}

		input {
			margin-bottom: 1%;
		}

		input[type="submit"] {
			transition: background-color 0.3s, color 1.0s;
			width: 25%;
   			margin-right: 11%;

		}

		input[type="submit"]:hover {
			background-color: red;
			color: white;
			/* Change text color on hover, adjust as needed */
		}
	</style>