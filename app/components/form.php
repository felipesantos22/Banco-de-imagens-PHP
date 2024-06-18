<div class="container mt-5">
    <form id="upload" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="file" class="form-label">Selecione uma imagem ou vídeo: Tamanho máximo 5M</label>
            <input type="file" name="file" id="file" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrição:</label>
            <input type="text" name="description" id="description" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Fazer Upload</button>
    </form>
    <div id="result" class="mt-3"></div>
</div>