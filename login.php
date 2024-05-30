<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mangakaz - LOGIN</title>
    <link href="images/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/estilo-transition.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body id="logincadastro">
    <?php
        session_start();
        if(isset ($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    <div class="container-fluid">
        <div id="tela-login" class="p-5 position-absolute top-50 start-50 translate-middle">
            <div class="row">
                <h2 class="text-center">Login</h2>
            </div>
            <div class="row">
                <form method="post" action="autentica-sessao.php"> 
                    <div class="input-group">
                        <input type="text" name="txtLogin" class="form-control" placeholder="E-mail do Usuário" required>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="password" maxlength="50" name="txtSenha" id="txtSenha" class="form-control" placeholder="Senha" required>
                        <button id="btnOlho" class="position-absolute end-0 top-50 translate-middle" onclick="olhoSenha()" type="button"><i id="olho" class="fa fa-eye"></i></button>
                    </div>
                    <br>
                    <div id="botoes-login" class="row mx-auto">
                        <button id="login-facebook" class="mx-auto"><img src="./images/facebook-letter.png"></button>
                        <button id="login-google" class="mx-auto"><img src="./images/google-letter.png"></button>
                        <button id="login-apple" class="mx-auto"><img src="./images/apple.png"></button>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm">
                            <input type="checkbox" id="manterLogin">
                            <label for="manterLogin">Manter login</label>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="→" id="botao-login" class="rounded-4 mx-auto">
                    </div>
                </form>
                
                <div class="row mx-auto links-login text-center">
                    <a href="#">Esqueceu a senha?</a>
                    <a href="cadastro.php">Criar conta</a>
                </div>

                <div class="row links-login">
                    <a href="index.php">← Voltar à página principal</a>
                </div>
            </div>
        </div>

        <a href="loginadm.php" class="position-absolute top-0 end-0" style="font-family:Teko-Medium;color:white">É um admnistrador? Acesse o menu do administrador por aqui!</a>

    </div>



    <script src="js/funcoes.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>