<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón Subir con PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 2000px; /* Simula una página larga */
            padding: 20px;
        }

        #btnSubir {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        #btnSubir:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <?php
    echo '<h1>Desplázate hacia abajo para ver el botón</h1>';
    echo '<button id="btnSubir" onclick="subir()">⬆ Subir</button>';
    ?>

    <script>
        window.onscroll = function () {
            let btn = document.getElementById("btnSubir");
            if (document.documentElement.scrollTop > 300) {
                btn.style.display = "block";
            } else {
                btn.style.display = "none";
            }
        };

        function subir() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>

</body>
</html>
