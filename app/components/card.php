<body class="test">    
    <div class="container">
        <?php
        // Diretório onde as imagens foram enviadas
        $target_dir = "./uploads/";

        // Verifica se o diretório existe
        if (is_dir($target_dir)) {
            // Obtém todos os arquivos no diretório
            $files = glob($target_dir . "*.{jpg,jpeg}", GLOB_BRACE);

            // Exibe as imagens
            foreach ($files as $file) {
                $description_file = $target_dir . pathinfo($file, PATHINFO_FILENAME) . ".txt";
                $description = file_exists($description_file) ? file_get_contents($description_file) : "Sem descrição";
                echo "<div class='card' style='width: 18rem;'>";
                echo "<img src='$file' alt='class='card-img-top'. basename($file) . ' style='max-width: 300px; height: 200px; margin: 10px;'>";
                echo "<p class='card-text'>" . htmlspecialchars($description) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhuma imagem encontrada.</p>";
        }
        ?>
    </div>

</body>