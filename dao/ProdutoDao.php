<?php

    include_once('global.php');

    class ProdutoDao{

        public static function cadastrar($produto){
            $conexao = Conexao::conectar();

            $queryInsert = "INSERT INTO tbproduto(nomeProduto, precoProduto, idCategoria, fotoProduto)
                            VALUES (?,?,?,?)";

            $prepareStatement = $conexao->prepare($queryInsert);

            $prepareStatement->bindValue(1, $produto->getNomePro());
            $prepareStatement->bindValue(2, $produto->getPrecoPro());
            $prepareStatement->bindValue(3, $produto->getCategoria()->getId());
            $prepareStatement->bindValue(4, $produto->getFotoPro());

            $prepareStatement->execute();

        }
        public static function delete($produto) {
            $conexao = Conexao::conectar();

            $queryDelete = ("DELETE FROM tbproduto WHERE idproduto = ?");
           
            $prepareStatement = $conexao->prepare($queryDelete);
            $prepareStatement->bindValue(1, $produto->getIdPro());
            $prepareStatement->execute();
        
          }

        public static function editar($produto)  {
            $conexao = Conexao::conectar();

            $queryUpdate = "UPDATE tbproduto SET nomeproduto = ?, precoProduto = ?, idcategoria = ?  WHERE idproduto = ?";
           
            $prepareStatement = $conexao->prepare($queryUpdate);
            $prepareStatement->bindValue(1, $produto->getNomePro());
            $prepareStatement->bindValue(2, $produto->getPrecoPro());
            $prepareStatement->bindValue(3, $produto->getCategoria()->getId());
            $prepareStatement->bindValue(4, $produto->getIdPro());

            echo($produto->getIdPro());

            $prepareStatement->execute();         
        }

        public static function editarImg($produto){
            $conexao = Conexao::conectar();

            $queryUpdate = "UPDATE tbproduto set fotoproduto = ? WHERE idproduto = ?";

            $prepareStatement = $conexao->prepare($queryUpdate);
            $prepareStatement->bindValue(1, $produto->getFotoPro());
            $prepareStatement->bindValue(2, $produto->getIdPro());
            
            echo($produto->getFotoPro());

            $prepareStatement->execute();
        }

        public static function listar()  {
           $conexao = Conexao::conectar();

            $querySelect = "SELECT idproduto, nomeProduto, precoProduto, nomeCategoria, fotoProduto, tbProduto.idCategoria FROM tbProduto
                            INNER JOIN tbCategoria ON tbCategoria.idCategoria = tbProduto.idCategoria
                            ORDER BY idProduto";
           
            $result = $conexao->prepare($querySelect);
            $result->execute();
            $lista = $result->fetchAll();
            return $lista;
        }

        public static function listarRec()  {
            $conexao = Conexao::conectar();
 
             $querySelect = "SELECT idProduto, nomeProduto, precoProduto, nomeCategoria, fotoProduto, tbProduto.idCategoria FROM tbProduto
                             INNER JOIN tbCategoria ON tbCategoria.idCategoria = tbProduto.idCategoria
                             ORDER BY idProduto DESC";
            
             $result = $conexao->prepare($querySelect);
             $result->execute();
             $lista = $result->fetchAll();
             return $lista;
         }
 

        public static function pesquisaCategoria($produto){

            $conexao = Conexao::conectar();

            $querySelect = "SELECT idproduto, nomeProduto, precoProduto, fotoProduto FROM tbProduto WHERE idcategoria = ? ";

            $result = $conexao->prepare($querySelect);

            $result->bindValue(1, $produto->getCategoria()->getId());

            $result->execute();
            $lista = $result->fetchAll();

            return $lista;
        }


        public static function pesquisaNome($produto){

            $conexao = Conexao::conectar();

            $querySelect = "SELECT idproduto, nomeProduto, precoProduto, fotoProduto FROM tbProduto WHERE nomeProduto LIKE ? ";

            $result = $conexao->prepare($querySelect);

            $result->bindValue(1, "%".$produto->getNomePro()."%");

            $result->execute();
            $lista = $result->fetchAll();

            return $lista;
        }

        
        public static function pesquisaNomeCategoria($produto){

            $conexao = Conexao::conectar();

            $querySelect = "SELECT idproduto, nomeProduto, precoProduto, fotoProduto FROM tbProduto WHERE idcategoria = ? AND nomeProduto LIKE ? ";

            $result = $conexao->prepare($querySelect);

            $result->bindValue(1, $produto->getCategoria()->getId());
            $result->bindValue(2, "%".$produto->getNomePro()."%");

            $result->execute();
            $lista = $result->fetchAll();

            return $lista;
        }

        public static function consultarDados($produto){
            $conexao = Conexao::conectar();

            $querySelectt = "SELECT nomeproduto, precoproduto, fotoproduto
                             FROM tbproduto WHERE idproduto = ".$produto->getIdPro();
            $result = $conexao->query($querySelectt);
            $lista = $result->fetchAll();
            foreach ($lista as $p){
                $produto->setNomePro($p['nomeproduto']);
                $produto->setPrecoPro($p['precoproduto']);
                $produto->setFotoPro($p['fotoproduto']);
            }
            return $produto;   
        }

        public static function consultaMaisVendido(){
            $conexao = Conexao::conectar();

            $querySelect = "SELECT nomeproduto, COUNT(iditemvenda) qtde FROM tbproduto
                            INNER JOIN tbitemvenda ON tbproduto.idproduto = tbitemvenda.idproduto
                            ORDER BY qtde
                            DESC LIMIT 1";
            $result = $conexao->query($querySelect);

            $nome = $result->fetchAll();

            foreach ($nome as $n)
                return $n['nomeproduto'];   

        }


    }

?>