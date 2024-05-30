<?php
require_once 'global.php';
include_once('validador.php');
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
    <title>Mangakaz - CARRINHO</title>
    <link href="images/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/estilo-transition.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
</head>

<body>
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
                                echo ('<a href="cliente/">Cliente</a>');
                                echo ('<a href="./cliente/minhas.php">Minhas Compras</a>');
                                echo ('<a href="logout.php">Logout</a>');
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
                ?>
               
                <?php

                if (isset($_SESSION['login-session']) && isset($_SESSION['senha-session'])) {
                    if ($_SESSION['login-session'] == 'adm' && $_SESSION['senha-session'] == '123') {
                        echo ('');
                    } else {
                        echo (' <a href="carrinho.php">
                                    <div class="position-absolute top-50 translate-middle end-0 me-3" id="qtdCarrinho">
                                            ' . $qtdecarrinho . '
                                            </div>
                                        <img id="carrinho">
                                    </a>');
                    }
                } else {
                    echo ('');
                }
                ?>

            </div>
        </div>
        <br>
        <div class="container-fluid" id="itensMenu">
            <a class="nav-link disabled"></a>
            <a href="index.php" class="nav-link menuHome"><span>HOME</span></a>
            <a href="catalogo.php" class="nav-link menuCatalogo"><span>CATÁLOGO</span></a>
            <a href="quemsomos.php" class="nav-link menuQuem"><span>QUEM SOMOS</span></a>
            <a href="contato.php" class="nav-link menuContato"><span>CONTATO</span></a>
            <a class="nav-link disabled"></a>
        </div>
    </nav>

    <div class="container-fluid" id="conteudo">
   
<div class="row p-5">


    <h2>Carrinho de compras</h2>
    <div class="table-responsive ">
<table class="table tablea table-bordered align-middle text-center">
    <thead>
        <tr class="tableaTxt">
            <th scope="col">#</th>
            <th scope="col" width='100px'>Foto</th>
            <th scope="col" >Nome</th>
            <th scope="col">Qtde.</th>
            <th scope="col">Preço</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Remover</th>
        </tr>
    </thead>
    <tbody class="tableaTxt">
                <?php
                    $valortotal = 0;
                    foreach($carrinhoAtual as $idvetorcarrinho => $itemcarrinho){ 
                        $valortotal += $itemcarrinho->getsubtotalItemVenda();
                ?>
                <tr >
                    <th scope="row"><?php echo $itemcarrinho->getProduto()->getIdPro(); ?></th>
                    <td> <img src="./<?php echo $itemcarrinho->getProduto()->getFotoPro(); ?>" class="rounded produtoTabela" ></td>
                    <td><?php echo $itemcarrinho->getProduto()->getNomePro(); ?></td>
                    <td><?php echo $itemcarrinho->getqtdItemVenda(); ?> </td>
                    <td><?php echo number_format($itemcarrinho->getProduto()->getPrecoPro(), 2, ',', '.'); ?></td>
                    <td><?php echo number_format($itemcarrinho->getsubtotalItemVenda(), 2, ',', '.'); ?></td>
                    <td><a class="btn btn-outline-danger" href="remove-produto-carrinho.php?idproduto=<?php echo $idvetorcarrinho;?>">Remover item do carrinho</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
        <br><br>
        <h3 id="TxtValor">Valor total: R$ <?php echo number_format($valortotal, 2, ',', '.') ; ?></h3>
        <br><br>
        
        <a id="botaoCarri" class="btn btn-success mx-auto" href="finaliza-venda.php?valortotal=<?php echo $valortotal; ?>">Finalizar compra</a>
        
        <br><br><br>
    </div>

    </div>
    
    <script src="js/funcoes.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>