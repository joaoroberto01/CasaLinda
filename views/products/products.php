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
            <div class="col-lg-3 col-md-12 p-4 sidebar">
                <div class="d-flex flex-column align-items-start px-3 pt-2">
                    <a class="btn-round" href="<?= ROOT_PATH ?>"><i data-feather="arrow-left"></i></a>

                    <div class="d-flex mt-5 pb-3">
                        <h2>Visão Geral</span>
                    </div>
                    <ul class="nav nav-pills flex-column align-items-start" id="menu">
                        <li class="nav-item">
                            <h6>Quantidade</h6>
                            <h2><?=$productController->getProductsSize()?></h2>
                        </li>

                        <li class="nav-item">
                            <h6>Saldo</h6>
                            <h2>R$3.243,00</h2>
                        </li>

                        <li class="nav-item">
                            <h6>Restoques necessários</h6>
                            <h2><?=$productController->getRestockNeeded()?></h2>
                        </li>
                    </ul>
                    <!-- <hr> -->
                </div>
            </div>

            <div class="col-lg-9">
                <nav class="navbar p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="navbar-brand">Produtos</h1>
                        <a href="" class="btn-round dark-hover d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#newProductModal">
                            <i data-feather="plus"></i>
                        </a>
                    </div>

                    <form method="POST">
                        <div class="d-flex my-sm-2">
                            
                            <input class="form-control search no-border" type="search" name="search" placeholder="Pesquisar">
                            <button class="btn btn-dark btn-search" type="submit"><i data-feather="search"></i></button>

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
                    </form>
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
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Quantidade</th>
                                <th>Preço Base</th>
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
                                    <td><a class='details' onclick='productDetails($id)''><i data-feather='more-vertical'></i></a></td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="<?=ROOT_PATH?>produtos/criar">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="name" class="form-label">Nome</label>
                                    <input required id="name" type="text" class="form-control modal-input default-border" name="name" placeholder="Nome">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="category" class="form-label">Categoria</label>
                                    <select required id="category" class="form-control modal-input no-border default-border" placeholder="Selecione uma categoria" name="category">
                                        <option value="" disabled selected hidden>Selecione uma categoria</option>
                                        <option>Cozinha</option>
                                        <option>Banheiro</option>
                                        <option>Sala</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">Descrição</label>
                                    <textarea required id="description" type="text" class="form-control modal-input default-border desc-textarea" name="description" placeholder="Descrição"></textarea>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="amount" class="form-label">Quantidade</label>
                                    <input required id="amount" type="number" class="form-control modal-input default-border" name="amount" placeholder="Quantidade">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="price" class="form-label">Valor Base (R$)</label>
                                    <input required id="price" type="number" class="form-control modal-input default-border" name="price" placeholder="Valor Base (R$)">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Adicionar Foto</label>
                                    <br>
                                    <label for="image" class="btn btn-success upload-btn"><i data-feather="camera"></i> Escolher</label>

                                    <input id="image" type="file" name="image" accept="image/*" onchange="generatePreview(this)" hidden>
                                </div>
                                <img class="img-responsive img preview">
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="update-form" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="nameDetail" class="form-label">Nome</label>
                                    <input required id="nameDetail" type="text" class="form-control modal-input default-border" name="name" placeholder="Nome">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="categoryDetail" class="form-label">Categoria</label>
                                    <select required id="categoryDetail" class="form-control modal-input no-border default-border" placeholder="Selecione uma categoria" name="category">
                                        <option value="" disabled selected hidden>Selecione uma categoria</option>
                                        <option>Cozinha</option>
                                        <option>Banheiro</option>
                                        <option>Sala</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="descriptionDetail" class="form-label">Descrição</label>
                                    <textarea required id="descriptionDetail" type="text" class="form-control modal-input default-border desc-textarea" name="description" placeholder="Descrição"></textarea>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="amountDetail" class="form-label">Quantidade</label>
                                    <input required id="amountDetail" type="number" class="form-control modal-input default-border" name="amount" placeholder="Quantidade">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="priceDetail" class="form-label">Valor Base (R$)</label>
                                    <input required id="priceDetail" type="number" class="form-control modal-input default-border" name="price" placeholder="Valor Base (R$)">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Adicionar Foto</label>
                                    <br>
                                    <label for="imageDetail" class="btn btn-success upload-btn"><i data-feather="camera"></i> Escolher</label>

                                    <input id="imageDetail" type="file" name="image" accept="image/*" onchange="generatePreview(this)" hidden>
                                </div>
                                <img id="preview" class="img-responsive img preview">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="remove-btn" class="btn btn-danger remove-btn">Remover</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= JS_PATH ?>/jquery.min.js"></script>
    <script src="<?= BS_JS_PATH ?>"></script>

    <script>feather.replace();</script>

    <script type="text/javascript">
        function productDetails(id) {
            $.get(<?= ROOT_PATH?> + "/produtos/detalhes/" + id, function(data, status){
                console.log(data);
                var product = JSON.parse(data);

                $("#nameDetail").val(product.name);
                $("#categoryDetail").val(product.category);
                $("#descriptionDetail").val(product.description);
                $("#amountDetail").val(product.amount);
                $("#priceDetail").val(product.price);
                

                document.getElementById("remove-btn").onclick = function(){
                    if(confirm("Deseja remover o produto?")){
                        window.location = <?= ROOT_PATH ?> + `produtos/remover/${product.id}`;
                    }
                }
                document.getElementById("update-form").action = <?= ROOT_PATH?> + `produtos/atualizar/${product.id}`;
                document.getElementById("preview").src = product.image;

                $("#productDetailsModal").modal('toggle');
            });

        }

        function generatePreview(fileInput) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementsByClassName('preview')[0];
                preview.src = reader.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    </script>
</body>

</html>