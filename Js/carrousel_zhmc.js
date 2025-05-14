const grande = document.querySelector('.grande');
const puntos = document.querySelectorAll('.punto');

puntos.forEach((punto, i) => {
    punto.addEventListener('click', () => {
        let posicion = i * -100; // Desplazar según el índice
        grande.style.transform = `translateX(${posicion}%)`;
    });
});