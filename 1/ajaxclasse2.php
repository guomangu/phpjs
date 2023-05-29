<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $SitesManager = new SitesManager( $bdd );

    // ========

    $loleur = htmlspecialchars( trim($_GET['lol']));

    $site = $SitesManager->getSiteByGroupe2($loleur);
    // var_dump($site);

    // ========

    echo('
        <svg id="tres" onClick="alerter13()" class="bi bi-plus poni" style="position: fixed;" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
        </svg>
    ');

    if(empty($site)){
        exit;
    }
    shuffle($site);

    foreach ($site as $key => $value) {
        echo('
            <div onClick="
            elevage1('.$value->getIdSite().');
            elevage2('.$value->getIdGroupeHash().');
            portgere(2);
            " class="elesite">
                <p class="suelesite">
                    '.$value->getNomSite().'
                </p>
            </div>
        ');

        if ($key == 0) {
            echo("
            <script>
            elevage1(".$value->getIdSite().");
            elevage2(".$value->getIdGroupeHash().");
            </script>
            ");
        }
    }

    // for ($i=0; $i < 10; $i++) { 
    //     echo('
    //         <div onClick="
    //         elevage1(1);
    //         elevage2(1);
    //         " class="elesite">
    //             <p class="suelesite">
    //                 loll
    //             </p>

    //             <a class="myBut myOtherBut2" onClick="alerter2(2)"></a>
    //         </div>
    //     ');

    //     if ($i == 0) {
    //         echo("
    //         <script>
    //         elevage1(1);
    //         elevage2(1);
    //         </script>
    //         ");
    //     }
    // }
?>