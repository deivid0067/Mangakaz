<?php
include_once('validador.php');
include_once('global.php');

try {
    $qtdePedido = VendaDao::contarPedido();
    $qtdecliente = ClienteDao::contarClientes();
    $prodmaisvendido = ProdutoDao::consultaMaisVendido();
    $clientemaiscomprou = ClienteDao::clienteMaisComprou();

    
    $qtdeprodutoscategoria = CategoriaDao::contarProduto();
    
} catch (Exception $e) {
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
    <link href="../css/estilo-transition.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Styles -->
    <style>
        #chartdiv2 {
            width: 100%;
            height: 500px;
        }
    </style>

</head>

<body>

    <?php
    if (isset($_SESSION['load'])) {
        echo ($_SESSION['load']);
        unset($_SESSION['load']);
    }
    ?>
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
                        </li>
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

    <div class="container-fluid p-5 top-0 position-absolute" id="dashboard">

        <div class="row">
            <h1 class="text-center">Dashboard Mangakáz</h1>
        </div>

        <div class="row">
            <div class="">
                <div class="row">
                    <div class="col-sm p-2">
                        <div id="chartdiv2" class="grafic"></div>
                    </div>

                    <div class="col-sm p-2">
                        <div class="card1">Vendas pendentes: <?php echo $qtdePedido ?></div>
                        <div class="card1">Cliente que mais comprou: <?php echo $clientemaiscomprou ?></div>
                        <div class="card1">Produto mais vendido: <?php echo $prodmaisvendido ?></div>
                        <div class="card1">Quantidade de clientes: <?php echo $qtdecliente ?></div>

                    </div>
                </div>

            </div>

        </div>
  

        <script src="../js/funcoes.js"></script>
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
        <script src="https://www.amcharts.com/lib/5/maps.js"></script>
        <script src="https://www.amcharts.com/lib/5/geodata/brazilLow.js"></script>

        <!-- Resources -->
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

        <!-- Chart code -->
        <script>
            am5.ready(function() {

                // Create root element
                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                var root = am5.Root.new("chartdiv2");

                // Set themes
                // https://www.amcharts.com/docs/v5/concepts/themes/
                root.setThemes([
                    am5themes_Animated.new(root)
                ]);

                // Create chart
                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                var chart = root.container.children.push(
                    am5percent.PieChart.new(root, {
                        layout: root.verticalHorizontal,
                        endAngle: 270,
                        radius: 100,
                    })
                );

                // Create series
                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                var series = chart.series.push(
                    am5percent.PieSeries.new(root, {
                        valueField: "valor",
                        categoryField: "produto",
                        endAngle: 270,
                        fontSize: 35
                    })
                );


                series.states.create("hidden", {
                    endAngle: -90
                });

                // Set data
                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                series.data.setAll([<?php
                                    foreach ($qtdeprodutoscategoria as $categoria) {
                                        echo ("{produto: '" . $categoria['nomecategoria'] . "',valor: " . $categoria['qtde'] . "},");
                                    }
                                    ?>]);

                series.appear(1000, 100);

            }); // end am5.ready()
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>