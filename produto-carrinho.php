<?php
    require_once('global.php');
    header("Location: catalogo.php");

    $produto = new Produto();
    $produto->setIdPro($_GET['idproduto']);
    $produto = ProdutoDao::consultarDados($produto);

    $item = new ItemVenda();
    $item->setqtdItemVenda(1);
    $item->setProduto($produto);
    $item->setsubtotalItemVenda($item->getqtdItemVenda() * $item->getProduto()->getPrecoPro());

    if (isset($_COOKIE["carrinho"])){
        $carrinhorecebido =  $_COOKIE["carrinho"]; 
        $carrinhoAtual = unserialize($carrinhorecebido);

        $found = false;

        foreach($carrinhoAtual as $idvetorcarrinho => $carr){
            if($item->getProduto()->getIdPro() == $carr->getProduto()->getIdPro()){
                $carrinhoAtual[$idvetorcarrinho]->setqtdItemVenda($carrinhoAtual[$idvetorcarrinho]->getqtdItemVenda()+1);
                $carrinhoAtual[$idvetorcarrinho]->setsubtotalItemVenda($carrinhoAtual[$idvetorcarrinho]->getqtdItemVenda()*$item->getProduto()->getPrecoPro());
                $found=true;
                break;
            }
        }

        if(!$found){
            $carrinhoAtual[]=$item;
        }

        $carrinhocookie = serialize($carrinhoAtual);
        setcookie('carrinho', $carrinhocookie);
    }
    else{
        $carrinho = array();

        $carrinho[] = $item;

        $carrinhocookie = serialize($carrinho);
        setcookie('carrinho', $carrinhocookie);

        // echo '<pre>';
        //      print_r($carrinho);
        // echo '</pre>';
    }

?>