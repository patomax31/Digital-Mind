document.addEventListener("DOMContentLoaded", function () {
    const headerPlaceholder = document.createElement("div");
    headerPlaceholder.id = "header-placeholder";

    
    document.body.insertBefore(headerPlaceholder, document.body.firstChild);

<<<<<<< HEAD
<<<<<<< HEAD
    fetch("../PHP/header.html")
        .then(response => response.text())
=======
    
    fetch("../PHP/header.html")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar el header");
            }
            return response.text();
        })
>>>>>>> 4cadc2d (Ernesto)
=======
    
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
>>>>>>> 1757bcd3474208667417995af9ce4eacc58b127d
        .then(data => {
            headerPlaceholder.innerHTML = data;
        })
        .catch(error => console.error("Error al cargar el header:", error));
});
