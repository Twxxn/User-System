<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "includes/conexion.php";

$token = $_GET['token'] ?? null;

if (!$token) {
    die("Token no válido 🚫");
}

// Buscar token en la base de datos
$sql = "SELECT * FROM password_resets 
        WHERE token = '$token' 
        AND expira_en > NOW()";
$result = $conexion->query($sql);

if ($result->num_rows !== 1) {
    die("Token inválido o expirado ⏰");
}

$reset = $result->fetch_assoc();
$usuario_id = $reset['id'];

// Si el usuario envía la nueva contraseña
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nueva_password = $_POST['password'];
    $password_hash = password_hash($nueva_password, PASSWORD_DEFAULT);

    // Actualizar contraseña
    $conexion->query(
        "UPDATE usuarios 
         SET password = '$password_hash' 
         WHERE id = $usuario_id"
    );

    // Eliminar token usado
    $conexion->query(
        "DELETE FROM password_resets 
         WHERE id = $usuario_id"
    );

    echo "<h2>Contraseña actualizada correctamente ✅</h2>";
    echo "<a href='login.php'>Iniciar sesión</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>
</head>
<body>

<h2>Nueva contraseña</h2>

<form method="POST">
    <input type="password" name="password" placeholder="Nueva contraseña" required>
    <br><br>
    <button type="submit">Guardar contraseña</button>
</form>

</body>
</html>
