// script.js

document.addEventListener("DOMContentLoaded", function() {
    // Validación del formulario cuando se envíe
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const titular = document.getElementById('titular').value.trim();
        const contenido = document.getElementById('contenido').value.trim();

        if (titular.length < 10 || contenido.length < 50) {
            e.preventDefault();  // Evitar el envío del formulario
            alert('El título debe tener al menos 10 caracteres y el contenido 50 caracteres.');
        }
    });

    // Puedes agregar más funciones JavaScript aquí según sea necesario.
});
