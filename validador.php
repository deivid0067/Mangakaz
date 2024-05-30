<?php

    require_once('global.php');
    session_start();

    try {  
        $isLogged;
            
        $dadosCliente = ClienteDao::listarLogin();

        $login = $_SESSION['login-session'];
        $senha = $_SESSION['senha-session'];
    
        foreach($dadosCliente as $clienteLogin){
            if($login == $clienteLogin['emailcliente'] && password_verify($senha, $clienteLogin['senhacliente'])){
                $isLogged=true;
            }
        }
        if(!$isLogged){
            header('Location: login.php');
        }

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        echo $e->getMessage();
    }