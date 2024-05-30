<?php
  
require_once 'global.php';

    class VendaDao{

        public static function cadastrar($venda){
            $conexao = Conexao::conectar();

            $queryInsert = "INSERT INTO tbvenda(datavenda, valortotalvenda, statusvenda, idcliente )
                            VALUES (?,?,?,?)";

            $prepareStatement = $conexao->prepare($queryInsert);

            $prepareStatement->bindValue(1, $venda->getDataVenda());
            $prepareStatement->bindValue(2, $venda->getValortotalVenda());
            $prepareStatement->bindValue(3, $venda->getStatusVenda());
            $prepareStatement->bindValue(4, $venda->getCliente()->getIdCliente());

            $prepareStatement->execute();
            

        }
        public static function inserirItem($itemVenda) {
            $conexao = Conexao::conectar();

            $queryInsertItem = "INSERT INTO tbitemVenda(qtdintemvenda, subtotalItemVendao, idproduto, idvenda )
            VALUES (?,?,?,?)";
           
            $prepareStatement = $conexao->prepare($queryInsertItem);
            $prepareStatement->bindValue(1, $itemVenda->getqtdintemvenda());
            $prepareStatement->bindValue(2, $itemVenda->getsubtotalItemVendao());
            $prepareStatement->bindValue(3, $itemVenda->getProduto()->getIdPro());
            $prepareStatement->bindValue(4, $itemVenda->getVenda()->getIdVenda());
            $prepareStatement->execute();
         
          }

          public static function removerItem($itemVenda){

            $conexao = Conexao::conectar();

            $queryDelete = "DELETE tbItemVenda WHERE idVenda = ?";
            $prepareStatement = $conexao->prepare($queryDelete);
            $prepareStatement->bindValue(1, $itemVenda->getVenda()->getIdVenda());
            $prepareStatement->execute();

          }

          public static function cancelar($venda){
              $conexao = Conexao::conectar();

              $queryDelete = "DELETE tbVenda WHERE idVenda = ?";
              $prepareStatement = $conexao->prepare($queryDelete);
              $prepareStatement->bindValue(1, $venda->getIdVenda());
              $prepareStatement->execute();
          }

         

          public static function listarTodas(){
            $conexao = Conexao::conectar();

            $querySelect = "SELECT idVenda, DATE_FORMAT(datavenda, '%d/%m/%Y') AS datavenda, 
            valortotalvenda, statusvenda, v.idcliente, nomecliente 
            FROM tbvenda v INNER JOIN tbcliente c 
            ON v.idcliente = c.idcliente 
            ORDER BY datavenda DESC";

            $result = $conexao->prepare($querySelect);
            $result->execute();
            $lista = $result->fetchAll();

            return $lista;

          }
        
          public static function listarVenda($venda){
            $conexao = Conexao::conectar();

            $querySelect = "SELECT idVenda, datavenda, valortotalvenda, statusvenda, idcliente FROM tbVenda WHERE idVenda = ?";

            $result = $conexao->prepare($querySelect);
            $result->bindValue(1, $venda->getIdVenda());
            $result->execute();
            $lista = $result->fetch();

            return $lista;
          }
          public static function consultarId($venda){
            $conexao = Conexao::conectar();
            $querySelect = "SELECT idVenda FROM tbVenda WHERE idCliente LIKE '".$venda->getCliente()->getIdCliente()."'";
            $resultado = $conexao->query($querySelect);
            $lista = $resultado->fetchAll();
            foreach ($lista as $venda)
                $id = $venda['idVenda'];
            return $id;   
        }

        
        public static function listarPorCliente($cliente){
          $conexao = Conexao::conectar();
          $querySelect = "SELECT idVenda, DATE_FORMAT(datavenda, '%d/%m/%Y') AS datavenda, 
                          valortotalvenda, statusvenda, v.idcliente, nomecliente 
                          FROM tbvenda v INNER JOIN tbcliente c 
                          ON v.idcliente = c.idcliente 
                          WHERE v.idcliente = ".$cliente->getIdcLIENTE()."
                          ORDER BY datavenda DESC";
          $resultado = $conexao->query($querySelect);
          $lista = $resultado->fetchAll();
          return $lista;   
      }


      public static function atualizarStatus($venda){
        $conexao = Conexao::conectar();

        $queryInsert = "UPDATE tbvenda 
                        SET statusvenda = ?
                        WHERE idvenda = ?";
        
        $prepareStatement = $conexao->prepare($queryInsert);
        
        $prepareStatement->bindValue(1, $venda->getStatusVenda());
        $prepareStatement->bindValue(2, $venda->getIdVenda());

        $prepareStatement->execute();
        return 'Atualizou';
    }

    public static function contarPedido(){
      $conexao = Conexao::conectar();
      $querySelect = "SELECT COUNT(idvenda) AS qtde FROM tbvenda WHERE statusvenda = 1";
      $resultado = $conexao->query($querySelect);
      $num = $resultado->fetchAll();
      foreach ($num as $n)
          return $n['qtde'];   
  }
    }

?>