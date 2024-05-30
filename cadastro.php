<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mangakaz - CADASTRO</title>
    <link href="images/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/estilo-transition.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body id="logincadastro" >
    <?php
        if(isset ($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    <div class="container-fluid">
        <div id="tela-login" class="p-5 position-absolute top-50 start-50 translate-middle">
            <div class="row">
                <h2 class="text-center">Cadastrar</h2>
            </div>    
            <div class="row col-sm">
                <form method="post" action="admin/cadastro-cliente.php"> 
                    <div class="input-group my-1">
                        <input type="text" maxlength="60" name="txtCadastroCliente" id="name3" class="form-control" placeholder="Nome do Usuário" required>
                    </div>
                    <div class="input-group">
                        <input type="password" maxlength="50" minlength="8" name="txtSenhaCadastro" id="txtSenhaCadastro" oninput="verificaCadastro()" class="form-control" placeholder="Senha" required>
                        <button id="btnOlho" class="position-absolute end-0 top-50 translate-middle" onclick="olhoSenhaCadastro()" type="button"><i id="olho" class="fa fa-eye"></i></button>
                    </div>
                    <div class="input-group my-1">
                        <input type="password" maxlength="50" minlength="8" name="txtSenhaConfirma" id="txtSenhaConfirma" oninput="verificaCadastro()" class="form-control" placeholder="Confirme sua senha" required>
                    </div>
                    <div class="input-group my-1">
                        <input type="email" maxlength="50"  name="txtEmailCliente" class="form-control" placeholder="Email do Usuário" required>
                    </div>
                    <div class="input-group my-1">
                        <input type="text" oninput="mascara(this)"  id="name" maxlength="14" name="txtCpfCliente"  class="form-control" placeholder="Cpf do Usuário" required>
                    </div>
                    <div class="input-group my-1">
                    <input type="text" id="name0" oninput="mascaraCep(this)" value="" name="txtCepCliente" maxlength="9" class="form-control " placeholder="Cep" required
                    onblur="pesquisacep(this.value);" >
                        
                    </div>
                    <div class="input-group my-1">
                   <input type="text" name="txtComplementoCliente" id="name5" maxlength="50" class="form-control" placeholder="Complemento">
                        <input type="text" id="name2" name="txtNumLogCliente" maxlength="11" class="form-control ms-1" placeholder="Numero do Logradouro"  required>
                        
                    </div>
                    <div class="input-group my-1">
                    <input type="text" name="txtLogradouroCliente" id="txtLogradouroCliente" maxlength="40" class="form-control" placeholder="Logradouro do Usuário" readonly  required>
                    
                        <input type="text" name="txtBairroCliente" id="txtBairroCliente" maxlength="50" class="form-control ms-1" placeholder="Bairro" readonly  required>
                        
                    </div>
                    <div class="input-group my-1">
                    <input type="text" name="txtCidadeCliente" id="txtCidadeCliente"  maxlength="50" class="form-control" placeholder="Cidade" readonly  required>
                    <input type="text" name="txtUFCliente" id="txtUFCliente" maxlength="50" class="form-control ms-1" placeholder="UF" readonly  required>
                        
                    
                    </div>
                    <div class="row" >
                        <input type="submit" value="→" id="botao-login" class="rounded-4 mx-auto">
                    </div>
                </form>
                <div class="row mx-auto links-login text-center">
                    <a href="login.php">Voltar ao login</a>
                </div>
                <div class="row links-login">
                    <a href="index.php">← Voltar à página principal</a>
                </div>
            </div>
        </div>
        
    </div>

    <script src="js/funcoes.js"></script>
    <script src="js/js.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>