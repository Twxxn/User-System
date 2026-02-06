<?php
require_once "auth.php";
require_once "conexion.php";

if (!isset($_FILES["imagen"])) {
    die("No se recibió ninguna imagen");
}

$id = $_SESSION["id"];

// Datos del archivo
$nombreOriginal = $_FILES["imagen"]["name"];
$tmp = $_FILES["imagen"]["tmp_name"];
$error = $_FILES["imagen"]["error"];

// Validar error
if ($error !== UPLOAD_ERR_OK) {
    die("Error al subir la imagen");
}

// Extensión
$extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
$extension = strtolower($extension);

// Validar extensión
$permitidas = ["jpg", "jpeg", "png", "webp"];
if (!in_array($extension, $permitidas)) {
    die("Formato de imagen no permitido");
}

// Nuevo nombre único
$nuevoNombre = "user_" . $id . "_" . time() . "." . $extension;

// Ruta destino (OJO con ../ porque estamos en includes)
$rutaDestino = "../uploads/perfiles/" . $nuevoNombre;

// Crear carpeta si no existe
if (!is_dir("../uploads/perfiles")) {
    mkdir("../uploads/perfiles", 0777, true);
}

// Mover archivo
if (!move_uploaded_file($tmp, $rutaDestino)) {
    die("No se pudo guardar la imagen");
}

// Guardar en BD
$sql = "UPDATE usuarios SET imagen = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("si", $nuevoNombre, $id);
$stmt->execute();

// Volver al perfil
header("Location: ../perfil.php");
exit;
