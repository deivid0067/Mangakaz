<?php
include_once('global.php');

try {
    $listaproduto = ProdutoDao::listar();
    $listaprodutorecente = ProdutoDao::listarRec();
} catch (Exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
    echo $e->getMessage();
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
    <title>Mangakaz - HOME</title>
    <link href="images/favicon.ico" rel="icon">
    <link href="css/reset.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/estilo-transition.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
</head>

<body>

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
                        session_start();
                        if (isset($_SESSION['login-session']) && isset($_SESSION['senha-session'])) {
                            if ($_SESSION['login-session'] == 'adm' && $_SESSION['senha-session'] == '123') {
                                echo ('<a href="admin/">ADM</a>');
                                echo ('<a href="logout.php">Logout</a>');
                            } else {
                                echo ('<a href="cliente">Cliente</a>');
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
                        if ($qtdecarrinho != 0) {

                            echo (' <a href="carrinho.php">
                            <div class="position-absolute top-50 translate-middle end-0 me-3" id="qtdCarrinho">
                                    ' . $qtdecarrinho . '
                                    </div>
                                <img id="carrinho">
                            </a>');
                        } else {

                           
                        }
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

        <div class="row">
            <div class="owl-carousel carrosselslide p-0">
                <div class="w-100">
                    <img src="images/chainsaw.png">
                </div>
                <div class="w-100">
                    <img src="images/jujutsu.png">
                </div>
            </div>
        </div>

        <div class="row p-4" id="desconto-comprar">
            <div class="col-8 p-4 my-auto">
                <h1>
                    Produtos com <span style="color:#EDAB18">20%</span> de desconto!
                </h1>
            </div>
            <div class="col-4 p-2 my-auto">
                <a href="catalogo.php" class="mx-auto">
                    <div class="botao mx-auto descontoBotao">
                        <div class="txtBotao">
                            <span>Comprar</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="w-100">
                <div class="row text-center p-3">
                    <h1>PRODUTOS</h1>
                </div>
                <div id="recentes" class="row px-5">
                    <div class="owl-carousel prods px-5">
                        <?php
                        foreach ($listaproduto as $produto) {
                        ?>
                            <div class="card bg-transparent border-0 produto">
                                <div class="imagemProduto mx-auto">
                                    <img src="<?php echo $produto['fotoProduto'] ?>" class="card-img-top rounded-0">
                                </div>
                                <div class="card-body txtProduto">
                                    <h5 class="card-title"><?php echo $produto['nomeProduto'] ?></h5>
                                    <p class="card-text">R$<?php echo number_format($produto['precoProduto'], 2, ',', ' ')  ?></p>
                                    <a href="
                                    <?php

                                    if (isset($_SESSION['login-session']) && isset($_SESSION['senha-session'])) {
                                        echo ('produto-carrinho.php?idproduto=' . $produto['idproduto']);
                                    } else {
                                        echo ('login.php');
                                    }

                                    ?>
                                    ">
                                        <div class="botao comprar mx-auto">
                                            <div class="txtBotao">
                                                <span>Comprar</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="w-100">
                <div class="row text-center p-3">
                    <h1>RECÉM LANÇADOS</h1>
                </div>
                <div id="recentes" class="row px-5">
                    <div class="owl-carousel prods px-5">
                        <?php
                        foreach ($listaprodutorecente as $produto) {
                        ?>
                            <div class="card bg-transparent border-0 produto">
                                <div class="imagemProduto mx-auto">
                                    <img src="<?php echo $produto['fotoProduto'] ?>" class="card-img-top rounded-0">
                                </div>
                                <div class="card-body txtProduto">
                                    <h5 class="card-title"><?php echo $produto['nomeProduto'] ?></h5>
                                    <p class="card-text">R$<?php echo number_format($produto['precoProduto'], 2, ',', ' ')  ?></p>
                                    <a href="
                                    <?php

                                    if (isset($_SESSION['login-session']) && isset($_SESSION['senha-session'])) {
                                        echo ('produto-carrinho.php?idproduto=' . $produto['idProduto']);
                                    } else {
                                        echo ('login.php');
                                    }

                                    ?>
                                    ">
                                        <div class="botao comprar mx-auto">
                                            <div class="txtBotao">
                                                <span>Comprar</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="p-5">
                <a href="catalogo.php">
                    <div class="botao botaoProduto mx-auto">
                        <div class="txtBotao">
                            <span>Ir para o Catálogo</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row" id="novi">
            <div class="row p-5 mx-auto">
                <h2>FIQUE POR DENTRO DAS NOSSAS NOVIDADES</h2>
                <p>Se inscreva para ganhar ofertas, cupons, descontos e novos produtos no estoque!</p>
                <form>
                    <div class="input-group border border-1 border-dark" id="form-novidades">
                        <input type="email" class="form-control rounded-0 border-0 bg-transparent" placeholder="example@gmail.com">
                        <button type="submit" class="input-group-text rounded-0">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <a href="#">
            <div id="botaoSubir">
                <img class="translate-middle position-relative top-50 start-50">
            </div>
        </a>

        <div class="row">
            <footer id="rodape">
                <div class="row p-4">
                    <div class="col-sm barRodape p-3">
                        <h4>Menu do Rodapé</h4>
                        <a href="index.php">
                            <p class="text-white">Home</p>
                        </a>
                        <a href="catalogo.php">
                            <p class="text-white">Loja</p>
                        </a>
                        <p>© 2022, Mangakáz</p>
                    </div>
                    <div class="col-sm barRodape p-3">
                        <h4>Contato</h4>
                        <p>mangakaz.offc@gmail.com</p>
                        <a href="https://www.instagram.com/mangakaz_offc/">
                            <img src="images/iconInstagram.svg" width=20>
                        </a>
                    </div>
                    <div class="col-sm p-3">
                        <h4>Sobre nós</h4>
                        <p>A Loja Mangakaz foi fundada em 2022 com o propósito de tornar os mangás mais acessíveis para as pessoas com traduções originais feitas pela nossa equipe de tradutores.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="js/funcoes.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>