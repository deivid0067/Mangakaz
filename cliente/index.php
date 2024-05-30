<?php
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
    <title>Mangakaz - CLIENTE</title>
    <link href="../images/favicon.ico" rel="icon">
    <link href="../css/reset.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="../css/estilo.css" rel="stylesheet">
    <link href="../css/estilo-transition.css" rel="stylesheet">
    <link href="../css/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body id="cliente">

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <div class='position-fixed translate-middle start-50 text-center' id='confirmaDelete'>
        <div class='row p-2'>Tem certeza que deseja deletar sua Conta?</div>
        <div class='row p-2'>
            <form action='../admin/excluir-cliente.php' method='post'>
                <input type='hidden' name='idClienteEdit3' value='<?php echo ($_SESSION['idcliente']) ?>'></button>
                <button type='submit' id='btnOk' class="btnMsg">OK</button>
                <input type='button' onclick='sair()' value='SAIR' class='btnMsg'>
            </form>
        </div>
    </div>

    <div>
        <div class="overlay" style="opacity:0; visibility:hidden;"></div>

        <nav class="navbar fixed-top p-0" id="menu">
            <div class="container-fluid p-3">
                <a class="navbar-brand">
                    <img id="logo" width="80" height="80">
                </a>
                <div class="text-center">
                    <div class="border-0 bg-transparent" id="botaoUser" onclick="botaoUsuario()">
                        <img src="../images/user.png" id="imgUser">
                        <div id="opcoesUser">
                            <a href="../">Voltar</a>
                            <a href="minhas.php">Minhas Compras</a>
                            <a href="../logout.php">Logout</a>
                        </div>
                    </div>
                    <span onclick="noturno()" class="border-0 bg-transparent" id="modoNoturno"><img></span>

                </div>
            </div>
            <br>
        </nav>

        <div class="container-fluid" id="conteudo">
            <div class="row col-lg-5">

                <div class="p-5">
                    <div class="row p-2">
                        <h2 class="txtitemmenu21">Configurações da Conta</h2>
                        <p class="text-gray" style="font-family:Teko-Medium">Gerencie os detalhes da sua conta</p>
                    </div>
                    <div class="row p-2">
                        <h2 class="txtitemmenu21">Informações da Conta</h2>
                        <form method="post" action="alterar-cliente.php">
                            <div class="input-group">
                                <div class="form-floating me-3">
                                    <input type="email" name="txtEmail" id="txtEmail" maxlength="40" class="form-control campoCliente" placeholder="Email" value="<?php echo ($_SESSION['login-session']); ?>" readonly required>
                                    <label for="floatingPassword">Endereço de Email</label>
                                    <input type='hidden' name='idClienteEdit' value='<?php echo ($_SESSION['idcliente']) ?>'>
                                </div>
                                <div class="row">
                                    <button type='button' class="botaoCliente" onclick="emailAlterar()">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row p-2 mx-auto">
                                <button type="submit" class="botaoClienteCheck" class="mx-auto">
                                    <i class="fa fa-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="row p-2">
                        <h2 class="txtitemmenu21">Detalhes Pessoais</h2>
                        <form>
                            <div class="form-floating mb-3">
                                <input type="txt" name="txtNome" id="txtNome" maxlength="40" class="form-control campoCliente" placeholder="Nome" value="<?php echo ($_SESSION['nomecliente']); ?>" readonly>
                                <label for="floatingPassword">Nome</label>
                            </div>
                        </form>
                    </div>

                    <div class="row p-2">
                        <h2 class="txtitemmenu21">Endereço</h2>

                        <form method="post" action="alterar-cep.php">
                            <div class="form-floating mb-3">
                                <input type="text" id="name0" oninput="mascaraCep(this)" name="txtCepCliente1" maxlength="9" class="form-control campoCliente" placeholder="Cep" required onblur="pesquisacep(this.value);" value="<?php echo $_SESSION['cepcliente'] ?>">
                                <label for="floatingPassword">Cep</label>
                            </div>
                            <div class="input-group my-1">
                                <div class="form-floating mb-3">
                                    <input type="text" name="txtComplementoCliente1" id="txtCompCliente" maxlength="50" class="form-control campoCliente" placeholder="Complemento" value="<?php echo $_SESSION['compcliente'] ?>">
                                    <label for="floatingPassword">Complemento</label>
                                </div>
                                <div class="form-floating mb-3 ms-1">
                                    <input type="text" id="txtNumlog" name="txtNumLogCliente1" maxlength="11" class="form-control campoCliente" placeholder="NumLog" required value="<?php echo $_SESSION['numlogcliente'] ?>">
                                    <label for="floatingPassword">NumLog</label>
                                </div>
                            </div>
                            <div class="input-group my-1">
                                <div class="form-floating mb-3">
                                    <input type="text" name="txtLogradouroCliente1" id="txtLogradouroCliente" maxlength="40" class="form-control campoCliente" placeholder="Logradouro" required readonly value="<?php echo $_SESSION['logradourocliente'] ?>">
                                    <label for="floatingPassword">Logradouro</label>
                                </div>
                                <div class="form-floating mb-3 ms-1">
                                    <input type="text" name="txtBairroCliente1" id="txtBairroCliente" maxlength="50" class="form-control campoCliente" placeholder="Bairro" required readonly value="<?php echo $_SESSION['bairrocliente'] ?>">
                                    <label for="floatingPassword">Bairro</label>
                                </div>
                            </div>
                            <div class="input-group my-1">
                                <div class="form-floating mb-3">
                                    <input type="text" name="txtCidadeCliente1" id="txtCidadeCliente" maxlength="50" class="form-control campoCliente" placeholder="Cidade" required readonly value="<?php echo $_SESSION['cidadecliente'] ?>">
                                    <label for="floatingPassword">Cidade</label>
                                </div>
                                <div class="form-floating mb-3 ms-1">
                                    <input type="text" name="txtUFCliente1" id="txtUFCliente" maxlength="50" class="form-control campoCliente" placeholder="UF" required readonly value="<?php echo $_SESSION['ufcliente'] ?>">
                                    <label for="floatingPassword">UF</label>
                                </div>
                            </div>
                            <input type='hidden' name='idClienteEdit1' value='<?php echo ($_SESSION['idcliente']) ?>'></button>
                            <div class="row">
                                <button type="submit" class="botaoClienteCheck mx-auto" value="">
                                    <i class="fa fa-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="row p-2">

                        <h2 class="txtitemmenu21">Redefinir Senha</h2>
                        <form method="post" action="alterar-senha.php">
                            <div class="input-group">

                                <div class="form-floating me-3">
                                    <input type="password" name="txtSenha" id="txtSenha" maxlength="40" class="form-control campoCliente" placeholder="Senha" value="<?php echo ($_SESSION['senha-session']); ?>" readonly required>
                                    <label id="floating" for="floatingPassword">Senha</label>
                                    <button id="btnOlho" class="position-absolute end-0 top-50 translate-middle border-0 " onclick="olhoSenha()" type="button">
                                        <i id="olho" class="fa fa-eye"></i>
                                    </button>
                                </div>

                                <input type='hidden' name='idClienteEdit12' value='<?php echo ($_SESSION['idcliente']) ?>'>

                                <div class="row">
                                    <button type='button' class="botaoCliente" onclick="senhaAlterar()">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row p-2 mx-auto">
                                <button type="submit" class="botaoClienteCheck" class="mx-auto">
                                    <i class="fa fa-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="row p-2">
                        <h2 class="txtitemmenu21">Excluir Conta</h2>
                        <form method="post">
                            <div class="row">
                                <button type="button" class="rounded-4 mx-auto botaoClienteBan" value="" onclick='deletar(<?php echo $_SESSION["idcliente"] ?>)'>
                                    <i class="fa fa-ban"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="../js/funcoes.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        function check(e) {
            var char = String.fromCharCode(e.keyCode);

            var pattern = '[0-9- ]';
            if (char.match(pattern)) {
                return true;
            }
        }
        var input = document.querySelector("#txtNumlog");
        input.addEventListener("keypress", function(e) {
            if (!check(e)) {
                e.preventDefault();
            }

        });

        function checkar(e) {
            var char = String.fromCharCode(e.keyCode);

            console.log(char);
            var pattern = '[a-z-A-Z-á-ú-Á-Ú-â-û-Â-Û-Ã-Õ-ã-õ- ]';
            if (char.match(pattern)) {
                return true;
            }
        }

        var input = document.querySelector("#txtCompCliente");
        input.addEventListener("keypress", function(e) {
            if (!checkar(e)) {
                e.preventDefault();
            }
        });
        var input = document.querySelector("#name0");
        input.addEventListener("keypress", function(e) {
            if (!check(e)) {
                e.preventDefault();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>



</html>