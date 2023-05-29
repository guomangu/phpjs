<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $HashsManager = new HashsManager( $bdd );

    // ========

    $loleur = htmlspecialchars( trim($_GET['lol']));

    $hash = $HashsManager->getHashByGroupe($loleur);
    // var_dump($hash);

    // =======

    echo('
        <svg id="quatro" onClick="alerter14()" class="bi bi-plus poni" style="position:fixed;" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
        </svg>
    ');

    if(empty($hash)){
        exit;
    }
    shuffle($hash);

    foreach ($hash as $key => $value) {
        echo('
            <p onClick="elevage3('.$value->getIdGroupeCom().');" class="elehash2">
                '.$value->getNomHash().'
            </p>
        ');

        if ($key == 0) {
            echo('
                <script>
                    elevage3('.$value->getIdGroupeCom().');
                </script>
            ');
        }
    }

    // for ($i=0; $i < 20; $i++) { 
    //     echo('
    //         <p onClick="elevage3(1);" class="elehash2">
    //             lollolol
    //             <a class="myBut myOtherBut" onClick="alerter2(3)">
    //             </a>
    //         </p>
    //     ');
    // }

    
?>