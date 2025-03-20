document.addEventListener("DOMContentLoaded", function() {
    const headerPlaceholder = document.createElement("div");
    headerPlaceholder.id = "header-placeholder";

    document.body.insertBefore(headerPlaceholder, document.body.firstChild);

    fetch("header.html")
        .then(response => response.text())
        .then(data => {
            headerPlaceholder.innerHTML = data;
        })
        .catch(error => console.error("Error al cargar el header:", error));
});

