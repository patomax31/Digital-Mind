document.addEventListener("DOMContentLoaded", function () {
    const headerPlaceholder = document.createElement("div");
    headerPlaceholder.id = "header-placeholder";

    
    document.body.insertBefore(headerPlaceholder, document.body.firstChild);


    fetch("../PHP/header.html")
        .then(response => response.text())

    


    
    fetch("../PHP/header.html")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar el header");
            }
            return response.text();
        })

<<<<<<< HEAD
=======

>>>>>>> b96bec3519df3943985c14a12020efe15b8ecff7
    
    fetch("../PHP/header.html")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar el header");
            }
            return response.text();
        })

    fetch("../PHP/header.html")
        .then(response => response.text())

<<<<<<< HEAD
=======

>>>>>>> b96bec3519df3943985c14a12020efe15b8ecff7
        .then(data => {
            headerPlaceholder.innerHTML = data;
        })
        .catch(error => console.error("Error al cargar el header:", error));
});
