<div id="add_trajet">
		<fieldset>
			<legend>Modif seance</legend>
			<form action="index.php?uc=seance&Id_spectacle=<?php echo $Id_spectacle ?>&Id_seance=<?php echo $laSeance['Id_seance']?>&date_parc=<?php echo $laSeance['date_parc'] ?>&action=traitModifSeance" method="post">
				<p>
					<label>Date parc : </label>
					<a><?php echo $date_parc ?></a>
				</p>
				<p>
					<label>Heure seance	: </label>
					<input type="time" name="heure_seance" value="<?php echo $laSeance["heure_seance"] ? date('H:i', strtotime($laSeance["heure_seance"])) : ''; ?>" required>
				</p>
				<p>
					<label>Immersif  : </label>
					<select id="immersif" name="immersif">
						<option value="0" <?php if ($laSeance['immersif'] == 0) echo 'selected'; ?>>0</option>
    					<option value="1" <?php if ($laSeance['immersif'] == 1) echo 'selected'; ?>>1</option>
					</select>
				</p>
				<p>
				<input type="hidden" name="Id_spectacle" value="<?php echo $Id_spectacle ?>" required>

				</p>
				<p>
				<input type="submit" value="Ajouter" class="button">
			</form>
		</fieldset>
	</div>



