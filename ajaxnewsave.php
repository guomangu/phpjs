<?php
    include 'includes.php';
    include 'connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );
    // $SitesManager = new SitesManager( $bdd );
    // $HashsManager = new HashsManager( $bdd );
    // $ComsManager = new ComsManager( $bdd );

    $po = htmlspecialchars( trim($_POST['po']));
    $pse = htmlspecialchars( trim($_POST['pse']));
    $pas = htmlspecialchars( trim($_POST['pas']));
    $id = htmlspecialchars( trim($_POST['id']));

    // $pse = "testeru";
    // $pas = "testeru";
    // $desk = "testeru";

    // ============

    $idGsave = $EtresManager->getIdGsaveByPsePas($pse,$pas,$id);

    $test = $EtresManager->testCorees($po,$idGsave);

    // var_dump($test);
    if($test == 1)
    {
        // var_dump('lol');
        $EtresManager->spprNewSave($po,$idGsave);
    }
    else
    {
        // var_dump('test');
        $EtresManager->addNewSave($po,$idGsave);

        $EtresManager->linkFamByIdsEtre($po,$id);
    }

    

    // =========

    $tabIdEtre = $EtresManager->recupSave($idGsave);
    // var_dump($tabIdEtre);

    foreach ($tabIdEtre as $key => $value) {
        foreach ($value as $key => $value2) {
            $tabEtre[] = $EtresManager->getEtreById($value2);
        }
    }

    foreach ($tabEtre as $key => $value) {
        echo("
            <p onClick='ecolier0(".$value->getIdEtre().")' id='4'>
                ".$value->getNomEtre()."
            </p>
        ");
    };

?>

