<?php
// Archivo: views/login.php
session_start();
require_once 'controller/LoginController.php';

$loginController = new LoginController();

if (isset($_POST['nombre']) && isset($_POST['contraseña'])) {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];
    
    $esValido = $loginController->verificarLogin($nombre, $contraseña);
    
    if ($esValido) {
        $loginController->loginExitoso();
        header(' ./index.php');
        exit;
    } else {
        $loginController->mostrarMensajeError("Nombre de usuario o contraseña incorrectos");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { max-width: 300px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; }
        label { display: block; margin-bottom: 10px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; margin-bottom: 15px; }
        button { background-color: #4CAF50; color: white; padding: 10px; border: none; cursor: pointer; }
        button:hover { opacity: 0.8; }
    </style>
</head>
<body>
    <?php if (isset($mensajeError)) : ?>
        <div style="color: red;"><?= $mensajeError ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>

        <button type="submit">Iniciar sesión</button>
    </form>
</body>
