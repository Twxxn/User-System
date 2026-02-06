<?php //este bloque de codigo es para verificar que el usuario este autenticado
session_start();

//verificar si el usuario esta autenticado -- si no existe redirigir a login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Validar rol
function require_role($rol_requerido) {
    if ($_SESSION['rol'] !== $rol_requerido) {
        header("Location: dashboard.php");
        exit();
    }
}
