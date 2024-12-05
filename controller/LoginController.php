<?php
// Archivo: controllers/LoginController.php

class LoginController
{
    public static function mostrarVistaLogin()
    {
        require_once 'view/login.php';
    }

    public function verificarLogin($nombre, $contraseña)
    {
        // Aquí se implementaría la lógica de verificación de credenciales
        // En este caso, estamos usando un usuario de prueba
        if ($nombre == 'admin' && $contraseña == 'password') {
            return true;
        }
        return false;
    }

    public function loginExitoso()
    {
        // Establecer la duración de la sesión a un mes
        ini_set('session.gc_maxlifetime', 2592000); // 30 días en segundos
        
        // Guardar los datos del usuario logueado
        $_SESSION['usuario'] = 'admin';  
        $_SESSION['nombre'] = 'Administrador';
        $_SESSION['email'] = 'admin@example.com';
        
        // Establecer una cookie de sesión con duración de un mes
        setcookie(session_name(), session_id(), time() + 2592000, '/', '', false, true);
        $controller = new PerroController();
        $controller->index();
    }

    public function mostrarMensajeError($mensaje)
    {
        return $mensaje;
    }
}

