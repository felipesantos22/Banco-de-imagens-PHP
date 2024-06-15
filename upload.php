<?php
// Diretório onde o arquivo será salvo
$target_dir = "./uploads/";

// Verifica se o diretório 'uploads' existe, se não, cria-o
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$response = [
    "success" => false,
    "message" => "",
    "filename" => "",
    "description" => ""
];

// Verifica se foi enviado um arquivo e se ocorreu algum erro
if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $file_info = pathinfo($_FILES["file"]["name"]);
    $file_extension = strtolower($file_info["extension"]);

    // Extensões permitidas
    $allowed_image_extensions = ['jpg', 'jpeg'];
    $allowed_video_extensions = ['mp4', 'avi', 'mov'];

    // Verifica se a extensão é permitida
    if (in_array($file_extension, $allowed_image_extensions) || in_array($file_extension, $allowed_video_extensions)) {
        // Caminho completo do arquivo
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Tenta mover o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // Obtém a descrição do campo de formulário
            $description = htmlspecialchars($_POST["description"]);

            // Salva a descrição em um arquivo .txt
            $description_file = $target_dir . pathinfo($target_file, PATHINFO_FILENAME) . ".txt";
            file_put_contents($description_file, $description);

            // Define a resposta
            $response["success"] = true;
            $response["filename"] = basename($_FILES["file"]["name"]);
            $response["description"] = $description;
        } else {
            $response["message"] = "Desculpe, ocorreu um erro ao enviar seu arquivo.";
        }
    } else {
        $response["message"] = "Desculpe, apenas arquivos JPG, JPEG, MP4, AVI, e MOV são permitidos.";
    }
} else {
    $response["message"] = "Desculpe, ocorreu um erro no envio do arquivo.";
}

// Retorna a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
