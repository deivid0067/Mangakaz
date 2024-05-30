<?php
require_once('Categoria.php');

    class Produto{
        private $idProduto;
        private $nomeProduto;
        private $precoProduto;
        private $fotoProduto;

        private $categoria;

        public function __construct()
        {
            $categoria = new Categoria();
        }

        public function getIdPro(){
            return $this->idProduto;
        }
        public function getNomePro(){
            return $this->nomeProduto;
        }
        public function getPrecoPro(){
            return $this->precoProduto;
        }
        public function  setIdPro($idProduto){
            $this->idProduto = $idProduto;
        }
        public function setNomePro($nomeProduto){
            $this->nomeProduto = $nomeProduto;
        }
        public function setPrecoPro($precoProduto) {
            $this->precoProduto = $precoProduto;
        }

        public function getCategoria(){
            return $this->categoria;
        }
        public function  setCategoria($categoria){
            $this->categoria = $categoria;
        }
        
        public function getFotoPro(){
            return $this->fotoProduto;
        }
        public function  setFotoPro($fotoProduto){
            $this->fotoProduto = $fotoProduto;
        }

    }
    ?>