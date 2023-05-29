<?php

    //========

    include 'includes.php';
    include 'connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );
    // $SitesManager = new SitesManager( $bdd );
    // $HashsManager = new HashsManager( $bdd );
    // $ComsManager = new ComsManager( $bdd );

    $pse = htmlspecialchars( trim($_POST['pse']));
    $pas = htmlspecialchars( trim($_POST['pas']));

    // $pse = "aluligu";
    // $pas = "aluligu";

    //========

    if (empty($pse) OR empty($pas)) {
        exit;
    }

    $compte = $EtresManager->seco($pse,$pas);

    if (empty($compte)) {
        exit;
    }

    $idG = $compte['idGroupeSaveEtre'];

    $tabIdEtre = $EtresManager->recupSave($idG);
    // var_dump($tabIdEtre);

    foreach ($tabIdEtre as $key => $value) {
        foreach ($value as $key => $value2) {
            $tabEtre[] = $EtresManager->getEtreById($value2);
        }
    }

    // var_dump($tabEtre);

    // =========

    echo('
        <br>
        <br>
        <hr style="background-color: white;" />
        <div id="infosaveur">
            <p onClick="alerter4()">
                '.$compte["nomSave"].'
            </p>
            <p id="444">'.$compte["idEtre"].'</p>
        </div>

        <hr style="background-color: white;" />

        <div id="ecoles">'
    );

    foreach ($tabEtre as $key => $value) {
        echo("
            <p onClick='ecolier0(".$value->getIdEtre().")' id='4'>
                ".$value->getNomEtre()."
            </p>
        ");
    };

    echo('</div>');
        
    

?>
