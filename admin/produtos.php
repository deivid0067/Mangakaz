<?php
include_once('validador.php');
require_once('../dao/ProdutoDao.php');

try {
    $listaproduto = ProdutoDao::listar();
} catch(Exception $e) {
    echo '<pre>';
        print_r($e);
    echo '</pre>';
    echo $e->getMessage();
}


require_once('../model/Conexao.php');


require_once('../dao/CategoriaDao.php');

try {
    $listacategoria = CategoriaDao::listar();
} catch(Exception $e) {
    echo '<pre>';
        print_r($e);
    echo '</pre>';
    echo $e->getMessage();
}

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
    <link href="css/estilo-transition.css" rel="stylesheet">
    <link href="../css/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
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
        <div class="container-fluid" id="barra2">

        </div>
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


    <div class='position-fixed translate-middle start-50 bg-white text-center' id='confirmaDelete'>
        <div class='row p-2'>Tem certeza que deseja deletar esse produto?</div>
        <div class='row p-2'>
            <form action='excluir-produto.php' method='post'>
                <button type='submit' name='idProduto' value='' id="btnOk" class='btnMsg'>OK</button>
                <input type='button' onclick='sair()' value='SAIR' class='btnMsg'>
            </form>
        </div>
    </div>

    <div class='position-fixed translate-middle start-50 bg-white text-center' id='confirmaEdit'>
        <div class='row p-2 text-center mx-auto'>
            <h4>Editar produto</h4>
        </div>
        <div class='row p-2'>
            <form action='alterar-produto.php' id="formEdit" method='post' enctype="multipart/form-data">
                <input type="text" name="txtNomeProdutoEdit" id="txtNomeProdutoEdit" maxlength="50" class="form-control" maxlength="60" placeholder="Nome" value="" required>
                <br>
                <input type="number" id="txtPrecoProdutoEdit" min="0.01" max="9999999999" maxlength="10" step="0.01" name="txtPrecoProdutoEdit" class="form-control" value="" oninput="verificaValor()" placeholder="Preço" required>
                <br>
                <div class="row">
                    <div class="col d-flex flex-column justify-content-center">
                        <input class="form-control mx-auto" type="file" name="imgProdutoEdit" id="imgProdutoEdit">
                    </div>
                    <div class="col">
                        <img id="previewEdit" src="" alt="..." draggable="false">
                    </div>
                </div>
                <br>
                <select class="form-select" name="slCategoriaEdit" id="slCategoriaEdit" required>
                    <?php
                    for ($i = 0; $i < count($listacategoria); $i++) {
                        echo ('<option value="' . $listacategoria[$i][0] . '">' . $listacategoria[$i][1] . '</option>');
                    }
                    ?>
                </select>
                <br>
                <button type='submit' name='idProdutoEdit' id="btnEdit" value='' class='btnMsg'>OK</button>
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

    <div class="container-fluid p-3 top-0 position-absolute " id="dashboard">
        <div class="row p-3">
            <div class="formAdm w-100">
                <h3>Cadastro de produto</h3>
                <form action="cadastra-produto.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="txtNomeProduto" id="txtNomeProduto" maxlength="50" class="form-control" maxlength="60" placeholder="Nome" required>
                            <br>
                            <input type="number" id="precoProd" min="0.01" max="9999999999" maxlength="10" step="0.01" name="txtPrecoProduto" class="form-control" oninput="verificaValor()" placeholder="Preço" required>
                            <br>
                            <input class="form-control" type="file" name="imgProduto" id="imgProduto" required>
                            <br>
                            <select class="form-select" name="slCategoria" id="slCategoria" required>
                                <?php
                                for ($i = 0; $i < count($listacategoria); $i++) {
                                    echo ('<option value="' . $listacategoria[$i][0] . '">' . $listacategoria[$i][1] . '</option>');
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <br>
                            <img id="preview" src="../images/defaultprod.jpg" alt="..." draggable="false">
                        </div>
                    </div>

                    <br>

                    <input type="submit" value="CADASTRAR" class="botaoFormAdm">

                </form>
            </div>
        </div>
        <div class="row p-5">
            <div class="table-responsive ">
                <table class="table bg-white table-striped table-bordered align-middle text-center">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Foto
                            </th>
                            <th>
                                Nome
                            </th>
                            <th>
                                Preço
                            </th>
                            <th>
                                Categoria
                            </th>
                            <th>
                                Editar
                            </th>
                            <th>
                                Excluir
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <?php

                        foreach($listaproduto as $produto) {
                            print("
                                    <tr>
                                        <td>
                                            " . $produto['idproduto'] . "
                                        </td>
                                        <td class='p-1'>
                                            <img src='../" . $produto['fotoProduto'] . "' class='produtoTabela'>
                                        </td>
                                        <td>
                                            " . $produto['nomeProduto'] . "
                                        </td>
                                        <td>
                                            R$" . sprintf("%.2f", $produto['precoProduto']) . "
                                        </td>
                                        <td>
                                            " . $produto['nomeCategoria'] . "
                                        </td>
                                        <td>
                                            <button type='button' class='border-0 bg-transparent' onclick='editar(".$produto['idproduto'].",\"".$produto['nomeProduto']."\",".$produto['precoProduto'].",\"".$produto['fotoProduto']."\",".$produto['idCategoria'].")'>Editar</button>
                                        </td>
                                        <td>
                                            <button type='button' class='border-0 bg-transparent' onclick='deletar(" . $produto['idproduto'] . ")'>Excluir</button>
                                        </td>
                                    </tr>"
                            );
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/js.js"></script>
    <script src="../js/funcoes.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        function readImage() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("preview").src = e.target.result;
                };
                file.readAsDataURL(this.files[0]);
            }
        }

        function readImageEdit() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("previewEdit").src = e.target.result;
                };
                file.readAsDataURL(this.files[0]);
            }
        }

        document.getElementById("imgProduto").addEventListener("change", readImage, false);
        document.getElementById("imgProdutoEdit").addEventListener("change", readImageEdit, false);
        function checkare(e) {
    var char = String.fromCharCode(e.keyCode);
  

    var pattern = '[a-z-A-Z-á-ú-Á-Ú-â-û-Â-Û-Ã-Õ-ã-õ-0-9- ]';
    if (char.match(pattern)) {
      return true;
  }
}


var input = document.querySelector("#txtNomeProduto");
input.addEventListener("keypress", function(e) {
    if(!checkare(e)) {
      e.preventDefault();
  }
});
var input = document.querySelector("#txtNomeProdutoEdit");
input.addEventListener("keypress", function(e) {
    if(!checkare(e)) {
      e.preventDefault();
  }
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>