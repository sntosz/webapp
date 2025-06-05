<?php
require_once __DIR__ . "/app/models/imagesModel.php";
$imageModel = new imagesModel();
$imagens = $imageModel->BuscarTodas();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <form action="upload.php"
        method="POST"
        enctype="multipart/form-data">
        <input type="file" name="foto" accept="image/*">
        <button type="submit">Enviar</button>
    </form>

    <h1>Lista de imagens</h1>
    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
        <?php foreach($imagens  as $images){
            echo $images['nome_original'];

        }
    ?>
    </div>
</body>
</html>