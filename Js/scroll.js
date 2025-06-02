document.addEventListener("DOMContentLoaded", function () {
    let scrollBtn = document.createElement("button");
    scrollBtn.id = "scrollBtn";
    scrollBtn.innerHTML = "⬆"; 

    document.body.appendChild(scrollBtn);

    window.addEventListener("scroll", () => {
        if (window.scrollY > 200) { 
            scrollBtn.classList.add("visible");
        } else {
            scrollBtn.classList.remove("visible");
        }
    });

    scrollBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const progressBar = document.getElementById("bidirectionalProgress");
    let lastScrollPosition = window.pageYOffset;
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

    function updateBidirectionalProgress() {
        const currentScrollPosition = window.pageYOffset;
        const scrolled = (currentScrollPosition / scrollHeight) * 100;

        if (currentScrollPosition > lastScrollPosition) {
            // Usuario baja → Actualizar ancho y mostrar barra
            progressBar.style.width = scrolled + "%";
            progressBar.classList.add("visible");
        } else if (currentScrollPosition < lastScrollPosition) {
            // Usuario sube → Actualizar ancho (retrocediendo)
            progressBar.style.width = scrolled + "%";
            // La barra ya debería estar visible si bajó antes
        }

        // Si el usuario está en la parte superior, ocultar la barra
        if (currentScrollPosition === 0) {
            progressBar.style.width = "0%";
            progressBar.classList.remove("visible");
        }

        lastScrollPosition = currentScrollPosition;
    }

    window.addEventListener("scroll", function () {
        requestAnimationFrame(updateBidirectionalProgress);
    });

    // Inicializar la barra con ancho 0
    progressBar.style.width = "0%";
});