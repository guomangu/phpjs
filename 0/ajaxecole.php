<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );

    // ========

    $loleur = htmlspecialchars( trim($_GET['lol']));

    $etre = $EtresManager->getParentByIdGroupe($loleur);
    // var_dump($etre);

    if(empty($etre)){
        exit;
    }

    $etre = array_unique($etre,SORT_REGULAR);
    shuffle($etre);


    foreach ($etre as $key => $value) {
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

// for ($i=0; $i < 20; $i++) { 
//     echo(
//         '<div onClick="
//         ecolier2(1);
//         ecolier0(1);
//         ecolier(1);
//         classeur(1);
//         classeur2(1);
//         " class="minbloc1 imageback">
//             <div class="suminbloc1">
//                 <p class="txtbloc1">lol</p>
//             </div>
//         </div>
//         '
//     );
// }
    
?>
