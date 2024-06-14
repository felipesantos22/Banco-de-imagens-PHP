<?php
// Diretório onde o arquivo será salvo
$target_dir = "./uploads/";

// Verifica se o diretório 'uploads' existe, se não, cria-o
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Verifica se foi enviado um arquivo e se é do tipo esperado (JPEG)
if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $file_info = pathinfo($_FILES["file"]["name"]);
    $file_extension = strtolower($file_info["extension"]);

    // Verifica se a extensão é jpg/jpeg
    if ($file_extension != "jpg" && $file_extension != "jpeg") {
        echo "Desculpe, apenas arquivos JPG são permitidos.";
    } else {
        // Caminho completo do arquivo
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Tenta mover o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // Obtém a descrição do campo de formulário
            $description = htmlspecialchars($_POST["description"]);

            // Salva a descrição em um arquivo ou banco de dados
            // Para este exemplo, vamos salvar em um arquivo de texto
            $description_file = $target_dir . pathinfo($target_file, PATHINFO_FILENAME) . ".txt";
            file_put_contents($description_file, $description);

            echo "O arquivo " . htmlspecialchars(basename($_FILES["file"]["name"])) . " foi enviado com sucesso.";
        } else {
            echo "Desculpe, ocorreu um erro ao enviar seu arquivo.";
        }
    }
} else {
    echo "Desculpe, ocorreu um erro no envio do arquivo.";
}
