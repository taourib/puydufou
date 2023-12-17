<div id="add_trajet">
		<fieldset>
			<legend>add trajet</legend>
			<form action="index.php?uc=chemin&action=traitAddChemin" method="post">
				<p>
					<label>Spectacle 1 : </label>
					<select id="Spectacle_1" name="Spectacle_1">
					<?php foreach($lesSpectacle as $unSpectacle){
						$Id_spectacle = $unSpectacle['Id_spectacle'];
						$libelle = $unSpectacle['libelle']; 
						?>	  
						<option value =<?php echo $Id_spectacle ?>><?php echo $libelle ?></option>
					<?php
					}
					?>
					</select>
				</p>
				<p>
					<label>Spectacle 2 : </label>
					<select id="Spectacle_2" name="Spectacle_2">
					<?php foreach($lesSpectacle as $unSpectacle){
						$Id_spectacle = $unSpectacle['Id_spectacle'];
						$libelle = $unSpectacle['libelle']; 
						?>	  
						<option value =<?php echo $Id_spectacle ?>><?php echo $libelle ?></option>
					<?php
					}
					?>
					</select>
				</p>
				<p>
					<label>distance  : </label>
					<input type="double" name="distance" required>
				</p>
				<p>
				<input type="submit" value="Ajouter" class="button">
			</form>
		</fieldset>
	</div>



