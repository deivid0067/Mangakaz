<?php

    require_once('global.php');

    $Cliente = new Cliente();
    $Cliente->setIdCliente($_POST['idClienteEdit']);
    $Cliente->setEmailCliente(($_POST['txtEmail']));

    $ClienteController = new ClienteController($Cliente);

    try {
        $clientes = ClienteDao::listar();

        if (!$ClienteController->validaEmail($Cliente, $clientes)) {
            ClienteDao::editarEmail($Cliente);
        } else if ($ClienteController->validaEmail($Cliente, $clientes)) {
            $msg = "Cadastro não foi realizado pois já existe um usuario com esse email";
        }
        $_SESSION['msg'] = "
                <div class='overlay'></div>
    
                <div class='position-fixed translate-middle start-50 bg-white text-center' id='mensagemErro'>
                    <div class='row p-2'>
                    " . $msg . "
                    </div>
                    <div class='row p-2'>
                        <input type='button' onclick='msgErro()' value='OK' id='msgErro'>
                    </div>
                </div>";    
    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        echo $e->getMessage();
    }

    