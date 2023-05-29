<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );

    // ========


    $etre = $EtresManager->getEtreByRAND();
    // var_dump($etre);
    
    // $lol = $etre->getSite();
    
    // if (!empty($lol)) {
    //     foreach ($lol as $key => $value) {
    //         $lol2 = $value->getIdGroupeHash();
    //     }
    // }else {
    //     $lol2 = "";
    // }

    // $lol2 = $lol->getIdGroupeHash();
    // var_dump($etre);
    // var_dump($lol);

    echo(
        '
        <p onClick="ale()" class="sutres2">
            ('.$etre->getIdEtre().')
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
            classeur('.$etre->getIdEtre().');
            classeur2('.$etre->getGroupeSite().');
            ecoliersup("'.$etre->getNomEtre().'",'.$etre->getIdEtre().');
            ecolier2sup("'.$etre->getNomEtre().'",'.$etre->getIdEtre().');
        </script>
    ');

    

    // for ($i=0; $i < 1; $i++) { 
    //     echo(
    //         '
    //         <p class="sutres2">
    //             (lol)
    //         </p>
    //         <p class="sutres">
    //             loleur
    //         </p>
    //         <a class="myBut myOtherBut3" onClick="alerter2(1)"></a>
    //         '
    //     );
    // }
    
?>
