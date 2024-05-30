<?php

    header('Location: ./index.php');
    require_once('global.php');

    $cliente = new Cliente();
    $cliente->setIdCliente($_POST['idClienteEdit12']);
    $senha = password_hash($_POST['txtSenha'], PASSWORD_DEFAULT);
    $cliente->setSenhaCliente($senha);

    $clienteController = new ClienteController($cliente);
    $lista = ClienteDao::listar();

    ClienteDao::editarSenha($cliente);
