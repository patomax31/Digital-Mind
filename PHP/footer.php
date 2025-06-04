<html>
<style>
footer {
  background: linear-gradient(135deg, #0f1c24 0%, #1e3c4f 100%);
  color: #ffffff;
  padding: 60px 0 20px;
  font-family: 'Roboto', sans-serif;
  position: relative;
  overflow: hidden;
}

footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #00d2ff, #3a7bd5);
}

.footer-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  position: relative;
  z-index: 1;
}

.footer-links {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 30px;
  margin-bottom: 40px;
}

.footer-column {
  padding: 0 15px;
}

.footer-column h4 {
  color: #ffffff;
  font-size: 20px;
  margin-bottom: 20px;
  position: relative;
  padding-bottom: 10px;
  font-weight: 600;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.footer-column h4::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 40px;
  height: 2px;
  background: #00d2ff;
  transition: width 0.3s ease;
}

.footer-column:hover h4::after {
  width: 60px;
}

.footer-column ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-column ul li {
  margin-bottom: 12px;
}

.footer-column ul li a {
  color: #ffffff;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-block;
  position: relative;
  padding-left: 0;
  font-weight: 500;
  font-size: 15px;
}

.footer-column ul li a:hover {
  color: #00d2ff;
  padding-left: 5px;
  text-shadow: 0 0 8px rgba(0, 210, 255, 0.3);
}

.social-icons {
  text-align: center;
  margin: 40px 0;
}

.social-icons a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  margin: 0 10px;
  font-size: 20px;
  color: #ffffff;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  transition: all 0.3s ease;
}

.social-icons a:hover {
  transform: translateY(-3px);
  background: #00d2ff;
  color: #fff;
  box-shadow: 0 5px 15px rgba(0, 210, 255, 0.3);
}

footer p {
  font-size: 14px;
  color: #ffffff;
  text-align: center;
  margin-top: 20px;
  padding-top: 20px;
  border-top: 1px solid rgba(255, 255, 255, 0.2);
  font-weight: 500;
}

@media (max-width: 768px) {
  .footer-links {
    grid-template-columns: 1fr;
    text-align: center;
  }

  .footer-column h4::after {
    left: 50%;
    transform: translateX(-50%);
  }

  .footer-column ul li a:hover {
    padding-left: 0;
  }
}

footer {
  background-color: #294c5b;
  color: #fff;
  text-align: center;
  padding: 15px 0;
  margin-top: 40px;
}
.footer-content {
  background-color: none;
  padding: 40px 20px;
  text-align: center;
}

/* ...y el resto */

  </style>


 <footer>
 
 <div class="footer-content">
  
    <!-- Enlaces organizados por categorías -->
    <div class="footer-links">
      <div class="footer-column">
        <h4>Sobre Nosotros</h4>
        <ul>
          <li><a href="about_us.php">Quiénes somos</a></li>
          <li><a href="about_us.php#mision-vision">Misión y visión</a></li>
          <li><a href="about_us.php#equipo">Nuestro equipo</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h4>Categoría</h4>
        <ul>
          <li><a href="categoria.php?categoria=Educacion Primaria">Educación Primaria</a></li>
          <li><a href="categoria.php?categoria=Educacion Secundaria">Educación Secundaria</a></li>
          <li><a href="categoria.php?categoria=Educacion Preparatoria">Educación Preparatoria</a></li>
          <li><a href="categoria.php?categoria=Metodos de Aprendizaje">Métodos de Aprendizaje</a></li>
          <li><a href="categoria.php?categoria=Educacion Vocacional">Educación Vocacional</a></li>
          <li><a href="categoria.php?categoria=Habilidades de Redaccion">Habilidades de Redacción</a></li>
          <li><a href="categoria.php?categoria=Ciencia y Matematicas">Ciencia y Matemáticas</a></li>
          <li><a href="categoria.php?categoria=Para Tutores">Para Tutores</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h4>Contacto</h4>
        <ul>
          <li><a href="contact_page.php">Página de contacto</a></li>
          <li><a href="mailto:digitalmindsocial@gmail.com">Escríbenos</a></li>
          <li><a href="tel:+3141278485392">Llámanos</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h4>Enlaces Rápidos</h4>
        <ul>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="blog_add.php">Crear Blog</a></li>
          <li><a href="login.php">Iniciar sesión</a></li>
        </ul>
      </div>
    </div>

    <!-- Redes sociales -->
    <div class="social-icons">
      <a href="https://www.facebook.com/share/197WiYUdQW/?mibextid=wwXIfr" target="_blank" rel="noopener"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/min_ddigital?igsh=MXNvOHhwZXd1MjRnag==&utm_source=ig_contact_invite" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
      <a href="https://www.youtube.com/@DIgitalMind-k2k9y" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
      <a href="https://x.com/Digital_Mind_so" target="_blank" rel="noopener"><i class="fab fa-x-twitter"></i></a>
    </div>

    <!-- Derechos -->
    <p>Derechos Reservados &reg; Digital-Mind &copy; <?php echo date('Y'); ?></p>
  </div>
</footer>
</html>