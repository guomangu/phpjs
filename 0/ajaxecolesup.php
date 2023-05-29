<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );

    // ========

    $loleur = htmlspecialchars( trim($_GET['lol']));
    $id = htmlspecialchars( trim($_GET['id']));

    // $loleur = "Harry Potter";
    // $id = 3;

    // var_dump($loleur);
    // var_dump($id);

    $etre = $EtresManager->getParentByNomEtre($loleur,$id);
    // var_dump($etre);

    if(empty($etre)){
        exit;
    }

    $etre = array_unique($etre,SORT_REGULAR);
    shuffle($etre);


    echo('
    <div class="minbloc1 imageback" style="width:1px;" ></div>
    ');

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
?>
