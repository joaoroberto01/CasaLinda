<?php
$movementsController = new MovementsController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>


    <link rel="stylesheet" href="<?= BS_CSS_PATH ?>">
    <link rel="stylesheet" href="<?= DEFAULT_CSS_PATH ?>">
    <link rel="stylesheet" href="<?= CSS_PATH ?>/reports.css">

    <script src="<?= JS_PATH ?>/feather.min.js"></script>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-3 col-md-12 p-4 sidebar">
                <div class="d-flex flex-column align-items-start px-3 pt-2">
                    <a class="btn-round" href="<?= ROOT_PATH ?>">
                        <i data-feather="arrow-left"></i>
                    </a>
                </div>
                <div class="d-flex flex-column align-items-center px-3 pt-2">
                    <div class="flex-column align-items-center justify-content-center text-center" style="margin: 5% 0%;">
                        <h2>Relatório</h2>
                    </div>
                    <form method="POST">
                        <?php
                        $type = isset($_POST['type']) ? $_POST['type'] : "Entrada";
                        $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : $movementsController->getFirstMovementDate();
                        $finalDate = isset($_POST['finalDate']) ? $_POST['finalDate'] : date('Y-m-d');

                        $startDateF = formatDate($startDate, "d/m/Y");
                        $finalDateF = formatDate($finalDate, "d/m/Y");


                        $data = ['type' => $type, 'startDate' => $startDate, 'finalDate' => $finalDate];
                        $data = base64_encode(json_encode($data));

                        ?>
                        <ul class="nav flex-column align-items-center mb-5" id="menu">
                            <li class="nav-item">
                                <h6>Data Inicial</h6>
                                <input class="form-control date" type="date" name="startDate" value="<?= substr($startDate, 0, 10) ?>">
                            </li>

                            <li class="nav-item mb-1">
                                <h6>Data Final</h6>
                                <input class="form-control date" type="date" name="finalDate" value="<?= $finalDate?>">
                            </li>


                            <li class="nav-item type-style">
                                <h6>Tipo Relatório</h6>
                                <?php
                                $checkedIn = "";
                                $checkedOut = "";
                                if($_POST){
                                    if($_POST["type"] == "Entrada")
                                        $checkedIn = "checked";
                                    else
                                        $checkedOut = "checked";
                                }else
                                    $checkedIn = "checked";
                                ?>
                                <div class="form-check">
                                    <input id="in" class="form-check-input radio" type="radio" name="type" value="Entrada"<?= $checkedIn?> >
                                    <label class="form-check-label" for="in">Entrada</label>
                                </div>
                                <div class="form-check">
                                    <input id="out" class="form-check-input radio" type="radio" name="type" value="Saída" <?= $checkedOut?>>
                                    <label class="form-check-label" for="out">Saída</label>
                                </div>
                            </li>

                            <li class="nav-item text-center">
                                <button class="btn btn-pdf mb-5">Gerar Relatório</button>
                            </li>
                        </ul>
                    </form>
                    <a class="btn btn-download" href="<?= ROOT_PATH?>relatorios/pdf/<?=$data?>">
                        <i data-feather="download"></i> Baixar PDF
                    </a>
                </div>
            </div>
            <div class="col-lg-9 p-3 h-100">
                <div class="card p-4">
                    <div class="d-flex" style="justify-content: space-between;">
                        <h5>De: <?= "$startDateF - Até: $finalDateF"?></h5>
                    </div>
                    <hr>
                    <?php

                    $movements = $movementsController->getReport($type, $startDate, $finalDate);
                    $hide = "";    
                    if (!$movements) {
                        echo "<b>Nenhum movimento encontrado.</b>";
                        $hide = "d-none";
                    }
                    ?>

                    <div class="table-responsive <?=$hide?>">
                        <table class="table table-css table-borderless">
                            <thead>
                                <tr>
                                    <th>Data e Hora</th>
                                    <th>Nome Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço</th>
                                    <th>Valor Total</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sum = 0;
                                foreach($movements as $movement){
                                    $date = $movement['date'];
                                    $price = $movement['price'];
                                    $amount = $movement['amount'];

                                    $date = formatDate($date);

                                    $total = $price * $amount;
                                    $sum += $total;
                                    $total = formatCurrency($total);
                                    $price = formatCurrency($price);
                                    
                                    echo "<tr>
                                    <td>$date</td>
                                    <td>${movement['name']}</td>
                                    <td>$amount</td>
                                    <td>R\$$price</td>
                                    <td>R\$$total</td>
                                    <td>${movement['type']}</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h5>Total: R$<?= number_format($sum, 2, ",", ".");?></h5>
                </div>

                <?php View::render('timer') ?>
            </div>
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?= BS_JS_PATH ?>"></script>
    <script>
        feather.replace();
        const INACTIVITY_TIME = <?= INACTIVITY_TIME?>;
        const ROOT_PATH = '<?= ROOT_PATH?>';
    </script>
    <script src="<?= JS_PATH ?>/timer.js"></script>
</body>