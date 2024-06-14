<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>K2</title>
</head>

<body>
  <!-- Header -->
  <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
      </ul>
    </header>
  </div>

  <div class="container mt-5">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="file" class="form-label">Selecione uma imagem:</label>
        <input type="file" name="file" id="file" class="form-control" />
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Descrição:</label>
        <input type="text" name="description" id="description" class="form-control" />
      </div>
      <button type="submit" class="btn btn-primary">Fazer Upload</button>
    </form>
  </div>

  <div class="container mt-5">
    <h1>Imagens Carregadas</h1>

    <div class="gallery">
      <?php
      // Diretório onde as imagens foram enviadas
      $target_dir = "./uploads/";

      // Verifica se o diretório existe
      if (is_dir($target_dir)) {
        // Obtém todos os arquivos no diretório
        $files = glob($target_dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

        // Exibe as imagens
        foreach ($files as $file) {
          $description_file = $target_dir . pathinfo($file, PATHINFO_FILENAME) . ".txt";
          $description = file_exists($description_file) ? file_get_contents($description_file) : "Sem descrição";
          echo "<div class='image-item'>";
          echo "<img src='$file' alt='" . basename($file) . "' style='max-width: 300px; height: auto; margin: 10px;'>";
          echo "<p>" . htmlspecialchars($description) . "</p>";
          echo "</div>";
        }
      } else {
        echo "<p>Nenhuma imagem encontrada.</p>";
      }
      ?>
    </div>
  </div>
</body>

</html>