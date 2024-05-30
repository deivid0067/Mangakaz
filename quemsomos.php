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
    <title>Mangakaz - QUEM SOMOS</title>
    <link href="images/favicon.ico" rel="icon">
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


    <div class="container-fluid " id="conteudo">
        <div class="p-4">
            <div class="container p-2 fundoSobre">

                <div class="row p-4 text-center">
                    <h2>Sobre nós</h2>
                </div>

                <div class="row p-3">
                    <img src="images/logo.png" style="width:250px" class="mx-auto logoSobre">
                </div>

                <div class="row">
                    <h3 id="sobre" class="w-50 mx-auto">A Loja Mangakaz foi fundada em 2022 com o propósito de tornar os mangás mais acessíveis para as pessoas com traduções originais feitas pela nossa equipe de tradutores.</h3>
                </div>

                <div class="row p-0">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14629.725338238455!2d-46.3996062!3d-23.5529472!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf7da96815e7611da!2sETEC%20de%20Guaianases!5e0!3m2!1spt-BR!2sbr!4v1663281517968!5m2!1spt-BR!2sbr" height="450" style="border:0; width:100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="maps"></iframe>
                </div>

                <div class="row text-center p-3">
                    <h2>Redes Sociais</h2>
                </div>
                <div class="row">
                    <div class="text-center">
                        <a href="https://www.instagram.com/mangakaz_offc/" src="images/instagram.png" style="width:50px">
                            <img src="images/instagram.png" style="width:50px"></a>
                    </div>
                </div>

                <div class="row p-3">
                    <div class="col">
                        <div class="iconeDev" id="hugo">
                            <div class="imgDev">
                                <img src="images/hugo.png">
                            </div>
                            <div class="txtDev position-absolute translate-middle top-50 start-50">
                                <div class="nomeDev">
                                    Hugo
                                </div>
                                <div class="cargoDev">
                                    Auxiliar de Front-End e Designer Auxiliar
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="iconeDev" id="edu">
                            <div class="imgDev">
                                <img src="images/edu.png">
                            </div>
                            <div class="txtDev position-absolute translate-middle top-50 start-50">
                                <div class="nomeDev">
                                    Eduardo
                                </div>
                                <div class="cargoDev">
                                    Programador Principal e Designer
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="iconeDev" id="andre">
                            <div class="imgDev">
                                <img src="images/andre.png">
                            </div>
                            <div class="txtDev position-absolute translate-middle top-50 start-50">
                                <div class="nomeDev">
                                    André
                                </div>
                                <div class="cargoDev">
                                    Auxiliar de Back-End
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="iconeDev" id="deivid">
                            <div class="imgDev">
                                <img src="images/deivid.png">
                            </div>
                            <div class="txtDev position-absolute translate-middle top-50 start-50">
                                <div class="nomeDev">
                                    Deivid
                                </div>
                                <div class="cargoDev">
                                    Auxiliar de Front-End e Designer Auxiliar
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="iconeDev" id="alves">
                            <div class="imgDev">
                                <img src="images/alves.png">
                            </div>
                            <div class="txtDev position-absolute translate-middle top-50 start-50">
                                <div class="nomeDev">
                                    Alves
                                </div>
                                <div class="cargoDev">
                                    Auxiliar de Back-End
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="js/jquery.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>