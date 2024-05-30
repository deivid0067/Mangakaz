<?php

    require_once('../model/Categoria.php');

    class CategoriaController{

        public $categoria;

        public function __construct($categoria){
            $this->categoria = $categoria;
        }
        
        public function validaNome($categoria, $nomesCategoria) {
            $alreadyExists = false;

            for($i=0;$i<count($nomesCategoria);$i++){
                if(strtoupper($categoria->getNomeCategoria()) == strtoupper($nomesCategoria[$i][1]) && $categoria->getId() != $nomesCategoria[$i][0]) {
                    $alreadyExists=true;
                    break;
                }
            }
            return $alreadyExists;
        }



    }

?>