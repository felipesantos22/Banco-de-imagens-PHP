<div class="container" style="display: flex; flex-wrap: wrap; justify-content: center;">
    <?php
    // Diretório onde os arquivos foram enviados
    $target_dir = "./uploads/";

    // Verifica se o diretório existe
    if (is_dir($target_dir)) {
        // Obtém todos os arquivos no diretório
        $files = glob($target_dir . "*.{jpg,jpeg,mp4}", GLOB_BRACE);

        // Exibe as imagens e vídeos
        foreach ($files as $file) {
            $description_file = $target_dir . pathinfo($file, PATHINFO_FILENAME) . ".txt";
            $description = file_exists($description_file) ? file_get_contents($description_file) : "Sem descrição";
            echo "<div class='card' style='width: 18rem; margin: 30px; text-align: center;'>";

            $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if (in_array($file_extension, ['jpg', 'jpeg'])) {
                echo "<img src='$file' alt='" . basename($file) . "' style='max-width: 300px; height: 200px; margin: 10px;'>";
            } elseif ($file_extension === 'mp4') {
                echo "<video controls style='max-width: 300px; height: 200px; margin: 10px;'>
                        <source src='$file' type='video/mp4'>
                      </video>";
            }

            echo "<p class='card-text' style='text-align: center; margin: 10px; font-family: Impact'>" . htmlspecialchars($description) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Nenhuma imagem ou vídeo encontrado.</p>";
    }
    ?>
</div>