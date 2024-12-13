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
    <title>Creador de Aventuras - Gestión de Dragones y Mazmorras</title>
    <link rel="stylesheet" href="css/welcome.css">
</head>
<body>
    <div class="navtop">
        <div>
            <h1>Creador de Aventuras</h1>
            <a href="index.php">Volver a la Taberna</a>
        </div>
    </div>

    <div class="wrapper">
        <h1>Crea tu Propia Aventura</h1>
        
        <div class="content">
            <form id="adventure-form">
                <div class="form-group">
                    <label for="adventure-name">Nombre de la Aventura:</label>
                    <input type="text" id="adventure-name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="adventure-description">Descripción:</label>
                    <textarea id="adventure-description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="adventure-level">Nivel Recomendado:</label>
                    <input type="number" id="adventure-level" class="form-control" min="1" max="20" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear Aventura</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Todos los derechos reservados</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>

