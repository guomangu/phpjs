<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );

    // ========

    $loleur = htmlspecialchars( trim($_GET['lol']));
    // var_dump($loleur);

    $etre = $EtresManager->getEnfantByIdGroupe($loleur);
    // var_dump($etre);
    // var_dump($etre);

    if(empty($etre)){
        exit;
    }

    $etre = array_unique($etre,SORT_REGULAR);
    shuffle($etre);


    foreach ($etre as $key => $value) {
        $uno = $value->getSite();

        echo(
            '<div onClick="
            ecolier0('.$value->getIdEtre().');
            " class="minbloc1 imageback">
                <div class="suminbloc1">
                    <p class="txtbloc1">'.$value->getNomEtre().'</p>
                </div>
            </div>
            '
        );
    }


// for ($i=0; $i < 10; $i++) { 
//     echo(
//         '
//         <div onClick="
//         ecolier(1);
//         ecolier0(1);
//         ecolier2(1);
//         classeur(1);
//         classeur2(1);
//         " class="minbloc2 imageback">
//             <div class="suminbloc1">
//                 <p class="txtbloc1">lol</p>
//             </div>
//         </div>
//         '
//     );
// }
    
?>
