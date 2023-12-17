<?php
/* debut fontions */
/* les permutations d'un tableau */

function permutations ($items, $perms = array())
{
    global $tabper;
    if (empty ($items))
    {
        $tabper []=$perms;
    }
    else{
        for ($i = count ($items) - 1; $i >= 0; --$i)
        {
            $newitems = $items;
            $newperms = $perms;
            list($foo) = array_splice($newitems, $i, 1);
            array_unshift($newperms, $foo);

            permutations($newitems, $newperms);
        }
    }
}

// Fonction qui calcule le chemin le plus court entre deux points dans un graphe pondéré
function calc_chemin($a, $b)
{
    global $_distances;  // Utilisation de la variable globale $_distances

    $S = array();  // Le chemin le plus proche avec son parent et son poids
    $Q = array();  // Les nœuds de gauche sans le chemin le plus proche

    // Initialisation des distances avec une valeur élevée (99999)
    foreach (array_keys($_distances) as $val) {
        $Q[$val] = 99999;
    }

    $Q[$a] = 0;  // La distance du point de départ à lui-même est 0

    // Boucle principale pour trouver le chemin le plus court
    while (!empty($Q)) {
        // Sélection du nœud avec la distance minimale
        $min = array_search(min($Q), $Q);

        // Arrêt si le nœud atteint la destination
        if ($min == $b) {
            break;
        }
        // Mise à jour des distances des voisins du nœud courant
        foreach ($_distances[$min] as $key => $val) if (!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) 
            {
                $Q[$key] = $Q[$min] + $val;
                $S[$key] = array($min, $Q[$key]);
            }

        // Suppression du nœud courant de la liste des nœuds non traités
        unset($Q[$min]);
    }

    // Reconstruction du chemin à partir des informations stockées dans $S
    $path = array();
    $pos = $b;

    while ($pos != $a) {
        $path[] = $pos;
        $pos = $S[$pos][0];
    }

    $path[] = $a;
    $path = array_reverse($path);

    // Retourne le poids total du chemin et le chemin lui-même
    return [$S[$b][1], $path];
}

/* ajout de minutes à une heure */
function add_time ($time, $plusMinutes) {
    $endTime = strtotime ("+{$plusMinutes} minutes", strtotime ($time));
    return date('H:i:s', $endTime);
}

/*function Initialize ($gauche, $haut, $largeur, $hauteur, $bord_col, $txt_col, $bg_col)
{
    $tailletxt=$hauteur-10;
    echo '<div id="pourcentage" style="position: absolute; top: ' . $haut;
    echo '; left: ' . $gauche;
    echo '; width: ' . $largeur. 'px';
    echo '; height: ' . $hauteur. 'px; border: 1px solid'.$bord_col.';font-family:Tahoma;font-weight:bold';
    echo ';font-size:'.$tailletxt.'px;color:'.$txt_col.';z-index:1;text-align:center;">0%</div>';
    echo '<div id="progrbar" style="position:absolute;top:'.($haut+1); //+1
    echo ';left:'.($gauche+1);//+1
    echo ';width:0px';
    echo ';height:'.$hauteur.'px';
    echo ';background-color:'.$bg_col.';z-index:0;"></div>';
}

function ProgressBar($indice){
    echo "\n<script>";
    echo "document.getElementById(\"pourcentage\").innerHTML='".$indice."%';";
    echo "document.getElementById('progrbar').style.widht=".($indice*2).";\n";
    echo "</script>";
    ob_flush();
}*/
/* fin fonctions */
?>