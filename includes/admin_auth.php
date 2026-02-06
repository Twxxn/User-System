<?php //proteccion por roles
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar login
if (!isset($_SESSION["id"])) {
    header("Location: ../login.php");
    exit();
}

// Verificar rol admin
if ($_SESSION["rol"] !== "admin") {
    header("Location: ../dashboard.php");
    exit();
}
