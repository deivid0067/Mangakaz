<?php
    require_once 'Produto.php';

    class ItemVenda{
        private $iditemvenda;
        private $qtditemvenda;
        private $subtotalitemvenda, $produto;
        public function __construct(){
            $this->produto = new Produto();
        }
        public function getIdItemVenda(){
            return $this->iditemvenda;
        }
        public function getqtdItemVenda(){
            return $this->qtditemvenda;
        }
        public function getsubtotalItemVenda(){
            return $this->subtotalitemvenda;
        }
        public function  setIdItemVenda($iditemvenda){
            $this->iditemvenda = $iditemvenda;
        }
        
        public function setqtdItemVenda($qtditemvenda){
            $this->qtditemvenda = $qtditemvenda;
        }
        public function setsubtotalItemVenda($subtotalitemvenda) {
            $this->subtotalitemvenda = $subtotalitemvenda;
        }
        public function getProduto(){
            return $this->produto;
        }
        public function  setProduto($produto){
            $this->produto = $produto;
        }
        public function getVenda(){
            return $this->venda;
        }
        public function  setVenda($venda){
            $this->venda = $venda;
        }

    }
    ?>