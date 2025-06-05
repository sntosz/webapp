<?php

require_once __DIR__ . "/app/models/imagesModel.php";


echo '<pre>';
print_r($_FILES['foto']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['foto'])) {
        $imagem = $_FILES['foto'];

        // tratamento para tipo de arquivos apenas imagens
        $mimeTypesPermitidas = ['image/jpeg', 'image/png'];
        $extensoesPermitidas = ['jpg', 'jpeg', 'png'];

        // se o mime da imagem não estiver na lista: erro
        if (!in_array($imagem['type'], $mimeTypesPermitidas)) {
            die('Tipo de arquivo inválido!');
        }

        //verifica o tamanho da imagem
        if ($imagem['size'] > 1024*1024*16) {
            die('O tamanho da imagem é muito grande!');
        }

        // parse da extensão do arquivo e verifica se é valido
        $extensaoImagem = strtolower(pathinfo(
            $imagem['name'], 
            PATHINFO_EXTENSION
        ));
        if (!in_array($extensaoImagem, $extensoesPermitidas)) {
            die('Extensão de arquivo inválida!');
        }

        $diretorioDestino = './uploads/';
        if (!file_exists($diretorioDestino)) {
            mkdir($diretorioDestino);
        }

        // tratamento para manter o nome único
        $nomeUnico = uniqid() . '_' . $imagem['name'];
        $caminhoImagem = $diretorioDestino . $nomeUnico;

        $salvou = move_uploaded_file(
            $imagem['tmp_name'],
            $caminhoImagem
        );

        if ($salvou){
            $imagemModel = new imagesModel();
            $imagemModel->criar([
                ':nome' => $nomeUnico,
                ':nome_original'=>  $imagem['name'],
                ':caminho' => $caminhoImagem
            ]);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <?php if ($salvounobanco): ?>
        <p>
            Imagem salva com sucesso em <?= $caminhoImagem ?>.
            <a href="index.php">Voltar</a>
        </p>
    <?php endif ?>
</body>
</html>