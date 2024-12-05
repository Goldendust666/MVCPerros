<?php
// alta.php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $raza = $_POST['raza'];
    $color = $_POST['color'];
    $peso = $_POST['peso'];
    $sexo = $_POST['sexo'];

    // Actualiza el coche en la base de datos y actualiza los atributos en el controlador
    $controller = new PerroController();
    $controller->actualizar($id);

} else {
?>
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

        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 15px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input[type="text"], input[type="hidden"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            padding: 8px;
            border: none;
            cursor: pointer;
            border-radius: var(--border-radius);
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['perro']['id']; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $_GET['perro']['nombre']; ?>" required><br><br>

    <label for="raza">Raza:</label>
    <input type="text" id="raza" name="raza" value="<?php echo $_GET['perro']['raza']; ?>" required><br><br>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" value="<?php echo $_GET['perro']['color']; ?>" required><br><br>

    <label for="peso">Peso:</label>
    <input type="number" id="peso" name="peso" value="<?php echo $_GET['perro']['peso']; ?>" required><br><br>
    <label for="sexo">Sexo:</label>
    <input type="tel" id="sexo" name="sexo" pattern="[MH]" value="<?php echo $_GET['perro']['sexo']; ?>" required><br><br>
<script>document.getElementById('sexo').addEventListener('input', function(e) {
    this.value = this.value.toUpperCase().replace(/[^MH]/g, '');
});
</script>
    <input type="submit" value="Actualizar">
</form>
<?php
}
?>
