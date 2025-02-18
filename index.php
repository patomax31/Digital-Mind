<?php
    // Declaración del código PHP

    // 1. Declaración de variables
    $mensaje = "Hola Mundo";

    // 2. Funciones (opcional)
    function saludar($nombre) {
        return "Hola, " . $nombre;
    }

    // 3. Lógica del programa
    $nombre = "Usuario";
    $saludo = saludar($nombre);

    // 4. Salida de datos
    echo $mensaje . "<br>"; // Imprime "Hola Mundo"
    echo $saludo;           // Imprime "Hola, Usuario"
?>