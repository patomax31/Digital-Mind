window.addEventListener('load',() => {
    const progress = document.getElementById('progress');
    requestAnimationFrame(update);
})

function update(){
    progress.style.width = `${((window.scrollY) / (document.body.scrollHeight - window.innerHeight) * 100)}%`; /*Para comillas invertidas es alt + 96*/ 
    requestAnimationFrame(update);
}

function showModal(title, message) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('feedbackModal').style.display = 'flex';
}


// Barra de progreso y botón de scroll
window.onscroll = function() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;
    document.querySelector(".progress").style.width = scrolled + "%";
    
    document.getElementById("scrollBtn").style.display = winScroll > 300 ? "block" : "none";
};

document.getElementById("scrollBtn").addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});

// Sistema de valoración por estrellas
function setupStarRating() {
    const stars = document.querySelectorAll('.star-rating label');
    
    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            for (let i = 0; i < stars.length; i++) {
                stars[i].previousElementSibling.checked = i <= index;
            }
        });
        
        star.addEventListener('mouseover', () => {
            for (let i = 0; i <= index; i++) {
                stars[i].style.color = '#ffc107';
            }
        });
        
        star.addEventListener('mouseout', () => {
            const checkedInput = document.querySelector('.star-rating input:checked');
            const checkedIndex = checkedInput ? 
                Array.from(document.querySelectorAll('.star-rating input')).indexOf(checkedInput) : -1;
                
            stars.forEach((s, i) => {
                s.style.color = i <= checkedIndex ? '#ffc107' : '#ccc';
            });
        });
    });

    // Inicializar colores
    const checkedInput = document.querySelector('.star-rating input:checked');
    if (checkedInput) {
        const checkedIndex = Array.from(document.querySelectorAll('.star-rating input')).indexOf(checkedInput);
        stars.forEach((s, i) => {
            s.style.color = i <= checkedIndex ? '#ffc107' : '#ccc';
        });
    }
}

// Función para mostrar modales
function showModal(title, message) {
    const modal = document.getElementById('feedbackModal');
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    modal.style.display = 'flex';
    
    // Cerrar modal al hacer clic fuera del contenido
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
}

