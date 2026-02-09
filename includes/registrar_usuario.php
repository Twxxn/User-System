<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar si correo ya existe
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("El correo ya está registrado");
    }

    // Hashear contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Procesar imagen si existe
    $nuevoNombre = null;

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
        $nombreOriginal = $_FILES["imagen"]["name"];
        $tmp = $_FILES["imagen"]["tmp_name"];
        $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

        $permitidas = ["jpg", "jpeg", "png", "webp"];
        
        if (in_array($extension, $permitidas)) {
            // Generar nombre único (sin ID de usuario porque aún no existe)
            $nuevoNombre = "user_" . uniqid() . "." . $extension;
            
            // Ruta destino
            $rutaDestino = "../uploads/perfiles/" . $nuevoNombre;

            // Crear carpeta si no existe
            if (!is_dir("../uploads/perfiles")) {
                mkdir("../uploads/perfiles", 0777, true);
            }

            // Mover archivo
            if (!move_uploaded_file($tmp, $rutaDestino)) {
                $nuevoNombre = null; // Si falla, guardamos null
            }
        }
    }

    // Insertar usuario
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, password, rol, imagen) VALUES (?, ?, ?, 'usuario', ?)");
    $stmt->bind_param("ssss", $nombre, $correo, $passwordHash, $nuevoNombre);

    if ($stmt->execute()) {
        header("Location: ../login.php");
        exit;
    } else {
        echo "Error al registrar";
    }
}
