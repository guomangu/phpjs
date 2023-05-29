<?php
    class Site{
        private $_idSite;
        private $_nomSite;
        private $_idGroupeHash;
        private $_nomAdresse;

        private $_hash;
        
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

        public function setIdSite($idSite){
            $this->_idSite = (int)$idSite;
        }
        public function getIdSite(){
            return $this->_idSite;
        }

        public function setNomSite($nomSite){
            $this->_nomSite = $nomSite;
        }
        public function getNomSite(){
            return $this->_nomSite;
        }

        public function setIdGroupeHash($idGroupeHash){
            $this->_idGroupeHash = (int)$idGroupeHash;
        }
        public function getIdGroupeHash(){
            return $this->_idGroupeHash;
        }

        public function setNomAdresse($nomAdresse){
            $this->_nomAdresse = $nomAdresse;
        }
        public function getNomAdresse(){
            return $this->_nomAdresse;
        }

        // ========

        public function setHash($hash){
            $this->_hash = $hash;
        }
        public function getHash(){
            return $this->_hash;
        }


    }
?>