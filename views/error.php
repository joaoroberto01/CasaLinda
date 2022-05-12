<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Erro na rota</title>

    <link rel="stylesheet" href="<?=BS_CSS_PATH?>">
</head>
<body>
    <h2>Error :(</h2>
    <p>Maybe this <?= $errorMessage ?> doesn't exist or is invalid. Tried: <?= $_SERVER['REQUEST_URI']?></p>
</body>
</html>