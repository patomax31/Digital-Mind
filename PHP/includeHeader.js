document.addEventListener("DOMContentLoaded", function () {
    const headerPlaceholder = document.createElement("div");
    headerPlaceholder.id = "header-placeholder";

    
    document.body.insertBefore(headerPlaceholder, document.body.firstChild);

<<<<<<< HEAD
<<<<<<< HEAD
    fetch("../PHP/header.html")
        .then(response => response.text())
=======
=======
>>>>>>> 4cadc2d (Ernesto)
    
    fetch("../PHP/header.html")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar el header");
            }
            return response.text();
        })
<<<<<<< HEAD
>>>>>>> 4cadc2d (Ernesto)
=======
>>>>>>> 4cadc2d (Ernesto)
        .then(data => {
            headerPlaceholder.innerHTML = data;
        })
        .catch(error => console.error("Error al cargar el header:", error));
});
