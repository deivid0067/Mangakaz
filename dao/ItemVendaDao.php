<?php


require_once 'global.php';
    
    class ItemVendaDao{

        public static function cadastrar($item, $idvenda){
            $conexao = Conexao::conectar();

            $queryInsert = "INSERT INTO tbitemvenda(idvenda, idproduto, qtdeitemvenda, subtotalitemvenda)
                             VALUES(?,?,?,?)";
            
            $prepareStatement = $conexao->prepare($queryInsert);
            
            $prepareStatement->bindValue(1, $idvenda);
            $prepareStatement->bindValue(2, $item->getProduto()->getIdPro());
            $prepareStatement->bindValue(3, $item->getqtdItemVenda());
            $prepareStatement->bindValue(4, $item->getsubtotalItemVenda());

            $prepareStatement->execute();
            return 'Cadastrou';
        }

        public static function listar(){
            $conexao = Conexao::conectar();
            $querySelect = "SELECT idvenda, idproduto, fotoproduto, qtdeitemvenda, subtotalitemvenda FROM tbitemvenda";
            $resultado = $conexao->query($querySelect);
            $lista = $resultado->fetchAll();
            return $lista;   
        }

        public static function listarPorVenda($idvenda){
            $conexao = Conexao::conectar();
            $querySelect = "SELECT idvenda, tbitemvenda.idproduto, nomeproduto, fotoproduto, qtdeitemvenda, subtotalitemvenda FROM tbitemvenda
                            INNER JOIN tbproduto ON tbproduto.idproduto=tbitemvenda.idproduto
                            WHERE idVenda = ".$idvenda;
            $resultado = $conexao->query($querySelect);
            $lista = $resultado->fetchAll();
            return $lista;   
        }

        public static function contar(){
            // $conexao = Conexao::conectar();
            // $querySelect = "SELECT COUNT(idcliente) AS qtde FROM tbcliente";
            // $resultado = $conexao->query($querySelect);
            // $num = $resultado->fetchAll();
            // foreach ($num as $n)
            //     return $n['qtde'];   
        }

        public static function contarProdutoVenda(){
            $conexao = Conexao::conectar();
            $querySelect = "SELECT idproduto, COUNT(iditemvenda) AS qtde FROM tbitemvenda GROUP BY idproduto ORDER BY qtde DESC";
            $resultado = $conexao->query($querySelect);
            $lista = $resultado->fetchAll();
            foreach ($lista as $cliente)
                return $cliente['idproduto'];   
        }
    }
?>

?>