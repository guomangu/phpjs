<?php
    date_default_timezone_set('Europe/Paris');

    class ComsManager{
        private $_bdd;

        // ======

        public function __construct( $bdd ){
            $this->setBdd($bdd);
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // ========

        public function getComByGroupe($id){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM groupeCom
                WHERE idGroupeCom = '.$id.'
                ORDER BY idCom DESC'
            );

            $tabCom = [];

            if ($reqList == false) {
                return;
            }

            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabCom[] = $this->creerCom( $tabDonnees );
            }

            $reqList->closeCursor();

            return $tabCom;
        }

        //

        public function getComByNom($loleur){
            $reqList = $this->_bdd->query('
                SELECT *
                FROM groupeCom
                WHERE nomCom LIKE "'.$loleur.'"
            ');

            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabCom[] = $this->creerCom( $tabDonnees );
            }
            return $tabCom;
        }

        public function getIdGroupeComByNom2($loleur){
            $chainesup[] = explode(" " , $loleur);
            $nbsup = count($chainesup[0]);

            if($nbsup == 1){
                $reqList = $this->_bdd->query('
                    SELECT idGroupeCom
                    FROM groupeCom
                    WHERE LOCATE("'.$loleur.'",nomCom) > 0
                ');
            }elseif ($nbsup == 2) {
                $reqList = $this->_bdd->query('
                    SELECT idGroupeCom
                    FROM groupeCom
                    WHERE
                    LOCATE("'.$chainesup[0][1].'",nomCom) > 0
                    OR
                    LOCATE("'.$chainesup[0][0].'",nomCom) > 0
                ');
                // var_dump($reqList);
            }elseif ($nbsup == 3) {
                $reqList = $this->_bdd->query('
                    SELECT idGroupeCom
                    FROM groupeCom
                    WHERE
                        LOCATE("'.$chainesup[0][1].'",nomCom) > 0
                        OR
                        LOCATE("'.$chainesup[0][0].'",nomCom) > 0
                        OR
                        LOCATE("'.$chainesup[0][2].'",nomCom) > 0
                ');
                // var_dump($reqList);
            }

            while ( $donnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                // var_dump($donnees);
                $tabIdGroupe[] = $donnees['idGroupeCom'];
            }
            if (isset($tabIdGroupe)) {
                return $tabIdGroupe;
            }
        }

        // ======

        public function addCom(Com $com){
            $sql = $this->_bdd->prepare('INSERT INTO groupeCom(nomCom,idGroupeCom) VALUES("'.$com->getNomCom().'","'.$com->getIdGroupeCom().'")');    
            $sql->execute();
            
            // return $this->_bdd->lastInsertId();
        }

        // ======

        private function creerCom( array $donnees )
        {
            $com = new Com( $donnees );
            return $com;
        }
    }
?>