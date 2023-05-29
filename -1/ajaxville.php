<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );

    // ========

    $loleur = htmlspecialchars( trim($_GET['lol']));
    // var_dump($loleur);

    $etreMunu = $EtresManager->getEtreMenuByIdEtre($loleur);
    // var_dump($etreMunu);
    // foreach ($etreMunu as $key => $value) {
        // $lol = $value->getSite();
        // var_dump($lol);
    // }
    // foreach ($lol as $key => $value2) {
    //     $lol2 = $value2->getHash();
    //     // var_dump($lol2);
    // }
    // foreach ($lol2 as $key => $value3) {
    //     // var_dump($value3->getCom());
    // }

    if(empty($etreMunu)){
        exit;
    }
    
    foreach ($etreMunu as $key => $value) {
        echo(
            '<a
            onClick="
            ecolier0('.$value->getIdEtre().');
            "
            ><p>'.$value->getNomEtre().'</p></a>'
        );

        if ($key == 0) {
            echo('
                <script>
                    ecolier0('.$value->getIdEtre().');
                </script>
            ');
        }
    }
    

    // ========

    // for ($i=0; $i < 20; $i++) { 
    //     echo(
    //         '<a
    //         onClick="
    //         ecolier(1);
    //         ecolier0(1);
    //         ecolier2(1);
    //         classeur(1);
    //         classeur2(1);
    //         "
    //         ><p onClick="ecolier(4)" id="4">Derniers moments</p></a>'

    //     );
    // };
?>