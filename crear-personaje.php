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
    <title>Crear Personaje - Gestión de Dragones y Mazmorras</title>
    <link rel="stylesheet" href="css/welcome.css">
    <style>
        .character-sheet {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .section {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="navtop">
        <div>
            <h1>Crear Personaje</h1>
            <a href="index.php">Volver a la Taberna</a>
        </div>
    </div>

    <div class="wrapper">
        <form id="character-form" class="character-sheet">
            <div class="section">
                <h2>Información Básica</h2>
                <div class="grid-2">
                    <div class="form-group">
                        <label for="nombre">Nombre del personaje:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="raza">Raza:</label>
                        <select id="raza" name="raza" class="form-control" required>
                            <option value="">Selecciona una raza</option>
                            <option value="humano">Humano</option>
                            <option value="elfo">Elfo</option>
                            <option value="enano">Enano</option>
                            <option value="mediano">Mediano</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="clase">Clase:</label>
                        <select id="clase" name="clase" class="form-control" required onchange="toggleManaBar()">
                            <option value="">Selecciona una clase</option>
                            <option value="guerrero">Guerrero</option>
                            <option value="hechicero">Hechicero</option>
                            <option value="bribon">Bribón</option>
                            <option value="clerigo">Clérigo</option>
                            <option value="paladin">Paladín</option>
                            <option value="explorador">Explorador</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nivel">Nivel:</label>
                        <input type="number" id="nivel" name="nivel" class="form-control" min="1" max="20" value="1" required>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Atributos Principales</h2>
                <div class="grid-3">
                    <div class="form-group">
                        <label for="fuerza">Fuerza:</label>
                        <input type="number" id="fuerza" name="fuerza" class="form-control" min="3" max="18" required>
                    </div>
                    <div class="form-group">
                        <label for="destreza">Destreza:</label>
                        <input type="number" id="destreza" name="destreza" class="form-control" min="3" max="18" required>
                    </div>
                    <div class="form-group">
                        <label for="constitucion">Constitución:</label>
                        <input type="number" id="constitucion" name="constitucion" class="form-control" min="3" max="18" required>
                    </div>
                    <div class="form-group">
                        <label for="inteligencia">Inteligencia:</label>
                        <input type="number" id="inteligencia" name="inteligencia" class="form-control" min="3" max="18" required>
                    </div>
                    <div class="form-group">
                        <label for="sabiduria">Sabiduría:</label>
                        <input type="number" id="sabiduria" name="sabiduria" class="form-control" min="3" max="18" required>
                    </div>
                    <div class="form-group">
                        <label for="carisma">Carisma:</label>
                        <input type="number" id="carisma" name="carisma" class="form-control" min="3" max="18" required>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Habilidades</h2>
                <div class="grid-3">
                    <div class="form-group">
                        <label for="alerta">Alerta:</label>
                        <input type="number" id="alerta" name="alerta" class="form-control" min="0" max="5" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="comunicacion">Comunicación:</label>
                        <input type="number" id="comunicacion" name="comunicacion" class="form-control" min="0" max="5" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="manipulacion">Manipulación:</label>
                        <input type="number" id="manipulacion" name="manipulacion" class="form-control" min="0" max="5" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="erudicion">Erudición:</label>
                        <input type="number" id="erudicion" name="erudicion" class="form-control" min="0" max="5" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="subterfugio">Subterfugio:</label>
                        <input type="number" id="subterfugio" name="subterfugio" class="form-control" min="0" max="5" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="supervivencia">Supervivencia:</label>
                        <input type="number" id="supervivencia" name="supervivencia" class="form-control" min="0" max="5" value="0" required>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Estadísticas de Combate</h2>
                <div class="grid-2">
                    <div class="form-group">
                        <label for="puntos_vida">Puntos de Vida:</label>
                        <input type="number" id="puntos_vida" name="puntos_vida" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="clase_armadura">Clase de Armadura:</label>
                        <input type="number" id="clase_armadura" name="clase_armadura" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="movimiento">Movimiento:</label>
                        <input type="number" id="movimiento" name="movimiento" class="form-control" min="1" required>
                    </div>
                    <div class="form-group" id="mana_container" style="display: none;">
                        <label for="mana">Mana:</label>
                        <input type="number" id="mana" name="mana" class="form-control" min="0">
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Atributos Adicionales</h2>
                <div class="grid-3">
                    <div class="form-group">
                        <label for="ataque">Ataque:</label>
                        <input type="number" id="ataque" name="ataque" class="form-control" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="instintos">Instintos:</label>
                        <input type="number" id="instintos" name="instintos" class="form-control" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="poder">Poder:</label>
                        <input type="number" id="poder" name="poder" class="form-control" min="0" required>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Inventario</h2>
                <div id="inventario-lista"></div>
                <div class="form-group">
                    <input type="text" id="nuevo-item" class="form-control" placeholder="Nuevo item">
                    <button type="button" class="btn" onclick="agregarItem()">Agregar Item</button>
                </div>
            </div>

            <div class="section">
                <h2>Trasfondo</h2>
                <div class="form-group">
                    <label for="background">Historia del personaje:</label>
                    <textarea id="background" name="background" class="form-control" rows="6"></textarea>
                </div>
            </div>

            <div class="section">
                <button type="submit" class="btn">Crear Personaje</button>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Todos los derechos reservados</p>
    </footer>

    <script>
    let inventario = [];

    function agregarItem() {
        const nuevoItem = document.getElementById('nuevo-item').value;
        if (nuevoItem) {
            inventario.push(nuevoItem);
            actualizarInventario();
            document.getElementById('nuevo-item').value = '';
        }
    }

    function eliminarItem(index) {
        inventario.splice(index, 1);
        actualizarInventario();
    }

    function actualizarInventario() {
        const lista = document.getElementById('inventario-lista');
        lista.innerHTML = '';
        inventario.forEach((item, index) => {
            const itemElement = document.createElement('div');
            itemElement.className = 'inventory-item';
            itemElement.innerHTML = `
                <span>${item}</span>
                <button type="button" class="btn" onclick="eliminarItem(${index})">Eliminar</button>
            `;
            lista.appendChild(itemElement);
        });
    }

    function toggleManaBar() {
        const clase = document.getElementById('clase').value;
        const manaContainer = document.getElementById('mana_container');
        if (clase === 'hechicero' || clase === 'clerigo' || clase === 'paladin') {
            manaContainer.style.display = 'block';
        } else {
            manaContainer.style.display = 'none';
        }
    }

    document.getElementById('character-form').addEventListener('submit', function(e) {
        e.preventDefault();
        // Aquí iría la lógica para enviar el formulario, incluyendo el inventario
        console.log('Formulario enviado', {
            nombre: document.getElementById('nombre').value,
            raza: document.getElementById('raza').value,
            clase: document.getElementById('clase').value,
            nivel: document.getElementById('nivel').value,
            // ... otros campos ...
            inventario: inventario,
            background: document.getElementById('background').value
        });
    });
    </script>
</body>
</html>


