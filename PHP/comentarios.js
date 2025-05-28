document.getElementById('commentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('comments.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              alert("Comentario publicado");
              location.reload(); // Refresca los comentarios sin recargar la página
          } else {
              alert("Error al publicar comentario");
          }
      });
});
