<?php

    class Categoria{

        private $idcategoria;
        private $nomecategoria;

        public function setId($idcategoria){
            $this->idcategoria=$idcategoria;
        }

        public function setNomeCategoria($nomecategoria){
            $this->nomecategoria=$nomecategoria;
        }

        public function getId(){
            return $this->idcategoria;
        }

        public function getNomeCategoria(){
            return $this->nomecategoria;
        }

    }


?>