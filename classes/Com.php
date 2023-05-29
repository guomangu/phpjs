<?php
    class Com{
        private $_idEtreEmeteru;
        private $_nomCom;
        private $_idGroupeCom;

        // =========

        public function __construct(array $donnees){
            $this->hydrate($donnees);
        }

	    public function hydrate(array $donnees){
            foreach ($donnees as $key => $value){
                $method = 'set'.ucfirst($key);
                
                if (method_exists($this, $method)){
                    $this->$method($value);
                }
            }
        }

        // =========

        public function setIdEtreEmeteru($idEtreEmeteru){
            $this->_idEtreEmeteru = (int)$idEtreEmeteru;
        }
        public function getIdEtreEmeteru(){
            return $this->_idEtreEmeteru;
        }

        public function setNomCom($nomCom){
            $this->_nomCom = $nomCom;
        }
        public function getNomCom(){
            return $this->_nomCom;
        }

        public function setIdGroupeCom($idGroupeCom){
            $this->_idGroupeCom = (int)$idGroupeCom;
        }
        public function getIdGroupeCom(){
            return $this->_idGroupeCom;
        }

        // ========


    }
?>