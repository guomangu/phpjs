<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $SitesManager = new SitesManager( $bdd );
    $HashsManager = new HashsManager($bdd);

    $lo = htmlspecialchars( trim($_POST["lo"]));
    $nom = htmlspecialchars( trim($_POST["txt"]));

    // $lo = 1;
    // $nom = "top";

    if (empty($lo) or empty($nom)) {
        exit;
    }

    //=========
    // var_dump($po);
    // var_dump($nom);
    // var_dump($adresse);

    $idNewHash = $HashsManager->addHash( 
        new Hash( 
            array(
                'nomHash' => $nom,
            )
        )
    );
    // var_dump($idNewSite);

    $lo2 = $SitesManager->getIdGroupeHashByIdSite($lo);
    // var_dump($po2);

    $HashsManager->linkHashByEtre($lo2,$idNewHash);

    // =========


?>