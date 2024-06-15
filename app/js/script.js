$(document).ready(function () {
  $("#upload").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "upload.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
          $("#result").html(
            "<p>O arquivo " +
              response.filename +
              ' foi enviado com sucesso.</p><p><a href="./uploads/' +
              response.filename +
              '">Clique aqui para ver o arquivo</a></p><p>Descrição: ' +
              response.description +
              "</p>"
          );
          setTimeout(function () {
            location.reload(); // Recarrega a página após 2 segundos
          }, 2000);
        } else {
          $("#result").html("<p>" + response.message + "</p>");
        }
      },
      error: function () {
        $("#result").html(
          "<p>Desculpe, ocorreu um erro no envio do arquivo.</p>"
        );
      },
    });
  });
});
