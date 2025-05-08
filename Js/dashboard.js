document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.menu');

    menuToggle.addEventListener('click', function() {
        menu.classList.toggle('open');
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const dashboardContainer = document.getElementById('dashboard-container');
    const loadDashboardButton = document.createElement('button');
    loadDashboardButton.textContent = 'Mostrar Panel de Control';
    document.querySelector('main').insertBefore(loadDashboardButton, dashboardContainer);

    loadDashboardButton.addEventListener('click', function() {
        fetch('/dashboard/index.php') // La ruta al archivo PHP del dashboard
            .then(response => response.text())
            .then(data => {
                dashboardContainer.innerHTML = data;
                loadDashboardButton.style.display = 'none';
            })
            .catch(error => {
                console.error('Error al cargar el dashboard:', error);
                dashboardContainer.textContent = 'Error al cargar el panel de control.';
            });
    });
});