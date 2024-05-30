<?php

include_once('global.php');

    class CategoriaDao{

        public static function cadastrar($categoria){

            $conexao = Conexao::conectar();

            $queryInsert = "INSERT INTO tbcategoria(nomecategoria)
                            VALUES (?)";
            $prepareStatement = $conexao->prepare($queryInsert);
            $prepareStatement->bindValue(1, $categoria->getNomeCategoria());

            $prepareStatement->execute();
         
        }
        public static function delete($categoria) {
            $conexao = Conexao::conectar();

            $queryDelete = "DELETE FROM tbcategoria WHERE idcategoria = ?";
           
            $prepareStatement = $conexao->prepare($queryDelete);
            $prepareStatement->bindValue(1, $categoria->getId());
            $prepareStatement->execute();
        
          }

        public static function editar($categoria)  {
            $conexao = Conexao::conectar();

            $queryUpdate = "UPDATE tbcategoria SET nomecategoria = ? WHERE idcategoria = ?";
           
            $prepareStatement = $conexao->prepare($queryUpdate);
            $prepareStatement->bindValue(1, $categoria->getNomeCategoria());
            $prepareStatement->bindValue(2, $categoria->getId());


            $prepareStatement->execute();
         
        }
        public static function listar()  {
           $conexao = Conexao::conectar();

            $querySelect = "SELECT idcategoria, nomecategoria FROM tbcategoria";
           
            $result = $conexao->prepare($querySelect);
            $result->execute();
            $lista = $result->fetchAll();
            
            return $lista;
        }

        public static function contarProduto(){
            $conexao = Conexao::conectar();

            $querySelect = "SELECT nomecategoria, COUNT(idproduto) as qtde FROM tbcategoria
                            INNER JOIN tbproduto ON tbproduto.idcategoria = tbcategoria.idcategoria
                            GROUP BY nomecategoria";
            $result = $conexao->query($querySelect);

            $lista = $result->fetchAll();

            return $lista;

        }
    }
?>