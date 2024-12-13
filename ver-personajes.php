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
    <title>Tus Personajes - Gestión de Dragones y Mazmorras</title>
    <link rel="stylesheet" href="css/welcome.css">
</head>
<body>
    <div class="navtop">
        <div>
            <h1>Tus Personajes</h1>
            <a href="index.php">Volver a la Taberna</a>
        </div>
    </div>

    <div class="wrapper">
        <h1>Tus Personajes Creados</h1>
        
        <div class="content">
            <!-- Aquí iría la lógica para mostrar los personajes creados -->
            <div class="character-item">
                <h3>Nombre del Personaje</h3>
                <p>Rango: Guerrero</p>
                <p>Nivel: 1</p>
                <button class="btn">Ver Detalles</button>
            </div>
            <!-- Repite este bloque para cada personaje -->
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Todos los derechos reservados</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>

