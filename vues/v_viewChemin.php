<div id="planning">
    <?php
    foreach ($lesChemin as $unChemin) {
        $Id_spectacle = $unChemin['Id_spectacle'];
        $Id_spectacle_1 = $unChemin['Id_spectacle_1'];
        $distance_km_ = $unChemin['distance_km_'];
        $libelle = $unChemin['libelle'];
        $libelle2 = $unChemin['libelle2'];
        ?>
        <ul class="affichagePlanning">
            <li>Spectacle 1: <?php echo $libelle ?></li>
            <li>Spectacle 2: <?php echo $libelle2 ?></li>
            <li>Distance: <?php echo $distance_km_ ?></li>
            <?php if ($Id_profil == 'Administrateur') { ?>
                <li>
                    <a href="index.php?uc=chemin&spectacle=<?php echo $Id_spectacle ?>&spectacle2=<?php echo $Id_spectacle_1 ?>&distance=<?php echo $distance_km_ ?>&action=modifChemin">
                        <img src="images/pen-to-square-solid.svg" alt="modif spectacle">
                    </a>
                </li>
                <li>
                    <a href="index.php?uc=chemin&spectacle=<?php echo $Id_spectacle ?>&spectacle2=<?php echo $Id_spectacle_1 ?>&action=supprChemin">
                        <img src="images/trash-solid.svg" alt="suppr spectacle">
                    </a>
                </li>
            <?php } ?>
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

