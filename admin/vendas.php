<?php
include_once('validador.php');



if (!empty($_GET['venda'])) {
    $idvenda = $_GET['venda'];
}

require_once('../dao/VendaDao.php');




?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mangakaz - ADMIN</title>
    <link href="../images/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="../css/estilo.css" rel="stylesheet">
    <link href="../css/estilo-transition.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</head>

<body>
    <div class="overlay" <?php if (!empty($_GET['venda'])) {
                                echo 'style="display:block; visibility:visible"';
                            } else {
                                echo 'style="opacity:0; visibility:hidden"';
                            } ?>></div>
    <div class='position-fixed translate-middle start-50 bg-white text-center' id='confirmaDelete'>
        <div class="modal-title">Mudar Status</div>
        <div class='row p-2'>
            <form action='mudar-status-venda.php' method='post'>

                Status da venda:
                <select id="status" name="status" class="form-control">
                    <!-- <option value="1">Pedido pelo cliente</option> -->
                    <option value="2">Confirmado pela loja</option>
                    <!-- <option value="3">Cancelado pelo cliente</option> -->
                    <option value="4">Cancelado pela loja – falta de estoque</option>
                    <option value="5">Venda finalizada – produtos enviados</option>
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
    <div class="overlay" style="opacity:0; visibility:hidden"></div>

    <nav class="navbar fixed-top p-0" id="menu">
        <div class="container-fluid p-3">
            <a class="navbar-brand">
            </a>
            <div class="text-center">
                <div class="border-0 bg-transparent" id="botaoUser" onclick="botaoUsuario2()">
                    <img src="images/user.png" id="imgUser">
                    <div id="opcoesUser2">
                        <a href="../logout.php">Logout</a>
                        <a href="../" class="nav-link">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid" id="barra2"></div>
    </nav>
    <div class="d-inline-flex bg-white flex-row position-fixed top-0 " id="sideBar">
        <button type="button" id="btnMenu" onclick="abreMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div id="itens">
            <div class="row p-3">
                <ul class="nav flex-column">
                    <li>
                        <a class="nav-link active" aria-current="page">
                            <span class="txtitemmenu2">Mangakaz</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">
                            <i class="fa fa-angellist"></i>
                            <span class="txtitemmenu">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categorias.php">
                            <i class="fa fa-industry"></i>
                            <span class="txtitemmenu">Categoria</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produtos.php">
                            <i class="fa fa-product-hunt"></i>
                            <span class="txtitemmenu">Produtos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vendas.php">
                            <i class="fa fa-bar-chart"></i>
                            <span class="txtitemmenu">Vendas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clientes.php">
                            <i class="fa fa-user"></i>
                            <span class="txtitemmenu">Clientes</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="barra"></div>
    </div>
    <?php
    require_once 'global.php';
    try {
        $listavenda = VendaDao::listarTodas();
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

    <div class="container-fluid p-5 top-0 position-absolute " id="dashboard">
        <div class="row">
            <h1 class="text-center">Vendas</h1>
        </div>

        <div class="row p-5">
            <div class="table-responsive">
                <table class="table bg-white table-hover table-bordered align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data da Venda</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Ver itens</th>
                            <th scope="col">Status</th>
                            <th scope="col">Atualizar status</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                    <?php echo number_format($venda['valortotalvenda'], 2, '.', ','); ?>
                                </td>
                                <td>
                                    <?php echo $venda['idcliente'] . "-" . $venda['nomecliente']; ?>
                                </td>
                                <td>
                                    <a data-toggle="modal" data-target="#Ver" href="vendas.php?venda=<?php echo $venda['idVenda'] ?>">
                                        <button type="button" class="btnCliente">
                                            Ver itens
                                        </button>
                                    </a>
                                </td>
                                <td><?php echo $status; ?></td>
                                <?php
                                switch ($venda['statusvenda']) {
                                    case 1:
                                    case 2:
                                ?>
                                        <td>
                                            <button type='button' data-toggle="modal" class="btnCliente" onclick="AlterarStatus('<?php echo $venda['idVenda']; ?>')">
                                                Mudar Status
                                            </button>
                                        </td> <?php
                                                break;
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
    <?php

    function set_url($url)
    {
        echo ("<script>history.replaceState({},'','$url');</script>");
    }
    set_url("vendas.php");

    ?>
    <script src="../js/funcoes.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>