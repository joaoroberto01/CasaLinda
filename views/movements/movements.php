<?php
    $productController = new ProductController();
?>
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

    <script src="<?= JS_PATH ?>/feather.min.js"></script>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-1 col-md-12 p-4 sidebar">
                <div class="d-flex flex-column align-items-start px-3 pt-2">
                    <a class="btn-round" href="<?= ROOT_PATH ?>"><i data-feather="arrow-left"></i></a>
                    <!-- <hr> -->
                </div>
            </div>

            <div class="col-lg-9">
                <nav class="navbar p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="navbar-brand">Movimentação</h1>
                    </div>
                </nav>

                <?php
                    if($_POST)
                        $products = $productController->getAll("WHERE name LIKE ?", ["%${_POST['search']}%"]);
                    else
                        $products = $productController->getAll();
                            
                    $hide = "";    
                    if (!$products) {
                        echo "<b>Nenhum produto encontrado.</b>";
                        $hide = "d-none";
                    }
                ?>

                <div class="table-responsive <?=$hide?>">
                    <table class="table table-css table-borderless">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Data</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                                <th>Cod Produto</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach($products as $product){
                                $id = $product['id'];
                                $price = number_format($product['price'], 2, ",", ".");
                                echo "<tr>
                                    <td>$id</th>
                                    <td>${product['name']}</td>
                                    <td>${product['category']}</td>
                                    <td>${product['amount']}</td>
                                    <td>R\$$price</td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <script src="<?= JS_PATH ?>/jquery.min.js"></script>
    <script src="<?= BS_JS_PATH ?>"></script>

    <script>feather.replace();</script>

    <script type="text/javascript">
        
    </script>
</body>

</html>