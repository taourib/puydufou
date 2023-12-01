<div id="planning">
<?php
	
foreach($lesSpectacle as $unSpectacle) 
{
	$id = $unSpectacle['Id_spectacle'];
	$nom = $unSpectacle['libelle'];
	$tps_spectacle = $unSpectacle['tps_spectacle'];
	?>	
	<ul class="affichagePlanning">
			<li>Spectacle :<?php echo $nom ?></li>
			<li>Temps :<?php echo $tps_spectacle ?></li>
			<li><a href="index.php?uc=connexion&spectacle=<?php echo $id ?>&action=spectacle"> 
			<img src="images/pen-to-square-solid.svg" alt="view Seance"> </li></a>
			
	</ul>
			
<?php		
}

?>
</div>

<style>
	
#planning{
  padding: 100px;
	display: inline-block;
}

#planning li{
	list-style-type: none;
	list-style-image:none;
	display:inline-block; 
	width: auto;
    text-align:center;
    height:20px;
    font: 1em "Trebuchet MS",Arial,sans-serif ;
}

#planning ul{
	box-shadow: 0px 0px 22px -5px rgba(0,0,0,0.75);
	margin: 20px;
}
.affichagePlanning {
	background: white ;
	padding: 20px;
	color: white;
	text-decoration: none;
}

.affichagePlanning li {
	background: #FFFFFF ;
	padding: 5px;
	color: black;
	text-decoration: none;
	margin: 0;
}

.affichagePlanning li a {
	background: #e74c3c;
    text-decoration: none;
    color: white;
    padding: 7px;
}

.affichagePlanning .valider{
	background: #2ecc71;
}
</style>

