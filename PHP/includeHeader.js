document.addEventListener("DOMContentLoaded", function () {
    const headerPlaceholder = document.createElement("div");
    headerPlaceholder.id = "header-placeholder";

    
    document.body.insertBefore(headerPlaceholder, document.body.firstChild);

<<<<<<< HEAD
    
    fetch("../PHP/header.html")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar el header");
            }
            return response.text();
        })
=======
    fetch("../PHP/header.html")
        .then(response => response.text())
>>>>>>> fc9b2ff62cf04ec4456ca54ef5ca9afbfb4f9dfa
        .then(data => {
            headerPlaceholder.innerHTML = data;
        })
        .catch(error => console.error("Error al cargar el header:", error));
});
