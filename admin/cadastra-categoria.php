<?php

    header('Location: categorias.php');

    require_once('global.php');

    
    $categoria = new Categoria();
    $categoria->setNomeCategoria($_POST['txtNomeCategoria']);

    $categoriaController = new CategoriaController($categoria);

    $lista = CategoriaDao::listar();

    if(!$categoriaController->validaNome($categoria, $lista)){
        CategoriaDao::cadastrar($categoria);

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
        session_start();
        $_SESSION['msg'] = "
        <div class='overlay'></div>

        <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
            <div class='row p-2'>
                Eita, parece que já tem uma categoria com esse nome...
            </div>
            <div class='row p-2'>
                <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
            </div>
        </div>";
    }
?>