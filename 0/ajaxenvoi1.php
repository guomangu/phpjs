<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );

    $po = htmlspecialchars( trim($_POST["po"]));
    $nom = htmlspecialchars( trim($_POST["txt"]));
    $desk = htmlspecialchars( trim($_POST["txt2"]));


    // $po = 3;
    // $nom = "magie10";

    if (empty($po) or empty($nom) or empty($desk)) {
        exit;
    }

    // ========

    $idNewEtre = $EtresManager->addEtre( 
        new Etre( 
            array(
                'nomEtre' => $nom,
            )
        )
    );
    
    $EtresManager->linkFamByIdsEtre($po,$idNewEtre);

    $EtresManager->addDesk($idNewEtre,$desk);

    // =======

    $etre = $EtresManager->getEtreById($idNewEtre);

    // $lol = $etre->getSite();
    
    // if (!empty($lol)) {
    //     foreach ($lol as $key => $value) {
    //         $lol2 = $value->getIdGroupeHash();
    //     }
    // }else {
    //     $lol2 = "";
    // }

    echo(
        '
        <p onClick="ale()" class="sutres2">
            ('.$idNewEtre.')
        </p>
        <p class="sutres">
            '.$etre->getNomEtre().'
        </p>
        <a class="myBut myOtherBut3" onClick="alerter10()"></a>
        <p id="po" style="display:none;">'.$etre->getIdEtre().'</p>
        '
    );

    if(empty($etre)){
        exit;
    }

    echo('
        <script>
            ecolier('.$etre->getGroupeParent().');
            ecolier2('.$etre->getGroupeEnfant().');
            classeur('.$idNewEtre.');
            classeur2('.$etre->getGroupeSite().');
            ecoliersup("'.$etre->getNomEtre().'",'.$etre->getIdEtre().');
            ecolier2sup("'.$etre->getNomEtre().'",'.$etre->getIdEtre().');
        </script>
    ');
?>