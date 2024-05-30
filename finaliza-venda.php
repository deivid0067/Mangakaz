<?php

    require_once 'global.php';
    header('Location: carrinho.php');
 

    session_start();
    
    if (isset($_COOKIE["carrinho"])){
        $carrinhorecebido =  $_COOKIE["carrinho"]; 
        $carrinhoAtual = unserialize($carrinhorecebido);

        $cliente = new Cliente();
        $cliente->setIdCliente($_SESSION['idcliente']);        
        $venda = new Venda();
        $venda->setCliente($cliente);
        $venda->setDataVenda(date('Y-m-d'));
        
        $venda->setListaItem($carrinhoAtual);
        $venda->setStatusVenda(1);
        $venda->setValortotalVenda($_GET['valortotal']);
        if($venda->getValortotalVenda() > 0) {

        VendaDao::cadastrar($venda);

        $venda->setIdVenda(VendaDao::consultarId($venda));

        foreach($venda->getListaItem() as $itemvenda){
            ItemVendaDao::cadastrar($itemvenda, $venda->getIdVenda());
        }

        unset($_COOKIE['carrinho']);
        setcookie('carrinho');
        header('Location: cliente/minhas.php');
    }else{
        session_start();
        $_SESSION['msg'] = "
        <div class='overlay'></div>

        <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
        <div class='modal-title'> O carrinho está vazio </div>
               
            
            <div class='row p-2'>
                <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
            </div>
        </div>";
    }
}
    else{
       
    }
    

?>