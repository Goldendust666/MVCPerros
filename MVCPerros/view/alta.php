<?php
// alta.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $raza = filter_input(INPUT_POST, 'raza', FILTER_SANITIZE_STRING);
    $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
    $peso = filter_input(INPUT_POST, 'peso', FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);

    if (!empty($nombre) && !empty($raza) && !empty($color) && !empty($peso) && !empty($sexo)) {
        $perro = new Perro(-1, $nombre, $raza, $color, $peso, $sexo);
        
        // Instancia del controlador y llama al método alta
        $controller = new PerroController();
        $controller->alta($perro);
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de coche</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #e74c3c;
            --background-color: #f4f4f4;
            --text-color: #333;
            --border-radius: 10px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            background-color: var(--primary-color);
            color: white;
            padding: 8px;
            border: none;
            cursor: pointer;
            border-radius: var(--border-radius);
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
    <p>Los datos han sido registrados correctamente.</p>
<?php else: ?>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="raza">Raza:</label>
        <input type="text" id="raza" name="raza" required><br><br>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" required><br><br>

        <label for="peso">Peso:</label>
        <input type="number" id="peso" name="peso" required><br><br>

        <label for="sexo">Propietario(H o M por favor):</label>
        <input type="tel" id="sexo" name="sexo" pattern="[MH]" required>
        <script>
document.getElementById('sexo').addEventListener('input', function(e) {
    this.value = this.value.toUpperCase().replace(/[^MH]/g, '');
});

        </script>
        <button type="submit">Dar de alta</button>
    </form>
<?php endif; ?>
</body>
</html>
