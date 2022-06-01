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

                    <ul class="nav flex-column align-items-center mb-5" id="menu">
                        <li class="nav-item">
                            <h6>Data Inicial</h6>
                            <input class="form-control date" type="date">
                        </li>

                        <li class="nav-item mb-1">
                            <h6>Data Final</h6>
                            <input class="form-control date" type="date">
                        </li>


                        <li class="nav-item type-style">
                            <h6>Tipo Relatório</h6>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Entrada
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Saída
                                </label>
                            </div>
                        </li>

                        <li class="nav-item text-center">
                            <button class="btn btn-pdf mb-5">Gerar Relatório</button>
                        </li>
                    </ul>

                    <button class="btn btn-download" onclick="generatePDF()">
                        <i data-feather="download"></i> Baixar PDF
                    </button>
                </div>
            </div>

            <div class="col-lg-9 p-3 h-100">
                <div class="card p-4 h-100">
                    <div class="d-flex" style="justify-content: space-between;">
                        <h5>Data Inicial: <?= date('d/m/Y') ?></h5>
                        <h5> Data Final: <?= date('d/m/Y') ?></h5>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <tr>
                                    <th scope="row">xx/xx/xxxx</th>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxx</td>
                                    <td>R$xx,xx</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>0101</td>
                                    <td>copo de Gin</td>
                                    <td>1</td>
                                    <td>R$350,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>0102</td>
                                    <td>Vaso de flor</td>
                                    <td>2</td>
                                    <td>R$50,00</td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">xx/xx/xxxx</th>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxx</td>
                                    <td>R$xx,xx</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>0101</td>
                                    <td>copo de Gin</td>
                                    <td>1</td>
                                    <td>R$350,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>0102</td>
                                    <td>Vaso de flor</td>
                                    <td>2</td>
                                    <td>R$50,00</td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">xx/xx/xxxx</th>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxx</td>
                                    <td>R$xx,xx</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>0101</td>
                                    <td>copo de Gin</td>
                                    <td>1</td>
                                    <td>R$350,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>0102</td>
                                    <td>Vaso de flor</td>
                                    <td>2</td>
                                    <td>R$50,00</td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>0102</td>
                                    <td>Vaso de flor</td>
                                    <td>2</td>
                                    <td>R$50,00</td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">xx/xx/xxxx</th>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxx</td>
                                    <td>R$xx,xx</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>0101</td>
                                    <td>copo de Gin</td>
                                    <td>1</td>
                                    <td>R$350,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>0102</td>
                                    <td>Vaso de flor</td>
                                    <td>2</td>
                                    <td>R$50,00</td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">xx/xx/xxxx</th>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxxxxxxxxx</td>
                                    <td>xxx</td>
                                    <td>R$xx,xx</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>0101</td>
                                    <td>copo de Gin</td>
                                    <td>1</td>
                                    <td>R$350,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>0102</td>
                                    <td>Vaso de flor</td>
                                    <td>2</td>
                                    <td>R$50,00</td>
                                    <td>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h5>Total: <b>R$500,00</b></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="produtos/criar">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col p-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nome</label>
                                        <input id="name" type="text" class="form-control default-border" name="name" placeholder="Nome">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Categoria</label>
                                        <select id="category" class="form-control no-border default-border" name="category">
                                            <option>Selecione uma categoria</option>
                                            <option>Cozinha</option>
                                            <option>Banheiro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="produtos/atualizar/<?= 2 ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col p-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nome</label>
                                        <input id="name" class="form-control default-border" name="name" placeholder="Nome">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Categoria</label>
                                        <select id="category" class="form-control no-border default-border" name="category">
                                            <option>Selecione uma categoria</option>
                                            <option>Cozinha</option>
                                            <option>Banheiro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="<?= ROOT_PATH ?>produtos/remover/<?= 2 ?>" class="btn btn-danger">Remover</a>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?= BS_JS_PATH ?>"></script>

    <script>
        feather.replace()

        function generatePDF() {
            //$("#table-body");
            var docDefinition = {
                content: [
                    'hello'
                ]
            };


            var now = new Date();

            pdfmake.createPdf(docDefinition).download();
        }
    </script>
</body>