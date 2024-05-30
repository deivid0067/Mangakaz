<?php
header('Location: carrinho.php');

    $idvetorcarrinho = $_GET['idproduto'];

    if (isset($_COOKIE["carrinho"])){
        $carrinhorecebido =  $_COOKIE["carrinho"]; 
        $carrinhoAtual = unserialize($carrinhorecebido);

        unset($carrinhoAtual[$idvetorcarrinho]);

        $carrinhocookie = serialize($carrinhoAtual);
        setcookie('carrinho', $carrinhocookie);
    }
?>