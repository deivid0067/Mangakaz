<?php

    require_once('global.php');

    try {  
        $isLogged;
            
        $dadosCliente = ClienteDao::listarLogin();

        $login = $_POST['txtLogin'];
        $senha = $_POST['txtSenha'];    

        foreach($dadosCliente as $clienteLogin){
            if($login == $clienteLogin['emailcliente'] && password_verify($senha, $clienteLogin['senhacliente'])){
                $isLogged=true;

                session_start();

                $_SESSION['login-session'] = $login;
                $_SESSION['senha-session'] = $senha;
                $_SESSION['idcliente'] = $clienteLogin['idcliente'];
                $_SESSION['nomecliente'] = $clienteLogin['nomecliente'];
                $_SESSION['logradourocliente'] = $clienteLogin['logradourocliente'];
                $_SESSION['numlogcliente'] = $clienteLogin['numlogcliente'];
                $_SESSION['compcliente'] = $clienteLogin['compcliente'];
                $_SESSION['bairrocliente'] = $clienteLogin['bairrocliente'];
                $_SESSION['cidadecliente'] = $clienteLogin['cidadecliente'];
                $_SESSION['ufcliente'] = $clienteLogin['ufcliente'];
                $_SESSION['cepcliente'] = $clienteLogin['cepcliente'];

                header("Location: index.php");
            }
        }

        if(!$isLogged){
            header("Location: login.php");

            session_start();
            $_SESSION['msg'] = "
                <div class='overlay'></div>
        
                <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
                    <div class='row p-3'>
                        Usuário ou senha incorretos.
                    </div>
                    <div class='row p-2'>
                        <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
                    </div>
                </div>";
        }

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        echo $e->getMessage();
    }


 