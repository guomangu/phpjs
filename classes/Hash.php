<?php
    class Hash{
        private $_idHash;
        private $_nomHash;
        private $_idGroupeCom;

        private $_com;
        
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

        public function setIdHash($idHash){
            $this->_idHash = (int)$idHash;
        }
        public function getIdHash(){
            return $this->_idHash;
        }

        public function setNomHash($nomHash){
            $this->_nomHash = $nomHash;
        }
        public function getNomHash(){
            return $this->_nomHash;
        }

        public function setIdGroupeCom($idGroupeCom){
            $this->_idGroupeCom = (int)$idGroupeCom;
        }
        public function getIdGroupeCom(){
            return $this->_idGroupeCom;
        }

        // ========

        public function setCom($com){
            $this->_com = $com;
        }
        public function getCom(){
            return $this->_com;
        }
    }
?>