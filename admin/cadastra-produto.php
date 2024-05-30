<?php

    header('Location: produtos.php');
    require_once('global.php');


    $produto = new Produto();

    $produto->setNomePro($_POST['txtNomeProduto']);
    $produto->setPrecoPro($_POST['txtPrecoProduto']);

    $categoria = new Categoria();

    $categoria->setId($_POST['slCategoria']);
    $produto->setCategoria($categoria);
    
    $upload=true;
    $arquivo = "images/products/" . basename($_FILES['imgProduto']['name']);

    if(file_exists("../".$arquivo)){
        $upload=false;
    }

    $produto->setFotoPro($arquivo);

    $produtoController = new ProdutoController($produto);

    $produtos = ProdutoDao::listar();

    if($produtoController->validaPreco($produto) && !$produtoController->validaNome($produto, $produtos) && $upload){

        ProdutoDao::cadastrar($produto);
        move_uploaded_file($_FILES['imgProduto']['tmp_name'], "../".$arquivo);

        session_start();
        $_SESSION['msg'] = "
        <div class='overlay'></div>

        <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
            <div class='row p-2'>
                Cadastro realizado com sucesso
            </div>
            <div class='row p-2'>
                <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
            </div>
        </div>";

    }else{
        if(!$produtoController->validaPreco($produto)){
            $msg = "Ops, parece que o preço está abaixo de 0.";
        }else if($produtoController->validaNome($produto, $produtos)){
            $msg = "Ops, parece que esse produto já existe.";
        }else{
            $msg = "Ops, essa imagem já pertence a um produto.";
        }
        session_start();
        $_SESSION['msg'] = "
        <div class='overlay''></div>

        <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
            <div class='row p-2'>
            ".$msg."
            </div>
            <div class='row p-2'>
                <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
            </div>
        </div>";
    }


?>