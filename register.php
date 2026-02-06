<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registros</title>
    </head>
    <body>
        <h1>Registro de usuario</h1>
        <form action="register.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required> <br><br>
            <button type="submit">Registrarse</button>
        </form>

        <?php
        require_once "includes/conexion.php"; //aqui hacemos la conexion a la base de datos

            if($_SERVER["REQUEST_METHOD"] == "POST"){

                $nombre = $_POST["nombre"];
                $correo = $_POST["correo"];
                $password = $_POST["password"];
                
            // Hashear la contraseña
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Insertar el usuario en la base de datos
            $sql = "INSERT INTO usuarios (nombre, correo, password, rol) 
            VALUES ('$nombre', '$correo', '$password', 'usuario')";

            if($conexion->query($sql)){
                echo "Usuario registrado correctamente 🎉";
            }else{
                echo "Error al registrar el usuario 🚫";
            }

            $conexion->close();
        }
        ?>
    </body>
</html>