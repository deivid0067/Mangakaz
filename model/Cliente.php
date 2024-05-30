<?php

    class Cliente{
        private $idcliente;
        private $nomecliente;
        private $cpfcliente;
        private $emailcliente;
        private $senhacliente;
        private $logradourocliente;
        private $numlogcliente;
        private $compcliente;
        private $bairrocliente;
        private $cidadecliente;
        private $ufcliente;
        private $cepcliente;


        public function getIdCliente(){
            return $this->idcliente;
        }
        public  function getNomeCliente(){
            return $this->nomecliente;
        }
        public  function getCpfCliente(){
            return $this->cpfcliente;
        }
        public  function getEmailCliente(){
            return $this->emailcliente;
        }
        public function getSenhaCliente(){
            return $this->senhacliente;
        }
        public  function getLogradouroCliente(){
            return $this->logradourocliente;
        }
        public  function getNumLogCliente(){
            return $this->numlogcliente;
        }
        public  function getCompCliente(){
            return $this->compcliente;
        }
        public function getBairroCliente(){
            return $this->bairrocliente;
        }
        public  function getCidadeCliente(){
            return $this->cidadecliente;
        }
        public  function getUfCliente(){
            return $this->ufcliente;
        }
        public  function getCepCliente(){
            return $this->cepcliente;
        }
        public function  setIdCliente($idcliente) {
            $this->idcliente = $idcliente;
        }
        public function setNomeCliente( $nomecliente){
            $this->nomecliente = $nomecliente;
        }
        public function setCpfCliente( $cpfcliente){
            $this->cpfcliente = $cpfcliente;
        }
        public function setEmailCliente( $emailcliente){
            $this->emailcliente = $emailcliente;
        }
        public function  setSenhaCliente($senhacliente) {
            $this->senhacliente = $senhacliente;
        }
        public function setLogradouroCliente( $logradourocliente){
            $this->logradourocliente = $logradourocliente;
        }
        public function setNumLogCliente( $numlogcliente){
            $this->numlogcliente = $numlogcliente;
        }
        public function setCompCliente( $compcliente){
            $this->compcliente = $compcliente;
        }
        public function setBairroCliente( $bairrocliente){
            $this->bairrocliente = $bairrocliente;
        }
        public function  setCidadeCliente($cidadecliente) {
            $this->cidadecliente = $cidadecliente;
        }
        public function setUfCliente( $ufcliente){
            $this->ufcliente = $ufcliente;
        }
        public function setCepCliente( $cepcliente){
            $this->cepcliente = $cepcliente;
        }

    }
    ?>