<?php
header('Location: ../cadastro.php');

require_once('global.php');

$cliente = new Cliente();
$cliente->setNomeCliente($_POST['txtCadastroCliente']);
$cliente->setCpfCliente($_POST['txtCpfCliente']);
$cliente->setEmailCliente($_POST['txtEmailCliente']);

$senha = password_hash($_POST['txtSenhaCadastro'], PASSWORD_DEFAULT);

$cliente->setSenhaCliente($senha);
$cliente->setLogradouroCliente($_POST['txtLogradouroCliente']);
$cliente->setNumLogCliente($_POST['txtNumLogCliente']);
$cliente->setCompCliente($_POST['txtComplementoCliente']);
$cliente->setBairroCliente($_POST['txtBairroCliente']);
$cliente->setCidadeCliente($_POST['txtCidadeCliente']);
$cliente->setUfCliente($_POST['txtUFCliente']);
$cliente->setCepCliente($_POST['txtCepCliente']);


$clienteController = new ClienteController($cliente);

$clientes = ClienteDao::listar();

if ($_POST['txtSenhaConfirma'] == $_POST['txtSenhaCadastro'] && !$clienteController->validaNome($cliente, $clientes) && !$clienteController->validaEmail($cliente, $clientes) && !$clienteController->validaCpf($cliente, $clientes) && $clienteController->validaçãoCpf($_POST['txtCpfCliente'])) {
    ClienteDao::cadastrar($cliente);
    $msg = "Cadastro realizado com sucesso";
} else if ($clienteController->validaNome($cliente, $clientes) && $clienteController->validaEmail($cliente, $clientes) && $clienteController->validaCpf($cliente, $clientes)) {
    $msg = "Cadastro não foi realizado pois já existe um usuario com esse email, nome e cpf";
} else if ($clienteController->validaNome($cliente, $clientes) && $clienteController->validaEmail($cliente, $clientes)) {
    $msg = "Cadastro não foi realizado pois já existe um usuario com esse email e nome";
} else if ($clienteController->validaNome($cliente, $clientes) && $clienteController->validaCpf($cliente, $clientes)) {
    $msg = "Cadastro não foi realizado pois já existe um usuario com esse nome e cpf";
} else if ($clienteController->validaEmail($cliente, $clientes) && $clienteController->validaCpf($cliente, $clientes)) {
    $msg = "Cadastro não foi realizado pois já existe um usuario com esse email e cpf";
} else if ($clienteController->validaEmail($cliente, $clientes)) {
    $msg = "Cadastro não foi realizado pois já existe um usuario com esse email";
} else if ($clienteController->validaCpf($cliente, $clientes)) {
    $msg = "Cadastro não foi realizado pois já existe um usuario com esse cpf";
} else if ($clienteController->validaNome($cliente, $clientes)) {
    $msg = "Cadastro não foi realizado pois já existe um usuario com esse nome";
} else if (!$clienteController->validaçãoCpf($_POST['txtCpfCliente'])) {
    $msg = "Cadastro não foi realizado pois o cpf é invalido";
}
session_start();

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
