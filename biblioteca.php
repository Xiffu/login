<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Gestión de Dragones y Mazmorras</title>
    <link rel="stylesheet" href="css/welcome.css">
</head>
<body>
    <div class="navtop">
        <div>
            <h1>Biblioteca</h1>
            <a href="index.php">Volver a la Taberna</a>
        </div>
    </div>

    <div class="wrapper">
        <h1>Biblioteca de Conocimientos</h1>
        
        <div class="content">
            <h2>Categorías</h2>
            <ul class="category-list">
                <li><a href="#" class="btn" onclick="cargarContenido('hechizos')">Hechizos</a></li>
                <li><a href="#" class="btn" onclick="cargarContenido('monstruos')">Monstruos</a></li>
                <li><a href="#" class="btn" onclick="cargarContenido('objetos')">Objetos Mágicos</a></li>
                <li><a href="#" class="btn" onclick="cargarContenido('razas')">Razas</a></li>
                <li><a href="#" class="btn" onclick="cargarContenido('clases')">Clases</a></li>
            </ul>
        </div>

        <div id="contenido-biblioteca" class="content">
            <!-- El contenido se cargará aquí dinámicamente -->
            <p>Selecciona una categoría para ver su contenido.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Todos los derechos reservados</p>
    </footer>

    <script src="js/main.js"></script>
    <script>
    function cargarContenido(categoria) {
        // Aquí normalmente harías una llamada AJAX para cargar el contenido
        // Por ahora, simplemente cambiaremos el texto
        const contenido = document.getElementById('contenido-biblioteca');
        contenido.innerHTML = `<h2>Contenido de ${categoria}</h2><p>Aquí se mostraría la información sobre ${categoria}.</p>`;
    }
    </script>
</body>
</html>