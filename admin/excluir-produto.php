<?php

     header('Location: produtos.php');

    require_once('global.php');

    $produto = new Produto();
    $produto->setIdPro($_POST['idProduto']);

    $con = Conexao::conectar();

   for($i=0;$i<count(ProdutoDao::listar());$i++){
        if(($produto->getIdPro()) == (ProdutoDao::listar()[$i][0])) {
            $consul = $con->query('SELECT fotoProduto FROM tbProduto WHERE idProduto = '.$produto->getIdPro())->fetch();
            break;
        }
    } 

    ProdutoDao::delete($produto);
    
    session_start();
    $_SESSION['msg'] = "
    <div class='overlay' onclick='msgErro()'></div>

    <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
        <div class='row p-2'>
            Produto excluido com sucesso
        </div>
        <div class='row p-2'>
            <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
        </div>
    </div>";
    unlink('../'.$consul[0]);
?>