<?php
    include '../includes.php';
    include '../connect.php';

    // ========

    $EtresManager = new EtresManager($bdd);
    $SitesManager = new SitesManager( $bdd );

    $po = htmlspecialchars( trim($_POST["po"]));
    $nom = htmlspecialchars( trim($_POST["txt"]));
    $adresse = htmlspecialchars( trim($_POST["txt2"]));

    // $po = 3;
    // $nom = "youtube";
    // $adresse = "https://www.youtube.com/watch?v=ht5T2thYQFk";

    if (empty($po) or empty($nom) or empty($adresse)) {
        exit;
    }

    //=========
    // var_dump($po);
    // var_dump($nom);
    // var_dump($adresse);

    $idNewSite = $SitesManager->addSite( 
        new Site( 
            array(
                'nomSite' => $nom,
                'nomAdresse' => $adresse,
            )
        )
    );
    // var_dump($idNewSite);

    $po2 = $EtresManager->getIdGroupeSiteByIdEtre($po);
    // var_dump($po2);

    $SitesManager->linkSiteByEtre($po2,$idNewSite);

    //==========

    // $etre = $EtresManager->getEtreById($po);

    // $lol = $etre->getSite();
    
    // if (!empty($lol)) {
    //     foreach ($lol as $key => $value) {
    //         $lol2 = $value->getIdGroupeHash();
    //     }
    // }else {
    //     $lol2 = "";
    // }

    // echo(
    //     '
    //     <p class="sutres2">
    //         (lol)
    //     </p>
    //     <p class="sutres">
    //         '.$etre->getNomEtre().'
    //     </p>
    //     <a class="myBut myOtherBut3" onClick="alerter2(1)"></a>
    //     <p id="po" style="display:none;">'.$etre->getIdEtre().'</p>
    //     '
    // );

    // if(empty($etre)){
    //     exit;
    // }

    // echo('
    //     <script>
    //         ecolier('.$etre->getGroupeParent().');
    //         ecolier2('.$etre->getGroupeEnfant().');
    //         classeur('.$lol2.');
    //         classeur2('.$etre->getGroupeSite().');
    //     </script>
    // ');
?>