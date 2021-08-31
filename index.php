<?php
    if (isset($_FILES) && isset($_FILES['arquivo_imagem'])) {
        // Recuperando o arquivo
        $image = $_FILES['arquivo_imagem']['name'];

        // Caminho da pasta
        $upload_dir = './imagens/';

        // Mover do temporário para o fixo
        move_uploaded_file($_FILES['arquivo_imagem']['tmp_name'], $upload_dir . $image);

        // Arquivo com caminho
        $arquivo_imagem = $upload_dir . $image;

        // Criando variáveis com as informações do arquivo
        list($width_imagem, $height_imagem) = getimagesize($arquivo_imagem);

        // Caso a imagem tenha uma width maior que 150
        if ($width_imagem > 150) {
            // Reduzindo largura e comprimento em 30%
            $width_resized = $width_imagem * 0.70;
            $height_resized = $height_imagem * 0.70;
    
            // It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
            $imagem_resized = imagecreatetruecolor($width_resized, $height_resized);
            $source = imagecreatefromjpeg($arquivo_imagem);
    
            
            imagecopyresized(
                $imagem_resized,
                $source,
                0,
                0,
                0,
                0,
                $width_resized,
                $height_resized,
                $width_imagem,
                $height_imagem
            );
    
            
            imagejpeg($imagem_resized, $arquivo_imagem, 100);
            
            echo 'Enviado e redimensionado!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wally Uploader</title>
</head>
<body>
    <h1>
        Wally
    </h1>
    <form action="./index.php" method="POST" enctype="multipart/form-data">
        <label for="arquivo_imagem">Envie sua foto aqui</label> <br><br>
        <input type="file" name="arquivo_imagem" id="arquivo_imagem"> <br> <hr>
        <button type="submit">Enviar</button>
    </form>

    <?php
        if (isset($file)) {
            ?>
                <img src="<?= $file ?>" alt="Imagem enviada">
            <?php
        }
    ?>
</body>
</html>