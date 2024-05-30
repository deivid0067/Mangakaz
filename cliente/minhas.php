<?php
require_once 'global.php';
include_once('validador.php');
if(!empty($_GET['venda'])){
    $idvenda = $_GET['venda'];
}

?>
<!doctype html>
<html lang="pt-br" <?php
                    if (isset($_COOKIE['theme'])) {
                        if ($_COOKIE["theme"] == "dark") {
                            echo ('class="darkmode"');
                        } else {
                            echo ('');
                        }
                    }
                    ?>>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mangakaz - MINHAS COMPRAS</title>
    <link href="../images/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="../css/estilo.css" rel="stylesheet">
    <link href="../css/estilo-transition.css" rel="stylesheet">
    <link href="../css/owl.carousel.min.css" rel="stylesheet">
</head>

<body>
    <div class="overlay" <?php if (!empty($_GET['venda'])) {
                                echo 'style="display:block; visibility:visible"';
                            } else {
                                echo 'style="opacity:0; visibility:hidden"';
                            } ?>></div>

    <div class='position-fixed translate-middle start-50 bg-white text-center' id='confirmaDelete'>
        <div class='row p-2'>Tem certeza que deseja cancelar a venda?</div>
        <div class='row p-2'>
            <form action='../mudar-status-venda.php' method='post'>

                Status da venda:
                <select id="status" name="status" class="form-control">
                    <!-- <option value="1">Pedido pelo cliente</option> -->
                    <!-- <option value="2">Confirmado pela loja</option> -->
                    <option value="3">Cancelado pelo cliente</option>
                    <!-- <option value="4">Cancelado pela loja – falta de estoque</option> -->
                    <!-- <option value="5">Venda finalizada – produtos enviados</option> -->
                </select>
                <br>
                <button type='submit' name='idvendaModal' value='' id='btnOk' class="btnMsg">OK</button>
                <input type='button' onclick='sair()' value='SAIR' class='btnMsg'>
            </form>
        </div>
    </div>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <nav class="navbar fixed-top p-0" id="menu">
        <div class="container-fluid p-3">
            <a class="navbar-brand">
                <img id="logo" width="80" height="80">
            </a>
            <div class="text-center">
                <div class="border-0 bg-transparent" id="botaoUser" onclick="botaoUsuario()">
                    <img src="images/user.png" id="imgUser">
                    <div id="opcoesUser">
                        <?php

                        if (isset($_SESSION['login-session']) && isset($_SESSION['senha-session'])) {
                            if ($_SESSION['login-session'] == 'adm' && $_SESSION['senha-session'] == '123') {
                                echo ('<a href="admin/">ADM</a>');
                            } else {
                                echo ('<a href="index.php">Cliente</a>');
                                echo ('<a href="minhas.php">Minhas Compras</a>');
                                echo ('<a href="../logout.php">Logout</a>');
                            }
                        } else {
                            echo ('<a href="login.php">Login</a>
                                <a href="cadastro.php">Cadastro</a>');
                        }
                        ?>
                    </div>
                </div>
                <span onclick="noturno()" class="border-0 bg-transparent" id="modoNoturno"><img></span>

                <?php

                if (isset($_COOKIE["carrinho"])) {
                    $carrinhorecebido =  $_COOKIE["carrinho"];
                    $carrinhoAtual = unserialize($carrinhorecebido);
                    $qtdecarrinho = count($carrinhoAtual);
                } else {
                    $qtdecarrinho = 0;
                }
                
                try {
                    $cliente = new Cliente();
                    $cliente->setIdCliente($_SESSION['idcliente']);

                    $listavenda = VendaDao::listarPorCliente($cliente);
                } catch (Exception $e) {
                    echo '<pre>';
                    print_r($e);
                    echo '</pre>';
                    echo $e->getMessage();
                }
                ?>

            </div>
        </div>
        <br>
        <div class="container-fluid" id="itensMenu">
            <a class="nav-link disabled"></a>
            <a href="../index.php" class="nav-link menuHome"><span>HOME</span></a>
            <a href="../catalogo.php" class="nav-link menuCatalogo"><span>CATÁLOGO</span></a>
            <a href="../quemsomos.php" class="nav-link menuQuem"><span>QUEM SOMOS</span></a>
            <a href="../contato.php" class="nav-link menuContato"><span>CONTATO</span></a>
            <a class="nav-link disabled"></a>
        </div>
    </nav>
    <?php
    require_once 'global.php';
    try {

        $cliente = new Cliente();
        $cliente->setIdCliente($_SESSION['idcliente']);

        $listavenda = VendaDao::listarPorCliente($cliente);
        $qtdePedido = VendaDao::contarPedido();
        if (!empty($_GET['venda'])) {
            $listaitens = ItemVendaDao::listarPorVenda($idvenda);
        }
    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        echo $e->getMessage();
    }
    ?>
    <div class="container-fluid" id="conteudo">
        <div class="row p-5">
            <h2>Minhas Compras</h2>
            <div class="table-responsive ">
                <table class="table tablea table-bordered align-middle text-center">
                    <thead>
                        <tr class="tableaTxt">
                            <th scope="col">#</th>
                            <th scope="col">Data da Venda</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Ver itens</th>
                            <th scope="col">Status</th>
                            <th scope="col">Atualizar status</th>
                        </tr>
                    </thead>
                    <tbody class="tableaTxt">

                        <?php
                        foreach ($listavenda as $venda) {
                            switch ($venda['statusvenda']) {
                                case 1:
                                    $status = 'Pedido pelo cliente';
                                    break;
                                case 2:
                                    $status = 'Confirmado pela loja';
                                    break;
                                case 3:
                                    $status = 'Cancelado pelo cliente';
                                    break;
                                case 4:
                                    $status = 'Cancelado pela loja – falta de estoque';
                                    break;
                                case 5:
                                    $status = 'Venda finalizada – produtos enviados';
                                    break;
                            }
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $venda['idVenda']; ?>
                                </th>
                                <td>
                                    <?php echo $venda['datavenda']; ?>
                                </td>
                                <td>
                                    R$<?php echo number_format($venda['valortotalvenda'], 2, '.', ','); ?>
                                </td>
                                <td>
                                    <a data-toggle="modal" data-target="#Ver" href="minhas.php?venda=<?php echo $venda['idVenda'] ?>">
                                        <button type="button" class="btnCliente">
                                            Ver itens
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $status; ?>
                                </td>
                                <?php
                                switch ($venda['statusvenda']) {
                                    case 1:
                                ?>
                                        <td>
                                            <button type='button' data-toggle="modal" class="btnCliente" onclick="AlterarStatus('<?php echo $venda['idVenda']; ?>')">
                                                Cancelar venda
                                            </button>
                                        </td>
                                <?php
                                        break;
                                    case 2:
                                    case 3:
                                    case 4:
                                    case 5:
                                        echo ("<td></td>");
                                        break;
                                }
                                ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class='position-fixed translate-middle start-50 bg-white text-center' id='Ver' <?php if (!empty($_GET['venda'])) echo 'style="display:block; opacity:1"' ?>>
        <div class="modal-header">
            <div class="modal-title">Ver itens da Venda: <div id="idvenda"></div>
            </div>
            <button type="button" class="close" onclick='sairVer()' data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class='row p-2'>
            <div class="table-responsive ">
                <table class="table tablea table-bordered align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Qtde.</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaitens as $item) { {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $item['idvenda']; ?></th>
                                    <td><img src="../<?php echo $item['fotoproduto']; ?>" width=75></td>
                                    <td><?php echo $item['nomeproduto']; ?></td>
                                    <td><?php echo $item['qtdeitemvenda']; ?></td>
                                    <td><?php echo $item['subtotalitemvenda']; ?></td>
                                </tr>

                        <?php   }
                        }
                        ?>
                    </tbody>
                </table>

            </div>


        </div>
    </div>

    <script src="../js/funcoes.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/script.js"></script>

    <?php

    function set_url($url)
    {
        echo ("<script>history.replaceState({},'','$url');</script>");
    }
    set_url("minhas.php");

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>