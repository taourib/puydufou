<?php

include "connexionbd.php";

function CheminCourt()
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select count(*) from spectacle");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $nbspectacle = $req->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

?>