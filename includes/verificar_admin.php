<?php //proteccion por roles

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['rol'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}


$tiempo_inactivo = 900; // 15 minutos
if (isset($_SESSION['ultimo_acceso']) &&
    (time() - $_SESSION['ultimo_acceso']) > $tiempo_inactivo) {

    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$_SESSION['ultimo_acceso'] = time();