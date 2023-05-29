<?php
    include 'includes.php';
    include 'connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );
    // $SitesManager = new SitesManager( $bdd );
    // $HashsManager = new HashsManager( $bdd );
    // $ComsManager = new ComsManager( $bdd );

    $pse = htmlspecialchars( trim($_POST['pse']));
    $pas = htmlspecialchars( trim($_POST['pas']));
    $desk = htmlspecialchars( trim($_POST['desk10']));

    // $pse = "testeru";
    // $pas = "testeru";
    // $desk = "testeru";

    // ========addetre

    $idNewEtre = $EtresManager->addEtre( 
        new Etre( 
            array(
                'nomEtre' => $pse,
            )
        )
    );
    
    $EtresManager->linkFamByIdsEtre2(109,$idNewEtre);

    $EtresManager->addDesk($idNewEtre,$desk);

    // ========addsave

    $EtresManager->addSaveur($pse,$pas,$idNewEtre);

    // ========echo

    echo($idNewEtre);


?>