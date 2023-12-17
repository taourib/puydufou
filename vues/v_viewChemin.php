<div id="AffichageListe">
    <?php
    foreach ($lesChemin as $unChemin) {
        $Id_spectacle = $unChemin['Id_spectacle'];
        $Id_spectacle_1 = $unChemin['Id_spectacle_1'];
        $distance_km_ = $unChemin['distance_km_'];
        $libelle = $unChemin['libelle'];
        $libelle2 = $unChemin['libelle2'];
        ?>
        <ul class="affichageListe">
            <li>Spectacle 1: <?php echo $libelle ?></li>
            <li>Spectacle 2: <?php echo $libelle2 ?></li>
            <li>Distance: <?php echo $distance_km_ ?></li>
            <?php if ($Id_profil == 'Administrateur') { ?>
                <li>
                    <a href="index.php?uc=chemin&spectacle=<?php echo $Id_spectacle ?>&spectacle2=<?php echo $Id_spectacle_1 ?>&distance=<?php echo $distance_km_ ?>&action=modifChemin">
                        <img src="images/pen-to-square-solid.svg" alt="modif spectacle">
                    </a>
                </li>
                <?php if($Id_spectacle != 0)
                {?>
                    <li>
                        <a href="index.php?uc=chemin&spectacle=<?php echo $Id_spectacle ?>&spectacle2=<?php echo $Id_spectacle_1 ?>&action=supprChemin">
                            <img src="images/trash-solid.svg" alt="suppr spectacle">
                        </a>
                    </li>
              <?php  
                }                    
            } ?>
        </ul>
    <?php
    }
    ?>
</div>

