<div class= "table">
	<table>
		<thead>
			<tr>
				<th>Date parc</th>
				<th>Heure séance</th>
				<th>Immersif</th>
				
				<?php if($Id_profil == "Administrateur")
				{?>
					<th>Modifier la seance</th>
					<th>Supprimer la seance</th>
				<?php } ?>
				
			</tr>
		</thead>
		<tbody>
		<?php
		foreach($lesSeance as $uneSeance) 
		{ ?>
			<tr>
			
			<td width="5%"><?php echo $uneSeance['date_parc'] ?></td>
			<td width="10%"><?php echo $uneSeance['heure_seance'] ?></td>
			<td width="10%"><?php echo $uneSeance['immersif'] ?></td>
			<?php if($Id_profil == "Administrateur")
			{?>
				<td width="5%"><a href="index.php?uc=seance&Id_seance=<?php echo $uneSeance['Id_seance']?>&Id_spectacle=<?php echo $Id_spectacle ?>&date_parc=<?php echo $uneSeance['date_parc'] ?>&action=modifSeance"> <img src="images/pen-to-square-solid.svg" alt="modif Parc"></a></td>
				<td width="5%"><a href="index.php?uc=seance&Id_seance=<?php echo $uneSeance['Id_seance']?>&Id_spectacle=<?php echo $Id_spectacle ?>&date_parc=<?php echo $uneSeance['date_parc'] ?>&action=supprSeance"> <img src="images/trash-solid.svg" alt="suppr Parc"></a></td>
			<?php } ?>
			</tr>

	<?php } ?>
		</tbody>
	</table>
</div>