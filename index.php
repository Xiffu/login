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
    <title>Gestión de Dragones y Mazmorras</title>
    <link rel="stylesheet" href="css/welcome.css">
</head>
<body>
    <div class="navtop">
        <div>
            <h1>Taberna</h1>
        </div>
    </div>

    <div class="wrapper">
        <h1>Bienvenido, aventurero</h1>
        <h2>Inicia tu jornada</h2>
        
        <div class="content">
            <h2>Gestión de Personajes</h2>
            <a href="crear-personaje.php" class="btn btn-primary">Crear Nuevo Personaje</a>
            <a href="ver-personajes.php" class="btn">Ver Tus Personajes</a>
        </div>

        <div class="content">
            <h2>Aventuras</h2>
            <a href="creador-aventuras.php" class="btn">Crear Aventura</a>
        </div>

        <div class="content">
            <h2>Herramientas</h2>
            <a href="https://www.dungeonscrawl.com/" target="_blank" class="btn">Ir a Dungeon Scrawl</a>
        </div>

        <div class="content">
            <h2>Biblioteca</h2>
            <a href="biblioteca.php" class="btn">Consultar Biblioteca</a>
        </div>

        <div class="content">
            <h2>Reglas del Juego</h2>
            <a href="reglas.php" class="btn">Ver Reglas</a>
        </div>

        <div class="content">
            <h2>Campañas Disponibles</h2>
            <div class="campaign-item">
                <h3>La Mazmorras Perdida</h3>
                <p>Reúne a tu grupo y adéntrate en las profundidades para encontrar el tesoro perdido...</p>
                <button class="btn" onclick="unirseACampana('La Mazmorras Perdida')">Unirse a la campaña</button>
            </div>
            <div class="campaign-item">
                <h3>La Sombra del Dragón</h3>
                <p>¡El dragón ha vuelto! Defiende el reino y derrota a la criatura en este épico viaje...</p>
                <button class="btn" onclick="unirseACampana('La Sombra del Dragón')">Unirse a la campaña</button>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Todos los derechos reservados</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
