<?php

include_once('global.php');

$produto = new Produto();
$categoria = new Categoria();

if (!empty($_POST['categoria'])) {
    $categoria->setId($_POST['categoria']);
    $produto->setCategoria($categoria);
}
if (!empty($_POST['txtPesquisa'])) {
    $produto->setNomePro($_POST['txtPesquisa']);
}

$pagina = null;

if (empty($_POST['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_POST['pagina'];
}

try {
    if (!empty($categoria->getId()) && !empty($produto->getNomePro())) {
        $listaproduto = ProdutoDao::pesquisaNomeCategoria($produto);
        $consul = count(ProdutoDao::pesquisaNomeCategoria($produto));
    } else if (!empty($_POST['categoria'])) {
        $listaproduto = ProdutoDao::pesquisaCategoria($produto);
        $consul = count(ProdutoDao::pesquisaCategoria($produto));
    } else if (!empty($_POST['txtPesquisa'])) {
        $listaproduto = ProdutoDao::pesquisaNome($produto);
        $consul = count(ProdutoDao::pesquisaNome($produto));
    } else {
        $listaproduto = ProdutoDao::listar();
        $consul = count(ProdutoDao::listar());
    }
} catch (Exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
    echo $e->getMessage();
}

if (count($listaproduto) % 12 > 0) {
    $resto = 1;
} else {
    $resto = null;
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
    <title>Mangakaz - CATALOGO</title>
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


    <div class="pagina"></div>

    <div class="container-fluid" id="conteudo">

        <div class="row">
            <img src="images/catalogo2.png" class="header p-0" style="opacity:0.5; user-select:none" draggable="false">
        </div>

        <div class="row p-4 ">
            <div class="col-sm-3 p-2">
                <div class="container p-4" id="filtroPesquisa">
                    <form action="catalogo.php" method="POST" id="form">
                        FILTRO
                        <br>
                        <div class="input-group pesquisa">
                            <input type="text" class="form-control rounded-0 border-0 bg-transparent txtPesquisa" name="txtPesquisa" maxlength="60" value="<?php echo $produto->getNomePro() ?>">
                            <button type="submit" class="input-group-text rounded-0 border-0 botaoPesquisa">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search iconPesquisa" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>
                        </div>
                        <a href="catalogo.php">Limpar</a>
                        <hr>
                        <h5>Categoria</h5>
                        <?php


                        try {
                            $listacategoria = CategoriaDao::listar();
                        } catch (Exception $e) {
                            echo '<pre>';
                            print_r($e);
                            echo '</pre>';
                            echo $e->getMessage();
                        }

                        foreach ($listacategoria as $itemcategoria) {
                            if ($categoria->getId() == $itemcategoria['idcategoria']) {
                                print('
                                <div class="form-check">
                                    <input class="checkCatalogo form-check-input" type="radio" name="categoria" checked id="' . $itemcategoria['nomecategoria'] . '" value="' . $itemcategoria['idcategoria'] . '">
                                    <label for="' . $itemcategoria['nomecategoria'] . '">
                                        ' . $itemcategoria['nomecategoria'] . '
                                    </label>
                                </div>
                                ');
                            } else {
                                print('
                                <div class="form-check">
                                    <input class="checkCatalogo form-check-input" type="radio" name="categoria" id="' . $itemcategoria['nomecategoria'] . '" value="' . $itemcategoria['idcategoria'] . '">
                                    <label for="' . $itemcategoria['nomecategoria'] . '">
                                        ' . $itemcategoria['nomecategoria'] . '
                                    </label>
                                </div>
                                ');
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>

            <div class="col-sm-9 p-2">
                <div class="row">
                    <?php

                    for ($i = 12 * ($pagina - 1); $i < 12 * $pagina; $i++) {
                        if (!isset($listaproduto[$i])) {
                            break;
                        }
                    ?>
                        <div class="card mx-auto bg-transparent border-0 produto catalogo">
                            <div class="imagemProduto mx-auto text-center">
                                <img src=" <?php echo $listaproduto[$i]['fotoProduto'] ?>" class="card-img rounded-0">
                            </div>
                            <div class="card-body txtProduto">
                                <h5 class="card-title"> <?php echo $listaproduto[$i]['nomeProduto'] ?> </h5>
                                <p class="card-text"> <?php number_format($listaproduto[$i]['precoProduto'], 2, ',', ' ') ?> </p>
                                <a href="
                                    <?php

                                    if (isset($_SESSION['login-session']) && isset($_SESSION['senha-session'])) {
                                        echo ('produto-carrinho.php?idproduto=' . $listaproduto[$i]['idproduto']);
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

                <div class="row p-5">
                    <form action="catalogo.php" method="POST" class="text-center">
                        <input type="hidden" name="txtPesquisa" value="<?php echo $produto->getNomePro() ?>">
                        <input type="hidden" name="categoria" value="<?php echo $categoria->getId() ?>">
                        <?php
                        for ($i = 1; $i < (count($listaproduto) / 12 + $resto); $i++) {
                            if ($i == $pagina) {
                                print('
                                        <input type="submit" class="pagCatalogo" value="' . $i . '" style="background:var(--bg-botoes);color: var(--txt-botoes)" name="pagina">
                                    ');
                            } else {
                                print('
                                        <input type="submit" class="pagCatalogo" value="' . $i . '" name="pagina">
                                    ');
                            }
                        }
                        ?>
                    </form>
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>