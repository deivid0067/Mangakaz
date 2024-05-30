<?php
    header("Location: categorias.php");

    require_once('global.php');

    $categoria = new Categoria();
    $categoria->setId($_POST['idCat']);

    $alreadyExists = false;
    for($i=0;$i<count(ProdutoDao::listar());$i++){
        if(($categoria->getId()) == (ProdutoDao::listar()[$i][5])) {
            $alreadyExists=true;
            session_start();
            $_SESSION['msg'] = "
            <div class='overlay'></div>
    
            <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
                <div class='row p-2'>
                    Ops, parece que existem produtos com essa categoria.
                </div>
                <div class='row p-2'>
                    <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
                </div>
            </div>";
            break;
        }else{
            $alreadyExists=false;
        }
    }
    if(!$alreadyExists){
        CategoriaDao::delete($categoria);
        
        session_start();
        $_SESSION['msg'] = "
        <div class='overlay' onclick='msgErro()'></div>

        <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
            <div class='row p-2'>
                Categoria excluida com sucesso
            </div>
            <div class='row p-2'>
                <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
            </div>
        </div>";
    }
?>