<div class= "table">
	<table>
		<thead>
			<tr>
				<th>date</th>
				<th>heure d'ouverture</th>
				<th>heure de fermeture</th>
				
				<?php if($Id_profil == "Administrateur")
				{?>
					<th>Modifier la journée</th>
					<th>supprimer la journée</th>
				<?php } ?>
				
			</tr>
		</thead>
		<tbody>
		<?php
		foreach($lesDates as $uneDate) 
		{ ?>
			<tr>
			
			<td width="5%"><?php echo $uneDate['date_parc'] ?></td>
			<td width="10%"><?php echo $uneDate['heure_ouverture'] ?></td>
			<td width="10%"><?php echo $uneDate['heure_fermeture'] ?></td>
			<?php if($Id_profil == "Administrateur")
			{?>
				<td width="5%"><a href="index.php?uc=parc&date=<?php echo $uneDate['date_parc'] ?>&action=modifJourParc"> <img src="images/pen-to-square-solid.svg" alt="modif Parc"></a></td>
				<td width="5%"><a href="index.php?uc=parc&date=<?php echo $uneDate['date_parc'] ?>&action=supprJourParc"> <img src="images/trash-solid.svg" alt="suppr Parc"></a></td>
			<?php } ?>
			</tr>

	<?php } ?>
		</tbody>
	</table>
</div>