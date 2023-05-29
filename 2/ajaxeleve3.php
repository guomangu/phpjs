<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $ComsManager = new ComsManager( $bdd );

    // ========

    $loleur = htmlspecialchars( trim($_GET['lol']));

    $com = $ComsManager->getComByGroupe($loleur);
    // var_dump($com);
    // var_dump($com);

    // if(!empty($com)){
    //     $idGcom = $com[0]->getIdGroupeCom();
    // }else {
    //     $idGcom = "";
    // }
    // =======

    echo('
        <br>

        <svg id="cinco" onClick="alerter15()" class="bi bi-plus poni" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
        </svg>

        <br>

        <p id="yo" style="display:none;">'.$loleur.'</p>
    ');

    if(empty($com)){
        exit;
    }

    foreach ($com as $key => $value) {
        echo('
            <hr>
            <div class="elecom"><p>'.$value->getNomCom().'</p></div>
        ');
    }

    // for ($i=0; $i < 10; $i++) { 
    //     echo('
    //         <hr>
    //         <a class="myBut" onClick="alerter2(3)"></a>
    //         <div class="elecom"><p>bojour oooooooo ooooo ooooo ooooo ooooo ooooo o2</p></div>
    //     ');
    // }

    echo('
        <br>
    ');
?>