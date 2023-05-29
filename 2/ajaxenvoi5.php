<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $ComsManager = new ComsManager( $bdd );

    $yo = $_POST["yo"];
    $nom = $_POST["txt"];

    // $yo = 1;
    // $nom = "ca fais relativiser";

    if (empty($yo) or empty($nom)) {
        exit;
    }

    //=========

    $ComsManager->addCom( 
        new Com( 
            array(
                'nomCom' => $nom,
                'idGroupeCom' => $yo,
            )
        )
    );