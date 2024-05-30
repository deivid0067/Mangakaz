<?php
include_once('validador.php');
require_once('global.php');
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
    <link href="../css/estilo-transition.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



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


    <div class="overlay" style="opacity:0; visibility:hidden"></div>
    <div class='position-fixed translate-middle start-50 bg-white text-center' id='confirmaDelete'>
        <div class='row p-2'>Tem certeza que deseja deletar esse cliente?</div>
        <div class='row p-2'>
            <form action='excluir-cliente.php' method='post'>
                <button type='submit' name='slCli' value='' id='btnOk'>OK</button>
                <input type='button' onclick='sair()' value='SAIR' id='msgErro'>
            </form>
        </div>
    </div>

    <div class="container-fluid p-5 top-0 position-absolute" id="dashboard">
        <div class="row">
            <h1 class="text-center">Clientes</h1>
        </div>
        <div class="row">
            <div class="col-sm p-2">
                <div id="graficoPizza" style="box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);"></div>
            </div>
            <div class="col-sm p-2">
                <div id="graficoLinha" style="box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);"></div>
            </div>
        </div>
        <div class="row p-5">
            <div class="table-responsive">
                <table class="table bg-white table-hover table-bordered align-middle text-center">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Nome
                            </th>
                            <th>
                                CPF
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Logradouro
                            </th>
                            <th>
                                Numero
                            </th>
                            <th>
                                Complemento
                            </th>
                            <th>
                                Bairro
                            </th>
                            <th>
                                Cidade
                            </th>
                            <th>
                                UF
                            </th>
                            <th>
                                CEP
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <?php

                        for ($i = 0; $i < count(ClienteDao::listar()); $i++) {
                            print("
                            <tr>
                            ");
                            for($j=0;$j<11;$j++){
                                print(
                                    "
                                        <td>
                                            " . ClienteDao::listar()[$i][$j] . "
                                        </td>
                                    ");
                            }
                            print("
                            </tr>");
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <script src="../js/funcoes.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>