<?php
    $movementsController = new MovementsController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentos</title>

    <link rel="stylesheet" href="<?= BS_CSS_PATH ?>">
    <link rel="stylesheet" href="<?= DEFAULT_CSS_PATH ?>">
    <link rel="stylesheet" href="<?= CSS_PATH ?>/movements.css">

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

            <div class="offset-lg-1 col-lg-9" style="height: 80%">
                <nav class="navbar p-4">
                    <div class="d-inline-flex justify-content-center align-items-center">
                        <h1 class="navbar-brand">Movimentação</h1><br>
                        <a href="#" class="btn-round green" onclick="openModal('Entrada')">
                            <i data-feather="plus"></i>
                        </a>&nbsp;&nbsp;&nbsp;

                        <a href="#" class="btn-round red" onclick="openModal('Saída')">
                            <i data-feather="minus"></i>
                        </a>
                    </div>
                </nav>

                <?php
                    $movements = $movementsController->getAll();
                    $hide = "";    
                    if (!$movements) {
                        echo "<div class='mx-4'>Nenhum movimento encontrado.</div>";
                        $hide = "d-none";
                    }
                ?>
                
                <div class="table-responsive <?=$hide?> mx-4 card" style="border: 0;">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Código Mov.</th>
                                <th>Nome Produto</th>
                                <th>Data</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                                <th>Valor Total</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach($movements as $movement){
                                $id = $movement['id'];
                                $date = $movement['date'];
                                $price = $movement['price'];
                                $amount = $movement['amount'];

                                $date = formatDate($date); 
                                $total = formatCurrency($price * $amount);
                                $price = formatCurrency($price);

                                $type = $movement['type'];
                                
                                echo "<tr class='tablerow-${type[0]}'>
                                    <td>$id</th>
                                    <td>${movement['name']}</td>
                                    <td>$date</td>
                                    <td>$amount</td>
                                    <td>$price</td>
                                    <td>$total</td>
                                    <td>$type</td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php View::render("timer") ?>
        </div>
    </div>

    <div class="modal fade" id="newMovementModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form" method="POST" onsubmit="return validateForm()" action="<?=ROOT_PATH?>movimentos/criar">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">Nova Movimentação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <input id="type" type="hidden" name="type">

                                <div class="col-6 mb-3">
                                    <label for="product" class="form-label">Produto</label>
                                    <select required id="product" class="form-control modal-input no-border default-border" onchange="autoFill(this)" name="id_product">
                                        <option value="" disabled selected hidden>Selecionar Produto</option>
                                        <?php
                                            $productController = new ProductController();
                                            $products = $productController->getAll();
                                            foreach($products as $product){
                                                echo "<option value='${product['id']}'>${product['name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="amount" class="form-label">Quantidade</label>
                                    <input required id="amount" min="1" type="number" class="form-control modal-input default-border" name="amount" placeholder="Quantidade">
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="price" class="form-label">Preço</label>
                                    <input required id="price" type="text" class="form-control modal-input default-border" name="price" placeholder="Preço">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-create" type="submit" class="btn btn-dark">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <script src="<?= JS_PATH ?>/jquery.min.js"></script>
    <script src="<?= BS_JS_PATH ?>"></script>
    <script src="<?= JS_PATH ?>/jquery.maskMoney.min.js"></script>

    <script>
        feather.replace();
        const INACTIVITY_TIME = <?= INACTIVITY_TIME?>;
        const ROOT_PATH = '<?= ROOT_PATH?>';
    </script>
    <script src="<?= JS_PATH ?>/timer.js"></script>

    <script type="text/javascript">
        function openModal(type){
            $("#title").html(`Movimentação de ${type}`);
            $("#type").val(type);
            $("#newMovementModal").modal('toggle');
            $("#btn-create").html(`Nova ${type}`);

            if (type == "Entrada")
                $("#amount").attr({"min" : 1});
            else
                $("#amount").attr({"min" : 0});
        }

        function autoFill(select){
            var id = select.selectedOptions[0].value;

            $.get(`${ROOT_PATH}/produtos/detalhes/${id}`, function(data, status){
                console.log(data);
                var product = JSON.parse(data);
                
                if (product.length == 0)
                    goTo("logout");

                var price;
                var type = $('#type').val();
                if (type == 'Entrada')
                    price = product.price_in;
                else
                    price = product.price_out;

                $('#price').val('R$ ' + Intl.NumberFormat('pt-BR').format(price));
            });
        }

        function validateForm(){
            var id = document.getElementById('product').selectedOptions[0].value; 
            var amount = document.getElementById('amount').value; 

            $.get(`${ROOT_PATH}/produtos/detalhes/${id}`, function(data, status){
                console.log(data);
                var product = JSON.parse(data);
                
                if (product.length == 0)
                    goTo("logout");

                if(amount <= product.amount)
                    document.getElementById('form').submit(); 
                else
                    alert("Tentativa de saída maior que estoque!");
            });


            return false;
        }

        $(function() {
            $('#price').maskMoney({prefix:'R$ ', thousands:'.', decimal:',', allowZero: true});
        })

        function goTo(link){
	        window.location = ROOT_PATH + link;
        }
    </script>
</body>

</html>