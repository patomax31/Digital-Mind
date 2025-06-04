
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Categorías | DIGITALMIND</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9f9;
      margin: 0;
      padding: 0;
      padding-top: 70px;
    }

    .categorias-container {
      max-width: 1100px;
      margin: auto;
      padding: 40px 20px;
    }

    .categoria-listado {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
    }

    .categoria-card {
      background: white;
      border-radius: 14px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      text-align: center;
      transition: transform 0.2s;
      cursor: pointer;
      border: 1px solid #d6eaea;
    }

    .categoria-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .categoria-card i {
      font-size: 2.5em;
      color: #4aa0a2;
      margin-bottom: 10px;
    }

    .categoria-card h3 {
      margin: 8px 0 4px;
      font-size: 1.2em;
      color: #222;
    }

    .categoria-card span {
      display: block;
      font-size: 0.95em;
      color: #555;
      font-weight: 500;
      margin-bottom: 8px;
    }

    .categoria-card p {
      font-size: 0.88em;
      color: #666;
    }

    .cta-contacto {
      text-align: center;
      margin-top: 50px;
      padding: 30px;
      background-color: #e8f5f5;
      border-radius: 16px;
    }

    .cta-contacto h2 {
      font-size: 1.5em;
      color: #0077cc;
    }

    .cta-contacto a {
      display: inline-block;
      margin-top: 16px;
      padding: 12px 28px;
      background-color: #0077cc;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
    }

    .cta-contacto a:hover {
      background-color: #005fa3;
    }
  </style>
</head>
<body>

  <div class="categorias-container">
    <div class="categoria-listado">
      <div class="categoria-card" onclick="location.href='categoria.php?categoria=Educacion Primaria'">
        <i class="bi bi-pencil-square"></i>
        <h3>Educación Primaria</h3>
        <span>Primeros pasos del aprendizaje</span>
        <p>Material educativo para niños en sus primeras etapas escolares.</p>
      </div>

      <div class="categoria-card" onclick="location.href='categoria.php?categoria=Educacion Secundaria'">
        <i class="bi bi-backpack2"></i>
        <h3>Educación Secundaria</h3>
        <span>Formación intermedia</span>
        <p>Recursos para estudiantes de secundaria que consolidan sus conocimientos.</p>
      </div>

      <div class="categoria-card" onclick="location.href='categoria.php?categoria=Educacion Preparatoria'">
        <i class="bi bi-journal-bookmark"></i>
        <h3>Educación Preparatoria</h3>
        <span>Transición a la educación superior</span>
        <p>Contenidos que preparan a los jóvenes para el nivel universitario.</p>
      </div>

      <div class="categoria-card" onclick="location.href='categoria.php?categoria=Metodos de Aprendizaje'">
        <i class="bi bi-lightbulb"></i>
        <h3>Métodos de Aprendizaje</h3>
        <span>Estrategias efectivas</span>
        <p>Técnicas que mejoran la forma de estudiar, comprender y retener información.</p>
      </div>

      <div class="categoria-card" onclick="location.href='categoria.php?categoria=Educacion Vocacional'">
        <i class="bi bi-tools"></i>
        <h3>Educación Vocacional</h3>
        <span>Formación técnica</span>
        <p>Orientación y recursos para carreras técnicas y oficios especializados.</p>
      </div>

      <div class="categoria-card" onclick="location.href='categoria.php?categoria=Habilidades de Redaccion'">
        <i class="bi bi-pen"></i>
        <h3>Habilidades de Redacción</h3>
        <span>Escritura efectiva</span>
        <p>Consejos y prácticas para mejorar la escritura académica y creativa.</p>
      </div>

      <div class="categoria-card" onclick="location.href='categoria.php?categoria=Ciencia y Matematicas'">
        <i class="bi bi-calculator"></i>
        <h3>Ciencia y Matemáticas</h3>
        <span>Lógica y descubrimiento</span>
        <p>Experimentos, ejercicios y teorías del mundo científico y matemático.</p>
      </div>

      <div class="categoria-card" onclick="location.href='categoria.php?categoria=Para Tutores'">
        <i class="bi bi-person-check"></i>
        <h3>Para Tutores</h3>
        <span>Apoyo educativo</span>
        <p>Guías y recursos para quienes acompañan el proceso educativo de otros.</p>
      </div>
    </div>

    <div class="cta-contacto">
      <h2>¿Tienes dudas o quieres colaborar?</h2>
      <a href="contact_page.php">Contáctanos</a>
    </div>
  </div>

</body>
</html>
<?php include 'footer.php'; ?>