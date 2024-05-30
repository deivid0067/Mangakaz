<?php

    require_once('global.php');

    class ClienteDao{

        public static function cadastrar($cliente){
            $conexao = Conexao::conectar();

            $queryInsert = "INSERT INTO tbcliente(nomecliente, cpfcliente, emailcliente, senhacliente, logradourocliente, numlogcliente, compcliente, bairrocliente, cidadecliente, ufcliente, cepcliente)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            $prepareStatement = $conexao->prepare($queryInsert);

            $prepareStatement->bindValue(1, $cliente->getNomeCliente());
            $prepareStatement->bindValue(2, $cliente->getCpfCliente());
            $prepareStatement->bindValue(3, $cliente->getEmailCliente());
            $prepareStatement->bindValue(4, $cliente->getSenhaCliente());
            $prepareStatement->bindValue(5, $cliente->getLogradouroCliente());
            $prepareStatement->bindValue(6, $cliente->getNumLogCliente());
            $prepareStatement->bindValue(7, $cliente->getCompCliente());
            $prepareStatement->bindValue(8, $cliente->getBairroCliente());
            $prepareStatement->bindValue(9, $cliente->getCidadeCliente());
            $prepareStatement->bindValue(10, $cliente->getUfCliente());
            $prepareStatement->bindValue(11, $cliente->getCepCliente());
           
            $prepareStatement->execute();
           
        }
        public static function delete($cliente) {
            $conexao = Conexao::conectar();

            $queryDelete = "DELETE FROM tbcliente WHERE idcliente = ?";
           
            $prepareStatement = $conexao->prepare($queryDelete);
            $prepareStatement->bindValue(1, $cliente->getIdCliente());
           
            $prepareStatement->execute();
           
          }

        public static function editar($cliente)  {
            $conexao = Conexao::conectar();

            $queryUpdate = "UPDATE tbcliente SET nomecliente = ?, cpfcliente = ?, emailcliente = ?, senhacliente = ?, logradourocliente = ?, numlogcliente = ?, compcliente = ?, bairrocliente = ?, cidadecliente = ?, ufcliente = ?, cepcliente = ?  WHERE idcliente = ?";
           
            $prepareStatement = $conexao->prepare($queryUpdate);
            $prepareStatement->bindValue(1, $cliente->getNomeCliente());
            $prepareStatement->bindValue(2, $cliente->getCpfCliente());
            $prepareStatement->bindValue(3, $cliente->getEmailCliente());
            $prepareStatement->bindValue(4, $cliente->getSenhaCliente());
            $prepareStatement->bindValue(5, $cliente->getLogradouroCliente());
            $prepareStatement->bindValue(6, $cliente->getNumLogCliente());
            $prepareStatement->bindValue(7, $cliente->getCompCliente());
            $prepareStatement->bindValue(8, $cliente->getBairroCliente());
            $prepareStatement->bindValue(9, $cliente->getCidadeCliente());
            $prepareStatement->bindValue(10, $cliente->getUfCliente());
            $prepareStatement->bindValue(11, $cliente->getCepCliente());
            $prepareStatement->bindValue(12, $cliente->getIdCliente());


            $prepareStatement->execute();
           
        }
        public static function editarCep($cliente)  {
            $conexao = Conexao::conectar();

            $queryUpdateCep = "UPDATE tbcliente SET logradourocliente = ?, numlogcliente = ?, compcliente = ?, bairrocliente = ?, cidadecliente = ?, ufcliente = ?, cepcliente = ?  WHERE idcliente = ?";
           
            $prepareStatement = $conexao->prepare($queryUpdateCep);
            
            $prepareStatement->bindValue(1, $cliente->getLogradouroCliente());
            $prepareStatement->bindValue(2, $cliente->getNumLogCliente());
            $prepareStatement->bindValue(3, $cliente->getCompCliente());
            $prepareStatement->bindValue(4, $cliente->getBairroCliente());
            $prepareStatement->bindValue(5, $cliente->getCidadeCliente());
            $prepareStatement->bindValue(6, $cliente->getUfCliente());
            $prepareStatement->bindValue(7, $cliente->getCepCliente());
            $prepareStatement->bindValue(8, $cliente->getIdCliente());


            $prepareStatement->execute();
           
        }
        public static function editarEmail($cliente)  {
            $conexao = Conexao::conectar();

            $queryUpdateEmail = "UPDATE tbcliente SET emailcliente = ? WHERE idcliente = ?";
           
            $prepareStatement = $conexao->prepare($queryUpdateEmail);
           
            $prepareStatement->bindValue(1, $cliente->getEmailCliente());
          
            $prepareStatement->bindValue(2, $cliente->getIdCliente());


            $prepareStatement->execute();
           
        }
        public static function editarSenha($cliente)  {
            $conexao = Conexao::conectar();

            $queryUpdateSenha = "UPDATE tbcliente SET senhacliente = ? WHERE idcliente = ?";
           
            $prepareStatement = $conexao->prepare($queryUpdateSenha);
           
            $prepareStatement->bindValue(1, $cliente->getSenhaCliente());          
            $prepareStatement->bindValue(2, $cliente->getIdCliente());

            $prepareStatement->execute();
           
        }

        public static function listar()  {
           $conexao = Conexao::conectar();

            $querySelect = "SELECT idcliente, nomecliente, cpfcliente, emailcliente, logradourocliente, numlogcliente, compcliente, bairrocliente, cidadecliente, ufcliente, cepcliente FROM tbcliente";
           
            $result = $conexao->prepare($querySelect);
            $result->execute();
            $lista = $result->fetchAll();
            return $lista;
        }
        public static function listarLogin()  {
            $conexao = Conexao::conectar();
 
             $querySelect = "SELECT idcliente, nomecliente, senhacliente, emailcliente, logradourocliente, numlogcliente, compcliente, bairrocliente, cidadecliente, ufcliente, cepcliente FROM tbcliente";
            
             $result = $conexao->prepare($querySelect);
             $result->execute();
             $lista = $result->fetchAll();
             return $lista;
         }

         public static function contarClientes(){
            $conexao = Conexao::conectar();

            $querySelect = "SELECT COUNT(idCliente) as qtde FROM tbCliente";

            $resultado = $conexao->query($querySelect);

            $num = $resultado->fetchAll();

            foreach ($num as $n)
            return $n['qtde'];   
         }

         public static function clienteMaisComprou(){
            $conexao = Conexao::conectar();

            $querySelect = "SELECT nomecliente, COUNT(idvenda) FROM tbcliente
                            INNER JOIN tbvenda ON tbcliente.idcliente = tbvenda.idcliente
                            LIMIT 1";
            $result = $conexao->query($querySelect);

            $nome = $result->fetchAll();

            foreach ($nome as $n)
                return $n['nomecliente'];   

        }


    }

?>