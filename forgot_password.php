<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "includes/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = $_POST["correo"];

    // Buscar usuario
    $sql = "SELECT id FROM usuarios WHERE correo = '$correo'";
    $result = $conexion->query($sql);

    if ($result->num_rows === 1) {

        $usuario = $result->fetch_assoc();
        $id = $usuario['id'];

        // Generar token
        $token = bin2hex(random_bytes(32));
        $expira_en = date("Y-m-d H:i:s", strtotime("+1 hour"));

       // Eliminar tokens anteriores del usuario
        $conexion->query("DELETE FROM password_resets WHERE id = $id");

        // Guardar nuevo token
        $sql = "INSERT INTO password_resets (id, token, expira_en)
        VALUES ($id, '$token', '$expira_en')";
        $conexion->query($sql);


        $enlace = "http://localhost/user_system/reset_password.php?token=$token";

        echo "<h3>Enlace para recuperar contraseña:</h3>";
        echo "<a href='$enlace'>$enlace</a>";

        exit();
    } else {
        $error = "Usuario no encontrado 🚫";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
</head>
<body>

<h2>Recuperar contraseña</h2>

<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">
    <input type="email" name="correo" placeholder="Correo registrado" required>
    <br><br>
    <button type="submit">Enviar enlace</button>
</form>

</body>
</html>
