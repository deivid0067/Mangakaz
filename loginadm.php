<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mangakaz - ADM</title>
    <link href="images/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/estilo-transition.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
</head>

<body id="logincadastro">

    <div class="container-fluid">
        <div id="tela-login" class="p-5 position-absolute top-50 start-50 translate-middle">
            <div class="row">
                <h2 class="text-center">Login do administrador</h2>
            </div>
            <div class="row">

                <form method="post" action="autentica-sessao-adm.php"> 
                    <div class="input-group">
                        <input type="text" name="txtLoginadm" class="form-control" placeholder="Nome de Admin">
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="password" name="txtSenhaadm" class="form-control" placeholder="Senha">
                    </div>               
                    <br>
                    <div class="row">
                        <input type="submit" value="Entrar" id="botao-login" class="rounded-4 mx-auto">
                    </div>
                </form>
                
                <div class="row links-login">
                    <a href="login.php">← Voltar à página de login</a>
                </div>
            </div>
        </div>
    </div>



    <script src="js/funcoes.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>