<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "blog_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set
$conn->set_charset("utf8mb4");

// Function to get the latest posts from the database
function getLatestPosts($conn, $limit = 3) {
    $sql = "SELECT id, titular, descripcion_corta, contenido, fecha, referencia 
            FROM publicaciones_2 
            ORDER BY fecha_creacion DESC 
            LIMIT ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    
    $stmt->close();
    return $posts;
}

// Get the latest posts
$latestPosts = getLatestPosts($conn);

// Close the connection
$conn->close();

// Default images for carousel if no custom images are specified
$defaultImages = [
    "../images/MAPA-MENTAL-EJEMPLO-1.jpg",
    "../images/educaciondecalidad.png", 
    "../images/montessori_metodo.webp"
];

// Generate HTML for carousel
?>

<div class="image-section">
    <div class="carrusel">
        <div class="carousel-images">
            <?php foreach ($latestPosts as $index => $post): ?>
                <div class="carousel-item">
                    <img src="<?php echo isset($post['imagen']) ? $post['imagen'] : $defaultImages[$index % count($defaultImages)]; ?>" 
                         alt="<?php echo htmlspecialchars($post['titular']); ?>">
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="carousel-text-overlay">
            <?php foreach ($latestPosts as $index => $post): ?>
                <div class="carousel-text-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <h3><?php echo htmlspecialchars($post['titular']); ?></h3>
                    <p><?php echo htmlspecialchars($post['descripcion_corta']); ?></p>
                    <div class="carousel-description">
                        <?php 
                        // Get a short excerpt from the content (first 150 characters)
                        $excerpt = substr(strip_tags($post['contenido']), 0, 150);
                        if (strlen($post['contenido']) > 150) $excerpt .= '...';
                        echo htmlspecialchars($excerpt); 
                        ?>
                    </div>
                    <a href="view_post.php?id=<?php echo $post['id']; ?>" class="carousel-button">Ver más</a>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="carousel-buttons">
            <button class="carousel-prev">&lt;</button>
            <button class="carousel-next">&gt;</button>
        </div>
        
        <div class="carousel-indicators">
            <?php for ($i = 0; $i < count($latestPosts); $i++): ?>
                <span class="indicator <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></span>
            <?php endfor; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carrusel');
    const items = carousel.querySelectorAll('.carousel-item');
    const textItems = carousel.querySelectorAll('.carousel-text-item');
    const prevBtn = carousel.querySelector('.carousel-prev');
    const nextBtn = carousel.querySelector('.carousel-next');
    const indicators = carousel.querySelectorAll('.indicator');
    let currentIndex = 0;
    
    // Function to update carousel display
    function updateCarousel() {
        // Hide all items and text
        items.forEach(item => item.style.display = 'none');
        textItems.forEach(item => item.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // Show current item and text
        items[currentIndex].style.display = 'block';
        textItems[currentIndex].classList.add('active');
        indicators[currentIndex].classList.add('active');
    }
    
    // Event listener for prev button
    prevBtn.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        updateCarousel();
    });
    
    // Event listener for next button
    nextBtn.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % items.length;
        updateCarousel();
    });
    
    // Event listeners for indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            currentIndex = index;
            updateCarousel();
        });
    });
    
    // Auto-rotate the carousel every 5 seconds
    setInterval(function() {
        currentIndex = (currentIndex + 1) % items.length;
        updateCarousel();
    }, 5000);
    
    // Initialize carousel
    updateCarousel();
});
</script>