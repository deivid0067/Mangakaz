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
    <title>Mangakaz - CADASTRO</title>
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
                        <a href="login.php">Login</a>
                        <a href="cadastro.php">Cadastro</a>
                        
                        <?php
                            session_start();
                            if(isset($_SESSION['login-session']) && isset($_SESSION['senha-session'])){
                                if($_SESSION['login-session']=='adm' && $_SESSION['senha-session'] == '123'){
                                    echo('<a href="admin/">ADM</a>');
                                }
                            }
                        ?>
                    </div>
                </div>
                <span onclick="noturno()" class="border-0 bg-transparent" id="modoNoturno"><img></span>
                <a href="carrinho.php"><img id="carrinho"></a>
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

    <div class="container-fluid pagina" id="conteudo">
        <div class="container p-5">

            <div class="row p-5">
                <div class="container mx-auto text-center p-4">
                    <img id="tumbleweed">
                </div>
                <div class="row mx-auto">
                    <h2 class="text-center" style="font-family:Teko">Esse usuário não existe.</h2>
                </div>
            </div>

            <div class="row">
                <div class="p-5">
                    <a href="login.php">
                        <div class="botao botaoProduto mx-auto">
                            <div class="txtBotao">
                                <span>Voltar</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <footer id="rodape">
                <div class="row p-4">
                    <div class="col-sm barRodape p-3">
                        <h4>Menu do Rodapé</h4>
                        <a href="index.php"><p class="text-white">Home</p></a>
                        <a href="catalogo.php"><p class="text-white">Loja</p></a>
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