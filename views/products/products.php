<?php
    $productController = new ProductController();
    $movementsController = new MovementsController();

    $categories = getCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>

    

    <link rel="stylesheet" href="<?= BS_CSS_PATH ?>">   
    <link rel="stylesheet" href="<?= BS_MULTISELECT_CSS_PATH ?>" type="text/css"/>

    <link rel="stylesheet" href="<?= DEFAULT_CSS_PATH ?>">
    <link rel="stylesheet" href="<?= CSS_PATH ?>/products.css">

    <script src="<?= JS_PATH ?>/feather.min.js"></script>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-3 col-xl-3 col-md-12 p-4 sidebar">
                <div class="d-flex flex-column align-items-start px-3 pt-2">
                    <a class="btn-round" href="<?= ROOT_PATH ?>"><i data-feather="arrow-left"></i></a>

                    <div class="d-flex mt-5 pb-3">
                        <h2>Visão Geral</span>
                    </div>
                    <ul class="nav nav-pills flex-column align-items-start" id="menu">
                        <li class="nav-item">
                            <h6>Nº de Produtos</h6>
                            <h2><?=$productController->getProductsCount()?></h2>
                        </li>

                        <li class="nav-item">
                            <h6>Saldo Líquido</h6>
                            <h2><?=formatCurrency($movementsController->getProfit())?></h2>
                        </li>

                        <?php
                            $restockProducts = $productController->getRestockNeeded();
                            $count = count($restockProducts);
                            $content = "Os seguintes produtos precisam ser restocados:\n<ul>";

                            foreach($restockProducts as $rp){
                                $content .= "<li>${rp['name']}</li>";
                            }
                            $content .= "</ul>";

                            $popover = "data-bs-toggle='popover' data-bs-trigger='hover focus' data-bs-placement='right' title='Atenção' data-bs-html='true' data-bs-content='$content'";
                            ?>
                        <li class="nav-item" <?=$popover?>>
                            <h6>Restoques necessários</h6>
                            <h2><?=$count?></h2>
                        </li>
                    </ul>
                    <!-- <hr> -->
                </div>
            </div>

            <div class="col-lg-9" style="height: 80%">
                <nav class="navbar p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="navbar-brand">Produtos</h1>
                        <a href="" class="btn-round dark-hover d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#newProductModal">
                            <i data-feather="plus"></i>
                        </a>
                    </div>

                    <form method="POST">
                        <div class="d-flex my-sm-2">
                            <select class="filter no-border default-border" data-placeholder="Filtrar Por Categoria" name="category[]" multiple="multiple">
                                <?php
                                    foreach($categories as $category)
                                        echo "<option>$category</option>";
                                ?>
                            </select>

                            <input class="form-control search no-border" type="search" name="search" placeholder="Pesquisar">
                            <button class="btn btn-dark btn-search" type="submit"><i data-feather="search"></i></button>
                        </div>
                    </form>
                </nav>

                <?php
                    if($_POST){
                        $filterCategories = isset($_POST['category']) ? $_POST['category'] : [];

                        $query = "WHERE name LIKE ?";

                        if (count($filterCategories) > 0) {
                            $filterCategories = array_map(
                                function($item){return "'$item'";}
                                , $filterCategories);

                            $fields = implode(",", $filterCategories);
                            $query .= " AND category IN ($fields)";
                        }

                        $products = $productController->getAll($query, ["%${_POST['search']}%"]);
                    } else
                        $products = $productController->getAll();
                            
                    $hide = "";    
                    if (!$products) {
                        echo "<b>Nenhum produto encontrado.</b>";
                        $hide = "d-none";
                    }
                ?>

                <div class="table-responsive <?=$hide?> mx-4 pl-3 card" style="border: 0;">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Quantidade</th>
                                <th>Entrada</th>
                                <th>Saída</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach($products as $product){
                                $id = $product['id'];
                                $amount = $product['amount'];

                                $price_in = formatCurrency($product['price_in']);
                                $price_out = formatCurrency($product['price_out']);
                                echo "<tr>";
                                if($amount <= RESTOCK_LIMIT)
                                    echo "<td class='p-1 text-center td-icon'>
                                            <i class='warning' data-feather='alert-triangle' data-bs-toggle='popover' data-bs-trigger='hover focus' data-bs-placement='left' title='Atenção' data-bs-content='Restoque necessário!'></i>
                                        </td>";
                                else
                                    echo "<td></td>";

                                echo "<td>$id</td>
                                    <td>${product['name']}</td>
                                    <td>${product['category']}</td>
                                    <td>$amount</td>
                                    <td>$price_in</td>
                                    <td>$price_out</td>
                                    <td><a class='details' onclick='productDetails($id)'><i data-feather='more-vertical'></i></a></td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php View::render("timer") ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="newProductModal-form" method="POST" action="<?=ROOT_PATH?>produtos/criar" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Produto</h5>
                        <button type="button" class="btn-close" onclick="closeModal('newProductModal')" data-dismiss="modal" bs-dismiss="modal" aria-label="Close"></button>
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
                                    <select required id="category" class="modal-input no-border default-border" data-placeholder="Selecionar categoria" name="category[]" multiple="multiple">
                                        <?php
                                            foreach($categories as $category)
                                                echo "<option>$category</option>";
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">Descrição</label>
                                    <textarea required id="description" type="text" class="form-control modal-input default-border desc-textarea" name="description" placeholder="Descrição"></textarea>
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="in" class="form-label">Valor entrada</label>
                                    <input required id="in" type="text" class="form-control input-price modal-input default-border" name="price_in" placeholder="Valor entrada">
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="out" class="form-label">Valor saída</label>
                                    <input required id="out" type="text" class="form-control input-price modal-input default-border" name="price_out" placeholder="Valor saída">
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="amount" class="form-label">Quantidade</label>
                                    <input required id="amount" type="number" class="form-control modal-input default-border" name="amount" placeholder="Quantidade">
                                </div>

                                <div class="col-6 mb-3">
                                    <label class="form-label">Adicionar Foto</label>
                                    <br>
                                    <label for="image" class="btn btn-success upload-btn"><i data-feather="camera"></i> Escolher</label>

                                    <input id="image" type="file" name="image" accept="image/*" onchange="generatePreview(this)" hidden>
                                </div>

                                <div class="col-12">
                                    <img id="newProductModal-preview" class="img-responsive img preview">
                                </div>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="update-form" method="POST" enctype="multipart/form-data">
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
                                    <select required id="categoryDetail" class="form-control modal-input no-border default-border" placeholder="Selecione uma categoria" name="category[]" multiple="multiple">
                                        <?php

                                            foreach($categories as $category)
                                                echo "<option class='detailOption'>$category</option>";
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="descriptionDetail" class="form-label">Descrição</label>
                                    <textarea required id="descriptionDetail" type="text" class="form-control modal-input default-border desc-textarea" name="description" placeholder="Descrição"></textarea>
                                </div>

                                <!--  -->
                                <div class="col-6 mb-3">
                                    <label for="inDetail" class="form-label">Valor entrada</label>
                                    <input required id="inDetail" type="text" class="form-control input-price modal-input default-border" name="price_in" placeholder="Valor entrada">
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="outDetail" class="form-label">Valor saída</label>
                                    <input required id="outDetail" type="text" class="form-control input-price modal-input default-border" name="price_out" placeholder="Valor saída">
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Adicionar Foto</label>
                                    <br>
                                    <label for="imageDetail" class="btn btn-success upload-btn"><i data-feather="camera"></i> Escolher</label>

                                    <input id="imageDetail" type="file" name="image" accept="image/*" onchange="generatePreview(this, 1)" hidden>
                                </div>

                                
                                <div class="col-12">
                                    <img id="productDetailsModal-preview" class="img-responsive img preview">
                                </div>
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
    <script src="<?= BS_PATH ?>/js/popper.min.js"></script>
    <script src="<?= BS_BUNDLE_JS_PATH ?>"></script>
    <script src="<?= BS_MULTISELECT_JS_PATH ?>"></script>

    <script src="<?= JS_PATH ?>/jquery.maskMoney.min.js"></script>

    <script>
        feather.replace();
        const INACTIVITY_TIME = <?= INACTIVITY_TIME?>;  
        const ROOT_PATH = '<?= ROOT_PATH?>';
        
        [...document.querySelectorAll('[data-bs-toggle="popover"]')]
            .forEach(el => new bootstrap.Popover(el));

        $(document).ready(function() {
            $("select[multiple='multiple']").bsMultiSelect();
            $('.input-price').maskMoney({prefix:'R$ ', thousands:'.', decimal:','});
        });        
    </script>
    <script src="<?= JS_PATH ?>/timer.js"></script>

    <script type="text/javascript">
        function productDetails(id) {
            $.get(ROOT_PATH + "/produtos/detalhes/" + id, function(data, status){
                console.log(data);
                var product = JSON.parse(data);
                if (product.length == 0)
                    window.location = "logout";

                $("#nameDetail").val(product.name);
                $("#descriptionDetail").val(product.description);
                $("#inDetail").val(product.price_in);
                $("#outDetail").val(product.price_out);

                var options = document.getElementsByClassName('detailOption');
                var categories = product.category.split(", ");

                for (var i = 0; i < options.length; i++) {
                    options[i].selected = false;
                    if(categories.indexOf(options[i].value) != -1)
                        options[i].selected = true;
                }
                $('select').bsMultiSelect("UpdateOptionsSelected");

                if(product.image)
                    document.getElementById("productDetailsModal-preview").src = '<?= (ROOT_PATH . PRODUCT_IMAGES_PATH) ?>' + product.image;
                

                document.getElementById("remove-btn").onclick = function(){
                    if(confirm("Deseja remover o produto?"))
                        goTo(`produtos/remover/${product.id}`);
                }
                document.getElementById("update-form").action = ROOT_PATH + `produtos/atualizar/${product.id}`;

                $("#productDetailsModal").modal('toggle');
            });
        }

        function closeModal(id){
            $(`#${id}-form`)[0].reset();
            document.getElementById(`${id}-preview`).src = '';
            $(`#${id}`).modal('hide');
        }

        function generatePreview(fileInput, which = 0) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementsByClassName('preview')[which];
                preview.src = reader.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }

        function goTo(link){
	        window.location = ROOT_PATH + link;
        }
    </script>
</body>

</html>