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
<html>

<head>
    <meta charset="utf-8">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="css/inicio.css" rel="stylesheet" type="text/css">

</head>

<body class="loggedin">
    <nav class="navtop">
        <div>
            <h1>Sistema de Login Básico ConfiguroWeb</h1>
            <a href="perfil.php"><i class="fas fa-user-circle"></i>Información de Usuario</a>
            <a href="cerrar-sesion.php"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
        </div>
    </nav>
    <div class="content">
        <h2>¡Bienvenido!</h2>
        <p>Hola de nuevo, <?= $_SESSION['username'] ?> !!!</p>
        <p class="center-button"><a href="index.php" class="btn">Entrar</a></p>
    </div>
</body>

</html>