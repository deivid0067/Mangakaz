<?php

    class Venda{
        private $idvenda;
        private $datavenda;
        private $valortotalvenda;
        private $statusvenda;
        private $listaitemvenda = [];

        public function getIdVenda(){
            return $this->idvenda;
        }
        public  function getDataVenda(){
            return $this->datavenda;
        }
        public  function getValortotalVenda(){
            return $this->valortotalvenda;
        }
        public  function getStatusVenda(){
            return $this->statusvenda;
        }
        public function  setIdVenda($idvenda) {
            $this->idvenda = $idvenda;
        }
        public function setDataVenda($datavenda){
            $this->datavenda = $datavenda;
        }
        public function setValortotalVenda($valortotalvenda){
            $this->valortotalvenda = $valortotalvenda;
        }
        public function setStatusVenda($statusvenda){
            $this->statusvenda = $statusvenda;
        }
        public function getCliente(){
            return $this->cliente;
        }
        public function  setCliente($cliente){
            $this->cliente = $cliente;
        }
        public function getListaItem(){
            return $this->listaitemvenda;
        }
        public function setListaItem($listaitemvenda){
            $this->listaitemvenda = $listaitemvenda;
        }
    }
    ?>