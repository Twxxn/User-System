<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "admin") {
    header("Location: ../dashboard.php");
    exit();
}

require_once "../includes/conexion.php";

$id = $_GET["id"] ?? null;

// Seguridad
if (!$id || $id == $_SESSION["id"]) {
    header("Location: usuarios.php");
    exit();
}

// Obtener rol actual
$result = $conexion->query("SELECT rol FROM usuarios WHERE id = $id");

if ($result->num_rows !== 1) {
    header("Location: usuarios.php");
    exit();
}

$usuario = $result->fetch_assoc();
$rolActual = $usuario["rol"];

// Alternar rol
$nuevoRol = ($rolActual === "admin") ? "usuario" : "admin";

// Actualizar
$conexion->query("UPDATE usuarios SET rol = '$nuevoRol' WHERE id = $id");

header("Location: usuarios.php");
exit();
