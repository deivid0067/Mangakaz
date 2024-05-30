<?php

    header('Location: ./index.php');
    require_once('global.php');

    $Cliente = new Cliente();
    $Cliente->setIdCliente($_POST['idClienteEdit1']);
    $Cliente->setCepCliente(($_POST['txtCepCliente1']));
    $Cliente->setLogradouroCliente(($_POST['txtLogradouroCliente1']));
    $Cliente->setNumLogCliente(($_POST['txtNumLogCliente1']));
    $Cliente->setCompCliente(($_POST['txtComplementoCliente1']));
    $Cliente->setBairroCliente(($_POST['txtBairroCliente1']));
    $Cliente->setCidadeCliente(($_POST['txtCidadeCliente1']));
    $Cliente->setUfCliente(($_POST['txtUFCliente1']));
   
    ClienteDao::editarCep($Cliente);      
?>
