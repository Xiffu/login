<?php
http_response_code(404);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada | 404</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        h1 {
            font-size: 120px;
            margin-bottom: 20px;
        }
        p {
            font-size: 20px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>404</h1>
    <p>Lo sentimos, la página que estás buscando no existe o ha sido movida.</p>
    <p>Puede que te interese volver a la <a href="index.html">página de inicio</a> o utilizar el menú de navegación para encontrar lo que buscas.</p>
</div>

</body>
</html>
