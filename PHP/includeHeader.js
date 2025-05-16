document.addEventListener("DOMContentLoaded", function () {
    const headerPlaceholder = document.createElement("div");
    headerPlaceholder.id = "header-placeholder";

    
    document.body.insertBefore(headerPlaceholder, document.body.firstChild);


    fetch("../PHP/header.html")
        .then(response => response.text())
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 4cadc2d (Ernesto)
=======

>>>>>>> 41afdea (cambis realizados)
=======

>>>>>>> 4ba691b268f4ddda4db76639c1b483eb7f31d4ea
    
    fetch("../PHP/header.html")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar el header");
            }
            return response.text();
        })
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 4cadc2d (Ernesto)
=======
>>>>>>> 4cadc2d (Ernesto)
=======
=======
>>>>>>> 4ba691b268f4ddda4db76639c1b483eb7f31d4ea

    
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
>>>>>>> 41afdea (cambis realizados)
=======
>>>>>>> 4ba691b268f4ddda4db76639c1b483eb7f31d4ea
        .then(data => {
            headerPlaceholder.innerHTML = data;
        })
        .catch(error => console.error("Error al cargar el header:", error));
});
