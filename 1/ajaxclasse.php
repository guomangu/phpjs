<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    // $HashsManager = new HashsManager( $bdd );
    $EtresManager = new EtresManager($bdd);

    // ========

    $loleur = htmlspecialchars( trim($_GET['lol']));

    // $hash = $HashsManager->getHashByGroupe($loleur);
    // var_dump($hash);
    $desk = $EtresManager->getDeskByIdEtre($loleur);

    if(empty($desk)){
        exit;
    }

    // var_dump($desk);

    echo('
        <p>'.$desk.'</p>
    ')

    // foreach ($hash as $key => $value) {
    //     echo('
    //         <p class="elehash">
    //             '.$value->getNomHash().'
    //         </p>
    //     ');
    // }

// for ($i=0; $i < 10; $i++) { 
//     echo('
//         <p onClick="classeur2(1);" class="elehash">
//             lol
//         </p>
//     ');
// }

?>