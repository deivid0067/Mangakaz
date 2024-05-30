<?php

require_once('global.php');


$produto = new Produto();

$produto->setIdPro($_POST['idProdutoEdit']);
$produto->setNomePro($_POST['txtNomeProdutoEdit']);
$produto->setPrecoPro($_POST['txtPrecoProdutoEdit']);

$categoria = new Categoria();

$categoria->setId($_POST['slCategoriaEdit']);
$produto->setCategoria($categoria);

$upload=false;

if (is_uploaded_file($_FILES['imgProdutoEdit']['tmp_name'])) {
    $upload = true;
    $arquivo = "images/products/" . basename($_FILES['imgProdutoEdit']['name']);

    if (file_exists("../" . $arquivo)) {
        $upload = false;
    }

    $produto->setFotoPro($arquivo);
}

$produtoController = new ProdutoController($produto);

$produtos = ProdutoDao::listar();

if ($produtoController->validaPreco($produto) && !$produtoController->validaNome($produto, $produtos)) {

    ProdutoDao::editar($produto);

    if($upload){
        move_uploaded_file($_FILES['imgProdutoEdit']['tmp_name'], "../" . $arquivo);

        $con = Conexao::conectar();
    
        for ($i = 0; $i < count(ProdutoDao::listar()); $i++) {
            if (($produto->getIdPro()) == (ProdutoDao::listar()[$i][0])) {
                $consul = $con->query('SELECT fotoProduto FROM tbProduto WHERE idProduto = ' . $produto->getIdPro())->fetch();
                break;
            }
        }
        
        unlink('../' . $consul[0]);
        ProdutoDao::editarImg($produto);
        
    }

    session_start();
    $_SESSION['msg'] = "
        <div class='overlay'></div>

        <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
            <div class='row p-2'>
                Edição realizada com sucesso
            </div>
            <div class='row p-2'>
                <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
            </div>
        </div>";
} else {
    if (!$produtoController->validaPreco($produto)) {
        $msg = "Ops, parece que o preço está abaixo de 0.";
    }else if($produtoController->validaNome($produto, $produtos)){
        $msg = "Ops, parece que esse produto já existe.";
    } else {
        $msg = "Ops, essa imagem já pertence a um produto.";
    }
    session_start();
    $_SESSION['msg'] = "
        <div class='overlay''></div>

        <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
            <div class='row p-2'>
            " . $msg . "
            </div>
            <div class='row p-2'>
                <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
            </div>
        </div>";
}
