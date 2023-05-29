<?php
    date_default_timezone_set('Europe/Paris');

    class SitesManager{
        private $_bdd;
        private $_hashsManager;

        // ======

        public function __construct( $bdd ){
            $this->setBdd($bdd);
            $this->_hashsManager = new HashsManager( $bdd );
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // ========

        public function getSiteByGroupe($id){
            $reqList = $this->_bdd->query('
                SELECT idSite
                FROM groupeSite
                WHERE idGroupeSite = '.$id
            );

            $tabSuSite = [];

            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $idSite = $tabDonnees['idSite'];

                $reqList2 = $this->_bdd->query('
                    SELECT *
                    FROM site
                    WHERE idSite = '.$idSite
                );

                $tabSuSite[] = $reqList2->fetch( PDO::FETCH_ASSOC );
            }

            $reqList->closeCursor();
            // $reqList2->closeCursor();
            // var_dump($tabSuSite);

            // ==========

            $tabSite = [];

            foreach ($tabSuSite as $key => $value) {
                $tabSite[] = $this->creerSite( $value );
            }
                
            // var_dump($tabSite);
            return $tabSite;

        }

        public function getSiteByGroupe2($id){
            $reqList = $this->_bdd->query('
                SELECT idSite
                FROM groupeSite
                WHERE idGroupeSite = '.$id
            );

            $tabSuSite = [];

            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $idSite = $tabDonnees['idSite'];

                $reqList2 = $this->_bdd->query('
                    SELECT *
                    FROM site
                    WHERE idSite = '.$idSite
                );

                $tabSuSite[] = $reqList2->fetch( PDO::FETCH_ASSOC );
            }

            $reqList->closeCursor();
            // $reqList2->closeCursor();
            // var_dump($tabSuSite);

            // ==========

            $tabSite = [];

            // var_dump($tabSuSite);

            foreach ($tabSuSite as $key => $value) {
                $tabSite[] = $this->creerSite2( $value );
            }
                
            // var_dump($tabSite);
            return $tabSite;

        }

        public function getSiteById($id){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM site
                WHERE idSite = '.$id
            );

            $suSite = $reqList->fetch( PDO::FETCH_ASSOC );

            $site = $this->creerSite2( $suSite );

            return $site;
        }

        public function getSiteByNom($loleur){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM site
                WHERE nomSite LIKE "'.$loleur.'"
            ');

            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabSite[] = $this->creerSite2( $tabDonnees );
            }
            return $tabSite;
        }

        //

        public function getIdGroupeSiteById($id){
            $reqList = $this->_bdd->query('
                SELECT idGroupeSite
                FROM groupeSite
                WHERE idSite = '.$id
            );
            $idGroupe = $reqList->fetch( PDO::FETCH_ASSOC );
            return $idGroupe;
        }

        //

        public function getIdGroupeSiteById2($tabId){
            foreach ($tabId as $key => $value) {
                $reqList = $this->_bdd->query('
                    SELECT idGroupeSite
                    FROM groupeSite
                    WHERE idSite = '.$value
                );
                $idGroupe[] = $reqList->fetch( PDO::FETCH_ASSOC );
            }
            
            return $idGroupe;
        }

        public function getIdGroupeSiteByNom2($loleur){
            $chainesup[] = explode(" " , $loleur);
            $nbsup = count($chainesup[0]);

            if($nbsup == 1){
                $reqList = $this->_bdd->query('
                    SELECT idSite
                    FROM site
                    WHERE LOCATE("'.$loleur.'",nomSite) > 0
                    OR LOCATE("'.$loleur.'",nomAdresse) > 0
                ');
            }elseif ($nbsup == 2) {
                $reqList = $this->_bdd->query('
                    SELECT idSite
                    FROM site
                    WHERE
                    LOCATE("'.$chainesup[0][1].'",nomSite) > 0
                    OR LOCATE("'.$chainesup[0][1].'",nomAdresse) > 0
                    OR
                    LOCATE("'.$chainesup[0][0].'",nomSite) > 0
                    OR LOCATE("'.$chainesup[0][0].'",nomAdresse) > 0
                ');
                // var_dump($reqList);
            }elseif ($nbsup == 3) {
                $reqList = $this->_bdd->query('
                    SELECT idSite
                    FROM site
                    WHERE
                        LOCATE("'.$chainesup[0][1].'",nomSite) > 0
                        OR LOCATE("'.$chainesup[0][1].'",nomAdresse) > 0
                        OR
                        LOCATE("'.$chainesup[0][0].'",nomSite) > 0
                        OR LOCATE("'.$chainesup[0][0].'",nomAdresse) > 0
                        OR
                        LOCATE("'.$chainesup[0][2].'",nomSite) > 0
                        OR LOCATE("'.$chainesup[0][2].'",nomAdresse) > 0
                ');
                // var_dump($reqList);
            }

            while ( $donnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabIdGroupe[] = $this->getIdGroupeSiteById($donnees['idSite']);
            }
            if (isset($tabIdGroupe)) {
                return $tabIdGroupe;
            }
            
        }

        //

        public function getIdGroupeSiteByGroupeHash($idGhash){
            // var_dump($idGhash);
            foreach ($idGhash as $key => $value) {
                $reqList = $this->_bdd->query('
                    SELECT idSite
                    FROM site
                    WHERE idGroupeHash = '.$value[0]['idGroupeHash']
                );
                if ($reqList == false) {
                    return;
                }
                $idSite = $reqList->fetch( PDO::FETCH_ASSOC );
                $idGroupe[] = $this->getIdGroupeSiteById2($idSite);
            }
            return $idGroupe;
        }

        public function getIdGroupeSiteByGroupeHash2($idGhash){
            // var_dump($idGhash);
            foreach ($idGhash as $key => $value) {
                $reqList = $this->_bdd->query('
                    SELECT idSite
                    FROM site
                    WHERE idGroupeHash = '.$value[0][0]['idGroupeHash']
                );
                $idSite = $reqList->fetch( PDO::FETCH_ASSOC );
                $idGroupe[] = $this->getIdGroupeSiteById2($idSite);
            }
            return $idGroupe;
        }

        //

        public function linkSiteByEtre($po2,$idNewSite){
            $sql = $this->_bdd->prepare('INSERT INTO groupeSite(idSite,idGroupeSite) VALUES('.$idNewSite.','.$po2.')');
            $sql->execute();
        }

        //

        public function getIdGroupeHashByIdSite($id){
            $reqList = $this->_bdd->query('
                SELECT idGroupeHash
                FROM site
                WHERE idSite = '.$id
            );

            $idG = $reqList->fetch( PDO::FETCH_ASSOC );

            return $idG['idGroupeHash'];
        }

        // ========

        public function addSite(Site $site){
            $sql = $this->_bdd->prepare('INSERT INTO site(nomSite,nomAdresse) VALUES("'.$site->getNomSite().'","'.$site->getNomAdresse().'")');    
            $sql->execute();
            $lol = $this->_bdd->lastInsertId();

            $sql = $this->_bdd->prepare('UPDATE site SET idGroupeHash = '.$lol.' WHERE idSite = '.$lol);    
            $sql->execute();
            
            return $lol;
        }

        // ========

        private function creerSite( array $donnees )
        {
            $site = new Site( $donnees );
    
            $site->setHash($this->_hashsManager->getHashByGroupe($site->getIdGroupeHash()));
            return $site;
        }

        private function creerSite2( array $donnees )
        {
            $site = new Site( $donnees );
    
            return $site;
        }
    }
?>