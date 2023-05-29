<?php
    class Etre{
        private $_idEtre;
        private $_nomEtre;
        private $_groupeParent;
        private $_groupeEnfant;
        private $_groupeSite;
        // private $_type;

        private $_site;

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

        public function setIdEtre($idEtre){
            $this->_idEtre = (int)$idEtre;
        }
        public function getIdEtre(){
            return $this->_idEtre;
        }

        public function setNomEtre($nomEtre){
            $this->_nomEtre = $nomEtre;
        }
        public function getNomEtre(){
            return $this->_nomEtre;
        }

        public function setGroupeParent($groupeParent){
            $this->_groupeParent = (int)$groupeParent;
        }
        public function getGroupeParent(){
            return $this->_groupeParent;
        }

        public function setGroupeEnfant($groupeEnfant){
            $this->_groupeEnfant = (int)$groupeEnfant;
        }
        public function getGroupeEnfant(){
            return $this->_groupeEnfant;
        }

        public function setGroupeSite($groupeSite){
            $this->_groupeSite = (int)$groupeSite;
        }
        public function getGroupeSite(){
            return $this->_groupeSite;
        }

        // public function setType($type){
        //     $this->_type = (int)$type;
        // }
        // public function getType(){
        //     return $this->_type;
        // }

        // ========

        public function setSite($site){
            $this->_site = $site;
        }
        public function getSite(){
            return $this->_site;
        }
    }
?>