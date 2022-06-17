<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Erro - <?= $errorMessage ?></title>

    <link rel="stylesheet" href="<?=BS_CSS_PATH?>">
    <link rel="stylesheet" href="<?= DEFAULT_CSS_PATH ?>">
</head>
<body>
    <script type="text/javascript">
        alert('<?= $errorMessage ?>');
        window.location = '<?= $link ?>';
    </script>
</body>
</html>