<?php

    require_once('../model/Produto.php');

    class ProdutoController{

        public $produto;

        public function __construct($produto){
            $this->produto = $produto;
        }

        public function validaPreco($produto){
            if($produto->getPrecoPro()>0){
                return true;
            }else{
                return false;
            }
        }
        
        public function validaNome($produto, $nomesProduto) {
            $alreadyExists = false;

            for($i=0;$i<count($nomesProduto);$i++){
                if(strtoupper($produto->getNomePro()) == strtoupper($nomesProduto[$i][1]) && $produto->getIdPro() != $nomesProduto[$i][0]) {
                    $alreadyExists=true;
                    break;
                }
                   
            }
            return $alreadyExists;
        }


    }

?>