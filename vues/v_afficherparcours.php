<?php

$_distances = array();
foreach ($lesDistances as $distance)
    {
    $_distances[$distance['Id_Spectacle']][$distance['Id_Spectacle_1']] = $distance['distance_km_'];
    $_distances[$distance['Id_Spectacle_1']][$distance['Id_Spectacle']] = $distance['distance_km_'];
    }
?>