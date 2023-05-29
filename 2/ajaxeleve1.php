<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $SitesManager = new SitesManager( $bdd );

    // ========

    $loleur = htmlspecialchars( trim($_GET['lol']));

    $site = $SitesManager->getSiteById($loleur);
    // var_dump($site);

    // ========

    echo('
        <p class="elelink">
            <a target="_blank" href="'.$site->getNomAdresse().'">
                '.$site->getNomAdresse().'
            </a>
        </p>
        <p id="lo" style="display:none;">'.$site->getIdSite().'</p>
        <p id="mo" style="display:none;">'.$site->getIdGroupeHash().'</p>
    ');

// for ($i=0; $i < 1; $i++) { 
//     echo('
//         <p class="elelink">
//             <a href="http://localhost:8888/old%203/index.html">
//                 http://localhost:8888/old%203/index.html
//             </a>
//         </p>

//     ');
// }

?>