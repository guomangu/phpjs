<?php
    date_default_timezone_set('Europe/Paris');

    class HashsManager{
        private $_bdd;
        private $_comsManager;

        // ======

        public function __construct( $bdd ){
            $this->setBdd($bdd);
            $this->_comsManager = new ComsManager( $bdd );
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // ========

        public function getHashByGroupe($id){
            // var_dump($id);

            $reqList = $this->_bdd->query('
                SELECT idHash
                FROM groupeHash
                WHERE idGroupeHash = '.$id
            );
            // var_dump($reqList);
            if ($reqList == false) {
                return;
            }

            $tabSuSite = [];

            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $idHash = $tabDonnees['idHash'];

                $reqList2 = $this->_bdd->query('
                    SELECT *
                    FROM hash
                    WHERE idHash = '.$idHash
                );

                $tabSuHash[] = $reqList2->fetch( PDO::FETCH_ASSOC );
            }

            $reqList->closeCursor();
            // $reqList2->closeCursor();

            // ==========

            $tabHash = [];

            if (isset($tabSuHash)) {
                foreach ($tabSuHash as $key => $value) {
                    $tabHash[] = $this->creerHash2( $value );
                }
                    
                return $tabHash;
            }
        }

        //

        public function linkHashByEtre($lo2,$idNewHash){
            $sql = $this->_bdd->prepare('INSERT INTO groupeHash(idHash,idGroupeHash) VALUES('.$idNewHash.','.$lo2.')');
            $sql->execute();
        }

        //

        public function getHashByNom($loleur){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM hash
                WHERE nomHash LIKE "'.$loleur.'"
            ');

            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabHash[] = $this->creerHash2( $tabDonnees );
            }
            return $tabHash;
        }

        //recherche=======:=======

        public function getIdGroupeHashById($id){
            $reqList = $this->_bdd->query('
                SELECT idGroupeHash
                FROM groupeHash
                WHERE idHash = '.$id
            );
            $idGroupe = $reqList->fetch( PDO::FETCH_ASSOC );
            return $idGroupe;
        }

        public function getIdGroupeHashByNom2($loleur){
            $chainesup[] = explode(" " , $loleur);
            $nbsup = count($chainesup[0]);

            if($nbsup == 1){
                $reqList = $this->_bdd->query('
                    SELECT idhash
                    FROM hash
                    WHERE LOCATE("'.$loleur.'",nomHash) > 0
                ');
            }elseif ($nbsup == 2) {
                $reqList = $this->_bdd->query('
                    SELECT idhash
                    FROM hash
                    WHERE
                    LOCATE("'.$chainesup[0][1].'",nomHash) > 0
                    OR
                    LOCATE("'.$chainesup[0][0].'",nomHash) > 0
                ');
                // var_dump($reqList);
            }elseif ($nbsup == 3) {
                $reqList = $this->_bdd->query('
                    SELECT idhash
                    FROM hash
                    WHERE
                        LOCATE("'.$chainesup[0][1].'",nomHash) > 0
                        OR
                        LOCATE("'.$chainesup[0][0].'",nomHash) > 0
                        OR
                        LOCATE("'.$chainesup[0][2].'",nomHash) > 0
                ');
                // var_dump($reqList);
            }

            while ( $donnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                // var_dump($donnees);
                $tabIdGroupe[] = $this->getIdGroupeHashById($donnees['idhash']);
            }
            if (isset($tabIdGroupe)) {
                return $tabIdGroupe;
            }
        }

        //

        public function getIdGroupeHashById2($idHash){
            foreach ($idHash as $key => $value) {
                $reqList = $this->_bdd->query('
                    SELECT idGroupeHash
                    FROM groupeHash
                    WHERE idHash = '.$value
                );
                $idGroupe[] = $reqList->fetch( PDO::FETCH_ASSOC );
            }
            
            return $idGroupe;
        }

        public function getIdGroupeHashByGroupeCom($tab){
            // var_dump($tab);
            foreach ($tab as $key => $value) {
                $reqList = $this->_bdd->query('
                    SELECT idHash
                    FROM hash
                    WHERE idGroupeCom = '.$value
                );
                $idHash = $reqList->fetch( PDO::FETCH_ASSOC );
                $idGroupe[] = $this->getIdGroupeHashById2($idHash);
            }
            return $idGroupe;
        }

        // ========

        public function addHash(Hash $hash){
            $sql = $this->_bdd->prepare('INSERT INTO hash(nomHash) VALUES("'.$hash->getNomHash().'")');    
            $sql->execute();
            $lol = $this->_bdd->lastInsertId();

            $sql = $this->_bdd->prepare('UPDATE hash SET idGroupeCom = '.$lol.' WHERE idHash = '.$lol);    
            $sql->execute();
            
            return $lol;
        }

        // ========

        private function creerHash( array $donnees )
        {
            $hash = new Hash( $donnees );
            $hash->setCom($this->_comsManager->getComByGroupe($hash->getIdGroupeCom()));

            return $hash;
        }

        private function creerHash2( array $donnees )
        {
            $hash = new Hash( $donnees );

            return $hash;
        }
    }
?>