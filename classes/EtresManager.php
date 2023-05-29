<?php
    date_default_timezone_set('Europe/Paris');

    class EtresManager{
        private $_bdd;
        private $_sitesManager;
        private $_hashsManager;
        private $_comsManager;

        // ======

        public function __construct( $bdd ){
            $this->setBdd($bdd);
            $this->_sitesManager = new SitesManager( $bdd );
            $this->_hashsManager = new HashsManager($bdd);
            $this->_comsManager = new ComsManager($bdd);
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // ========

        public function getEtreMenuByIdEtre($id){
            $reqList = $this->_bdd->query('
                SELECT groupeEnfant
                FROM etre
                WHERE idEtre = '.$id
            );

            $idGroupeEnfant = $reqList->fetch( PDO::FETCH_ASSOC );

            $reqList->closeCursor();

            // ========

            $reqList2 = $this->_bdd->query('
                SELECT idEtre
                FROM groupeEnfant
                WHERE idGroupeEnfant = '.$idGroupeEnfant['groupeEnfant']
            );

            $tabSuEtre = [];

            while ( $tabDonnees = $reqList2->fetch( PDO::FETCH_ASSOC ) )
            {
                $reqList3 = $this->_bdd->query('
                    SELECT *
                    FROM etre
                    WHERE idEtre = '.$tabDonnees['idEtre']
                );

                $tabSuEtre[] = $reqList3->fetch( PDO::FETCH_ASSOC );
            }

            $reqList2->closeCursor();
            $reqList3->closeCursor();

            // var_dump($tabSuEtre);

            //========
            
            $tabEtre = [];

            foreach ($tabSuEtre as $key => $value) {
                $tabEtre[] = $this->creerEtre0( $value );
            }
                
            return $tabEtre;
        }

        // ======= etre =======

        public function getEtreById($id){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM etre
                WHERE idEtre = '.$id
            );

            if($reqList == false){
                return;
            }
            
            $suEtre = $reqList->fetch( PDO::FETCH_ASSOC );

            $etre = $this->creerEtre0( $suEtre );

            return $etre;
        }

        public function getEtreByRAND(){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM etre
                ORDER BY RAND()
            ');

            $suEtre = $reqList->fetch( PDO::FETCH_ASSOC );

            $etre = $this->creerEtre0( $suEtre );

            return $etre;
        }

        // ========= recherche ========

        public function getEtreByNom($loleur){
            // var_dump($loleur);
            $chainesup[] = explode(" " , $loleur);
            $nbsup = count($chainesup[0]);

            if($nbsup == 1){
                $reqList = $this->_bdd->query('
                    SELECT *
                    FROM etre
                    WHERE LOCATE("'.$loleur.'",nomEtre) > 0
                ');
            }elseif ($nbsup == 2) {
                $reqList = $this->_bdd->query('
                    SELECT *
                    FROM etre
                    WHERE
                    LOCATE("'.$chainesup[0][1].'",nomEtre) > 0
                    OR
                    LOCATE("'.$chainesup[0][0].'",nomEtre) > 0
                ');
                // var_dump($reqList);
            }elseif ($nbsup == 3) {
                $reqList = $this->_bdd->query('
                    SELECT *
                    FROM etre
                    WHERE
                        LOCATE("'.$chainesup[0][1].'",nomEtre) > 0
                        OR
                        LOCATE("'.$chainesup[0][0].'",nomEtre) > 0
                        OR
                        LOCATE("'.$chainesup[0][2].'",nomEtre) > 0
                ');
                // var_dump($reqList);
            }
            // WHERE nomEtre LIKE "'.$loleur.'"

            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                // var_dump($tabDonnees);
                $tabEtre[] = $this->creerEtre0( $tabDonnees );
            }
            // var_dump($tabEtre);
            if (isset($tabEtre)) {
                return $tabEtre;
            }
            
        }

        //

        public function getEtreByNomDesk($loleur){
            $chainesup[] = explode(" " , $loleur);
            $nbsup = count($chainesup[0]);

            if($nbsup == 1){
                $reqList = $this->_bdd->query('
                    SELECT idEtre
                    FROM deskEtre
                    WHERE LOCATE("'.$loleur.'",nomDesk) > 0
                ');
            }elseif ($nbsup == 2) {
                $reqList = $this->_bdd->query('
                    SELECT idEtre
                    FROM deskEtre
                    WHERE
                    LOCATE("'.$chainesup[0][1].'",nomDesk) > 0
                    OR
                    LOCATE("'.$chainesup[0][0].'",nomDesk) > 0
                ');
                // var_dump($reqList);
            }elseif ($nbsup == 3) {
                $reqList = $this->_bdd->query('
                    SELECT idEtre
                    FROM deskEtre
                    WHERE
                        LOCATE("'.$chainesup[0][1].'",nomDesk) > 0
                        OR
                        LOCATE("'.$chainesup[0][0].'",nomDesk) > 0
                        OR
                        LOCATE("'.$chainesup[0][2].'",nomDesk) > 0
                ');
                // var_dump($reqList);
            }

            while ( $donnee = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                // var_dump($tabDonnees);
                $tabEtre[] = $this->getEtreById($donnee['idEtre']);
            }
            if (isset($tabEtre)) {
                return $tabEtre;
            }
        }

        //

        public function getEtreByTabIdGroupeSite($tabIdGroupeSite){
            // var_dump($tabIdGroupeSite);
            foreach ($tabIdGroupeSite as $key => $value) {
                // var_dump($value);
                $reqList = $this->_bdd->query('
                    SELECT *
                    FROM etre
                    WHERE groupeSite = '.$value[0]['idGroupeSite']
                );
                // var_dump($reqList);
                if ($reqList == false) {
                    return;
                }
                $suEtre = $reqList->fetch( PDO::FETCH_ASSOC );
                $tabEtre[] = $this->creerEtre0( $suEtre );
            }
            return $tabEtre;
        }

        public function getEtreByNomSite($loleur){
            $tabIdGroupeSite[] = $this->_sitesManager->getIdGroupeSiteByNom2($loleur);
            $tabEtre[] = $this->getEtreByTabIdGroupeSite($tabIdGroupeSite);
            foreach ($tabEtre as $key => $value) {
                $tabEtre2 = $value;
            }
            return $tabEtre2;
        }

        //

        public function getEtreByTabIdGroupeSite2($tabIdGroupeSite){
            // var_dump($tabIdGroupeSite);
            foreach ($tabIdGroupeSite as $key => $value) {
                // var_dump($value);
                $reqList = $this->_bdd->query('
                    SELECT *
                    FROM etre
                    WHERE groupeSite = '.$value[0][0]['idGroupeSite']
                );
                // var_dump($reqList);
                if ($reqList == false) {
                    return;
                }
                $suEtre = $reqList->fetch( PDO::FETCH_ASSOC );
                // var_dump($suEtre);
                $tabEtre[] = $this->creerEtre0( $suEtre );
            }
            // var_dump($tabEtre);
            return $tabEtre;
        }

        public function getEtreByNomHash($loleur){
            $tabIdGroupeHash[] = $this->_hashsManager->getIdGroupeHashByNom2($loleur);
            $tabIdGroupeSite[] = $this->_sitesManager->getIdGroupeSiteByGroupeHash($tabIdGroupeHash);
            $tabEtre = $this->getEtreByTabIdGroupeSite2($tabIdGroupeSite);
            return $tabEtre;
        }

        //

        public function getEtreByNomCom($loleur){
            $tabIdGroupeCom = $this->_comsManager->getIdGroupeComByNom2($loleur);
            if (empty($tabIdGroupeCom)) {
                return;
            }
            $tabIdGroupeHash[] = $this->_hashsManager->getIdGroupeHashByGroupeCom($tabIdGroupeCom);
            $tabIdGroupeSite[] = $this->_sitesManager->getIdGroupeSiteByGroupeHash2($tabIdGroupeHash);
            $tabEtre = $this->getEtreByTabIdGroupeSite2($tabIdGroupeSite);
            return $tabEtre;
        }

        // ========= parent =========

        public function getParentByIdGroupe($id){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM groupeParent
                WHERE idGroupeParent = '.$id
            );

            $tabEtre = [];
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){                
                $reqList2 = $this->_bdd->query('
                    SELECT *
                    FROM etre
                    WHERE idEtre = '.$tabDonnees['idEtre']
                );

                $suEtre = $reqList2->fetch( PDO::FETCH_ASSOC );

                $tabEtre[] = $this->creerEtre0( $suEtre );
            }

            return $tabEtre;
        }

        // ======== enfant ========

        public function getEnfantByIdGroupe($id){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM groupeEnfant
                WHERE idGroupeEnfant = '.$id
            );

            $tabEtre = [];
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){                
                $reqList2 = $this->_bdd->query('
                    SELECT *
                    FROM etre
                    WHERE idEtre = '.$tabDonnees['idEtre']
                );

                $suEtre = $reqList2->fetch( PDO::FETCH_ASSOC );

                $tabEtre[] = $this->creerEtre0( $suEtre );
            }

            return $tabEtre;
        }

        // ========insert

        public function addEtre(Etre $etre){
            // var_dump($etre);
            $sql = $this->_bdd->prepare('INSERT INTO etre(nomEtre) VALUES("'.$etre->getNomEtre().'")');    
            // var_dump($sql);
            $sql->execute();
            

            $lol = $this->_bdd->lastInsertId();
            // var_dump($lol);
            $sql = $this->_bdd->prepare('UPDATE etre SET groupeParent = '.$lol.', groupeEnfant = '.$lol.', groupeSite = '.$lol.' WHERE idEtre = '.$lol);    
            // var_dump($sql);
            $sql->execute();
            
            return $lol;
        }

        public function addDesk($po,$desk){
            $sql = $this->_bdd->prepare('INSERT INTO deskEtre(nomDesk,idEtre) VALUES("'.$desk.'","'.$po.'")');    
            $sql->execute();
        }

        public function addSaveur($pse,$pas,$idEtre){
            $sql = $this->_bdd->prepare('INSERT INTO compte(nomSave,passSave,idEtre,idGroupeSaveEtre) VALUES("'.$pse.'","'.$pas.'",'.$idEtre.','.$idEtre.')');    
            $sql->execute();

            // $lol = $this->_bdd->lastInsertId();
            // // var_dump($lol);
            // $sql = $this->_bdd->prepare('UPDATE COMPTE SET idGroupeSaveEtre = '.$lol.' WHERE idEtre = '.$lol);    
            // // var_dump($sql);
            // $sql->execute();
        }

        // public function addGroupeParent($id){
        //     $sql = $this->_bdd->prepare('INSERT INTO groupeParent(idEtre,idGroupeParent) VALUES("'.$id.'",autoInc1()) RETURNING idGroupeParent');
        //     var_dump($sql);
        //     $sql->execute();
        //     $idParent = $sql->fetch( PDO::FETCH_ASSOC );

        //     var_dump($idParent);

        //     var_dump($this->_bdd->lastInsertId('idGroupeParent'));

        //     return $this->_bdd->lastInsertId();
        // }
        // public function addGroupeEnfant($id){
        //     $sql = $this->_bdd->query('INSERT INTO groupeEnfant(idEtre,idGroupeEnfant) VALUES("'.$id.'",autoInc1())');

        //     return $this->_bdd->lastInsertId();
        // }
        // public function addGroupeSite($id){
        //     $sql = $this->_bdd->query('INSERT INTO groupeSite(idSite,idGroupeSite) VALUES(NULL,autoInc1())');

        //     return $this->_bdd->lastInsertId();

        //     // $sql2 = $this->_bdd->prepare('DELETE FROM `groupeSite` WHERE idSite = "'.$id.'"');
        //     // $sql2->execute();
        // }

        // public function addCompletEtre(Etre $etre){
        //     $sql = $this->_bdd->query('UPDATE etre SET groupeParent = '.$etre->getGroupeParent().' , groupeEnfant = '.$etre->getGroupeEnfant().' , groupeSite = '.$etre->getGroupeSite().' WHERE idEtre = '.$etre->getIdEtre());
        //     var_dump($sql);
        // }

        //

        public function getIdGroupeParentByIdEtre($id){
            $reqList = $this->_bdd->query('
                SELECT groupeParent
                FROM etre
                WHERE idEtre = '.$id
            );

            $idG = $reqList->fetch( PDO::FETCH_ASSOC );

            return $idG['groupeParent'];
        }

        public function insertParent($new,$po){
            $idParent = $this->getIdGroupeParentByIdEtre($po);
            // var_dump($idParent);
            $sql = $this->_bdd->prepare('INSERT INTO groupeParent(idEtre,idGroupeParent) VALUES('.$new.','.$idParent.')');
            // var_dump($sql);
            $sql->execute();
        }



        public function getIdGroupeEnfantByIdEtre($id){
            $reqList = $this->_bdd->query('
                SELECT groupeEnfant
                FROM etre
                WHERE idEtre = '.$id
            );

            $idG = $reqList->fetch( PDO::FETCH_ASSOC );

            return $idG['groupeEnfant'];
        }

        public function insertEnfant($po,$new){
            $idEnfant = $this->getIdGroupeEnfantByIdEtre($new);

            $sql = $this->_bdd->prepare('INSERT INTO groupeEnfant(idEtre,idGroupeEnfant) VALUES('.$po.','.$idEnfant.')');
            $sql->execute();
        }



        public function linkFamByIdsEtre($po,$new){
            // var_dump($po,$new);
            // $idParent = $this->getIdGroupeParentByIdEtre($po);
            $this->insertParent($new,$po);

            // $idEnfant = $this->getIdGroupeParentByIdEtre($new);
            $this->insertEnfant($po,$new);
        }

        //

        public function getIdGroupeParentByIdEtre2($id){
            $reqList = $this->_bdd->query('
                SELECT groupeParent
                FROM etre
                WHERE idEtre = '.$id
            );

            $idG = $reqList->fetch( PDO::FETCH_ASSOC );

            return $idG['groupeParent'];
        }

        public function insertParent2($new,$po){
            $idParent = $this->getIdGroupeParentByIdEtre2($new);
            // var_dump($idParent);
            $sql = $this->_bdd->prepare('INSERT INTO groupeParent(idEtre,idGroupeParent) VALUES('.$po.','.$idParent.')');
            // var_dump($sql);
            $sql->execute();
        }



        public function getIdGroupeEnfantByIdEtre2($id){
            $reqList = $this->_bdd->prepare('
                SELECT groupeEnfant
                FROM etre
                WHERE idEtre = '.$id
            );
            // var_dump($reqList);
            $reqList->execute();

            $idG = $reqList->fetch( PDO::FETCH_ASSOC );

            // var_dump($idG);

            return $idG['groupeEnfant'];
        }

        public function insertEnfant2($po,$new){
            // var_dump($po);
            $idEnfant = $this->getIdGroupeEnfantByIdEtre2($po);

            $sql = $this->_bdd->prepare('INSERT INTO groupeEnfant(idEtre,idGroupeEnfant) VALUES('.$new.','.$idEnfant.')');
            // var_dump($sql);
            $sql->execute();
            // var_dump($sql);
        }




        public function linkFamByIdsEtre2($po,$new){
            // var_dump($po,$new);
            // $idParent = $this->getIdGroupeParentByIdEtre($po);
            $this->insertParent2($new,$po);

            // $idEnfant = $this->getIdGroupeParentByIdEtre($new);
            $this->insertEnfant2($po,$new);
        }

        //

        public function getIdGroupeSiteByIdEtre($id){
            $reqList = $this->_bdd->query('
                SELECT groupeSite
                FROM etre
                WHERE idEtre = '.$id
            );

            $idG = $reqList->fetch( PDO::FETCH_ASSOC );

            return $idG['groupeSite'];
        }

        //

        public function getDeskByIdEtre($id){
            $reqList = $this->_bdd->query('
                SELECT nomDesk
                FROM deskEtre
                WHERE idEtre = '.$id
            );

            if ($reqList == false) {
                exit;
            }

            $desk = $reqList->fetch( PDO::FETCH_ASSOC );

            return $desk['nomDesk'];
        }

        //

        public function getParentByNomEtre($nom,$id){
            $reqList0 = $this->_bdd->query('
                SELECT *
                FROM etre
                WHERE nomEtre = "'.$nom.'" AND idEtre != '.$id
            );
            // var_dump($reqList0);
            if ($reqList0 == false) {
                exit;
            }
            while ( $tabDonnees0 = $reqList0->fetch( PDO::FETCH_ASSOC ) ){                
                // $tabGroupeParent[] = $tabDonnees0['groupeParent'];

                $reqList = $this->_bdd->query('
                    SELECT *
                    FROM groupeParent
                    WHERE idGroupeParent = '.$tabDonnees0['groupeParent']
                );

                while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){                
                    $reqList2 = $this->_bdd->query('
                        SELECT *
                        FROM etre
                        WHERE idEtre = '.$tabDonnees['idEtre']
                    );

                    $suEtre = $reqList2->fetch( PDO::FETCH_ASSOC );

                    $tabEtre[] = $this->creerEtre0( $suEtre );
                }
            }
            // var_dump($tabEtre);
            if (isset($tabEtre)) {
                return $tabEtre;
            }
            // return $tabEtre;
        }

        public function getEnfantByNomEtre($nom,$id){
            $reqList0 = $this->_bdd->query('
                SELECT *
                FROM etre
                WHERE nomEtre = "'.$nom.'" AND idEtre != '.$id
            );
            // var_dump($reqList0);
            if ($reqList0 == false) {
                exit;
            }
            while ( $tabDonnees0 = $reqList0->fetch( PDO::FETCH_ASSOC ) ){                
                // $tabGroupeParent[] = $tabDonnees0['groupeParent'];

                $reqList = $this->_bdd->query('
                    SELECT *
                    FROM groupeEnfant
                    WHERE idGroupeEnfant = '.$tabDonnees0['groupeEnfant']
                );

                while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){                
                    $reqList2 = $this->_bdd->query('
                        SELECT *
                        FROM etre
                        WHERE idEtre = '.$tabDonnees['idEtre']
                    );

                    $suEtre = $reqList2->fetch( PDO::FETCH_ASSOC );

                    $tabEtre[] = $this->creerEtre0( $suEtre );
                }
            }
            // var_dump($tabEtre);
            if (isset($tabEtre)) {
                return $tabEtre;
            }
            // return $tabEtre;
        }

        // ========fabrique

        private function creerEtre( array $donnees )
        {
            $etre = new Etre( $donnees );
            $etre->setSite($this->_sitesManager->getSiteByGroupe($etre->getGroupeSite()));
            return $etre;
        }

        private function creerEtre0( array $donnees )
        {
            $etre = new Etre( $donnees );
            return $etre;
        }

        //seco ===========

        public function seco($pse,$pas){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM compte
                WHERE nomSave LIKE "'.$pse.'" 
                AND passSave LIKE "'.$pas.'"'
            );

            if ($reqList == false) {
                exit;
            }

            $idG = $reqList->fetch( PDO::FETCH_ASSOC );
            return $idG;
        }

        public function recupSave($idG){
            $reqList = $this->_bdd->query('
                SELECT idEtre
                FROM groupeSaveEtre
                WHERE idGroupeSaveEtre = '.$idG
            );

            if ($reqList == false) {
                return;
            }

            while ($donnees = $reqList->fetch(PDO::FETCH_ASSOC)) {
                $tabIdEtre[] = $donnees;
            }

            return $tabIdEtre;
        }

        //cree save ==========

        public function getIdGsaveByPsePas($pse,$pas,$id){
            $reqList = $this->_bdd->query('
                SELECT idGroupeSaveEtre
                FROM compte
                WHERE idEtre = '.$id.' 
                AND nomSave = "'.$pse.'" 
                AND passSave = "'.$pas.'"'
            );

            if ($reqList == false) {
                exit;
            }

            $donnees = $reqList->fetch(PDO::FETCH_ASSOC);

            return $donnees['idGroupeSaveEtre'];
        }

        public function addNewSave($po,$idGsave){
            $sql = $this->_bdd->prepare('INSERT INTO groupeSaveEtre(idEtre,idGroupeSaveEtre) VALUES('.$po.','.$idGsave.')');    
            $sql->execute();
        }

        public function testCorees($po,$idG){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM groupeSaveEtre
                WHERE idEtre = '.$po.' 
                AND idGroupeSaveEtre = '.$idG
            );

            $donnees = $reqList->fetch(PDO::FETCH_ASSOC);

            $cero = 0;
            $ono = 1;
            // var_dump($donnees);
            if ($donnees == false) {
                return $cero;
            }else{
                return $ono;
            }
        }

        public function spprNewSave($po,$idGsave){
            $sql = $this->_bdd->prepare('DELETE FROM `groupeSaveEtre` WHERE idGroupeSaveEtre = '.$idGsave.' AND idEtre = '.$po);    
            $sql->execute();
        }
    }
?>