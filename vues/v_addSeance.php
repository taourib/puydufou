<div id="add_trajet">
		<fieldset>
			<legend>add seance</legend>
			<form action="index.php?uc=seance&Id_spectacle=<?php echo $Id_spectacle ?>&action=traitAddSeance" method="post">
				<p>
					<label>Date parc : </label>
					<select id="date_parc" name="date_parc">
					<?php foreach($lesDates as $uneDates){
						?>	  
						<option value =<?php echo $uneDates['date_parc'] ?>><?php echo $uneDates['date_parc'] ?></option>
					<?php
					}
					?>
					</select>
				</p>
				<p>
					<label>Heure seance	: </label>
					<input type="time" name="heure_seance" required>
				</p>
				<p>
					<label>Immersif  : </label>
					<select id="immersif" name="immersif">
						<option value =0>0</option>
						<option value =1>1</option>
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



