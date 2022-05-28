<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>


    <link rel="stylesheet" href="<?= BS_CSS_PATH ?>">
    <link rel="stylesheet" href="<?= DEFAULT_CSS_PATH ?>">
    <link rel="stylesheet" href="<?= CSS_PATH ?>/products.css">

    <style type="text/css">
        html,
        body {
            height: 100%;
        }
    </style>

    <script src="<?= JS_PATH ?>/feather.min.js"></script>
</head>


<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-2 p-4 sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2">
                    <a class="go-back-btn" href="<?= ROOT_PATH ?>"><i class="arrow-icon" data-feather="arrow-left"></i></a>

                    <div class="d-flex align-items-center pb-3 mb-md-0 me-md-auto">
                        <span class="d-none d-sm-inline" style="margin-top: 50px;">Visão Geral</span>
                    </div>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item" style="margin-top: 10%;">
                            <h6>Quantidade</h6>
                            <h2>83</h2>
                        </li>

                        <li class="nav-item" style="margin-top: 10%;">
                            <h6>Saldo</h6>
                            <h2>R$3.243,00</h2>
                        </li>

                        <li class="nav-item" style="margin-top: 10%;">
                            <h6>Restoques necessários</h6>
                            <h2>3</h2>
                        </li>
                    </ul>
                    <!-- <hr> -->
                </div>
            </div>



            <div class="col">
                <nav class="navbar p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="navbar-brand">Produtos</h1>
                        <a href="#" class="new-product-btn d-flex justify-content-center align-items-center" style="padding: 3px"><i data-feather="plus"></i></a>
                    </div>


                    <div class="d-flex" style="padding: 12px">
                        <input class="form-control no-border" type="search" placeholder="Pesquisar">
                        <button class="btn search-btn my-2 my-sm-0" type="submit"><i data-feather="search"></i></button>

                        <div class="dropdown">
                            <a class="btn dropdown-toggle drpdwn" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorias
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Cozinha</a></li>
                                <li><a class="dropdown-item" href="#">Banheiro</a></li>
                                <li><a class="dropdown-item" href="#">Sala de estar</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>


                <table class="table table-borderless table-css" style="padding-left: 90px !important; padding-top: 30px !important">
                    <thead>
                        <tr>
                            <th class="cod-space" scope="col">Cod#</th>
                            <th class="name-space" scope="col">Nome</th>
                            <th class="ctg-space" scope="col">Categoria</th>
                            <th class="qtd-space" scope="col">Quantidade</th>
                            <th scope="col">Valor</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>R$350,00</td>
                            <td><a href=""><i data-feather="edit-2"></i></a></td>

                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>R$350,00</td>
                            <td><a href=""><i data-feather="more-horizontal"></i></a></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                            <td>R$350,00</td>
                            <td><a href=""><i data-feather="more-vertical"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        feather.replace()
    </script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?= BS_JS_PATH ?>"></script>

</body>

</html>