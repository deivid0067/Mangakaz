<?php

    require_once 'global.php';

    header("Location: vendas.php");
    
    $venda = new Venda();
    $venda->setIdVenda($_POST['idvendaModal']);
    $venda->setStatusVenda($_POST['status']);

    VendaDao::atualizarStatus($venda);

?>