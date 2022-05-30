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

                    <div class="d-flex pb-3">
                        <span class="d-sm-inline" style="margin-top: 50px;">Visão Geral</span>
                    </div>
                    <ul class="nav nav-pills flex-column align-items-start" id="menu">
                        <li class="nav-item">
                            <h6>Quantidade</h6>
                            <h2>83</h2>
                        </li>

                        <li class="nav-item">
                            <h6>Saldo</h6>
                            <h2>R$3.243,00</h2>
                        </li>

                        <li class="nav-item">
                            <h6>Restoques necessários</h6>
                            <h2>3</h2>
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


                    <div class="d-flex my-sm-2">
                        <input class="form-control search no-border" type="search" placeholder="Pesquisar">
                        <button class="btn btn-search" type="submit"><i data-feather="search"></i></button>

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


                <div class="table-responsive">
                    <table class="table table-css table-borderless">
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
                                <td><a class="details" onclick="productDetails(1)"><i data-feather="more-vertical"></i></a></td>

                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td>R$350,00</td>
                                <td><a class="details" onclick="productDetails(2)"><i data-feather="more-vertical"></i></a></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                                <td>R$350,00</td>
                                <td><a class="details" onclick="productDetails(3)"><i data-feather="more-vertical"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
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
                                <div class="col p-3">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nome</label>
                                        <input required id="name" type="text" class="form-control default-border input-product-name" name="name" placeholder="Nome">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Descrição</label>
                                        <textarea required id="description" type="text" class="form-control default-border desc-textarea" name="description" placeholder="Descrição"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Categoria</label>
                                        <select required id="category" class="form-control no-border default-border category-select" placeholder="Selecione uma categoria" name="category">
                                            <option value="" disabled selected hidden>Selecione uma categoria</option>
                                            <option>Cozinha</option>
                                            <option>Banheiro</option>
                                            <option>Sala</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Adicionar Foto</label>
                                        <br>
                                        <label for="image" class="btn btn-success upload-btn"><i data-feather="camera"></i> Escolher</label>

                                        <input id="image" type="file" name="image" accept="image/*" onchange="generatePreview(this)" hidden>
                                    </div>
                                    <img class="img-responsive img preview bg-danger">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
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
                                        <input id="name" class="form-control default-border input-product-name" name="name" placeholder="ex. Copo de vidro">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Categoria</label>
                                        <select id="category" class="form-control no-border default-border category-select" name="category">
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
                        <a href="<?= ROOT_PATH ?>produtos/remover/<?= 2 ?>" class="btn btn-danger remove-btn">Remover</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= JS_PATH ?>/jquery.min.js"></script>
    <script src="<?= BS_JS_PATH ?>"></script>

    <script>
        feather.replace()

        function productDetails(id) {
            $("#productDetailsModal").modal('toggle');
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