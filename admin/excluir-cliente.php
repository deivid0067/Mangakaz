<?php

    header('Location: ../logout.php');

    require_once('global.php');

    $cliente = new Cliente();
    $cliente->setIdCliente($_POST['idClienteEdit3']);

    
    ClienteDao::delete($cliente);
    
       
    session_start();
    $_SESSION['msg'] = "
    <div class='overlay' onclick='msgErro()'></div>

    <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
        <div class='row p-2'>
            Cliente excluido com sucesso
        </div>
        <div class='row p-2'>
            <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
        </div>
    </div>";
    unlink('../'.$consul[0]);
?>