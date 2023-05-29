<?php
    include 'includes.php';
    include 'connect.php';

    // ========

    $EtresManager = new EtresManager( $bdd );
    // $SitesManager = new SitesManager( $bdd );
    // $HashsManager = new HashsManager( $bdd );
    // $ComsManager = new ComsManager( $bdd );

    // var_dump($_GET['lo']);
    $loleur = htmlspecialchars( trim($_GET['lo']));
    // $loleur = "harry";

    if (strlen($loleur) < 2) {
        exit;
    }

    // ========

    $pretre = $EtresManager->getEtreByNom($loleur);
    if ($pretre != null) {
        $etre[] = $pretre;
    }
    // var_dump($etre);

    $pretre = $EtresManager->getEtreByNomSite($loleur);
    if ($pretre != null) {
        $etre[] = $pretre;
    }
    // var_dump($etre);

    $pretre = $EtresManager->getEtreByNomHash($loleur);
    if ($pretre != null) {
        $etre[] = $pretre;
    }
    // var_dump($etre);

    $pretre = $EtresManager->getEtreByNomCom($loleur);
    if ($pretre != null) {
        $etre[] = $pretre;
    }

    $pretre = $EtresManager->getEtreByNomDesk($loleur);
    if ($pretre != null) {
        $etre[] = $pretre;
    }

    $pretre[] = $EtresManager->getEtreById($loleur);
    if ($pretre != null) {
        $etre[] = $pretre;
    }
    // var_dump($etre);

    if(empty($etre)){
        exit;
    }

    // var_dump($etre);
    // $etre = array_unique($etre);
    // var_dump($etre);

    foreach ($etre as $key => $value) {
        foreach ($value as $key => $value2) {
            $tabEtre[] = $value2;
        }
    }

    if(empty($tabEtre)){
        exit;
    }
    // var_dump($tabEtre);
    $tabEtre = array_unique($tabEtre,SORT_REGULAR);
    // var_dump($tabEtre);


    

    // var_dump($tabEtre);


    foreach ($tabEtre as $key => $value) {
        if (empty($value)) {
            return;
        }
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

