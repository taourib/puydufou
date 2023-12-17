<div id="AffichageListe">
<?php
	
foreach($lesSpectacle as $unSpectacle) 
{
	$id = $unSpectacle['Id_spectacle'];
	$nom = $unSpectacle['libelle'];
	$tps_spectacle = $unSpectacle['tps_spectacle'];
	?>	
	<ul class="affichageListe">
			<li>Spectacle :<?php echo $nom ?></li>
			<li>Temps :<?php echo $tps_spectacle ?></li>
			<li><a href="index.php?uc=seance&Id_spectacle=<?php echo $id ?>&action=seance"> 
			<img src="images/eye-regular.svg" alt="view spectacle"></a></li>
			<?php if ($Id_profil == 'Administrateur'){ ?><li><a href="index.php?uc=planning&spectacle=<?php echo $id ?>&action=modifSpectacle"> 
			<img src="images/pen-to-square-solid.svg" alt="modif spectacle"></a></li>
      <li><a href="index.php?uc=planning&spectacle=<?php echo $id ?>&action=supprSpectacle"> 
			<img src="images/trash-solid.svg" alt="suppr spectacle"></a></li><?php } ?>
	</ul>
			
<?php		
}

?>
</div>