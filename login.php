<?php
require_once "includes/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $stmt = $conexion->prepare(
        "SELECT id, nombre, password, rol, imagen FROM usuarios WHERE correo = ?"
    );
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();

        if (password_verify($password, $usuario["password"])) {
            session_start();
            session_regenerate_id(true);

            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["rol"] = $usuario["rol"];
            $_SESSION["imagen"] = $usuario["imagen"];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-indigo-900 via-purple-900 to-black flex items-center justify-center min-h-screen">
    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2">

        <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>

        <!-- PANEL IZQUIERDO -->
        <div class="hidden md:flex flex-col justify-between p-10 bg-gradient-to-br from-indigo-600 to-purple-700 text-white">

            <div>
                <h1 class="text-4xl font-bold mt-4">Inicia sesión</h1>
                <p class="mt-4 text-white/80">
                    Accede a tu dashboard y gestiona tu sistema.
                </p>
            </div>

            <div class="bg-white/10 p-4 rounded-xl backdrop-blur">
                <p class="text-sm italic">
                    "Sistemas de gestión de usuarios"
                </p>
                <div class="flex items-center mt-3 gap-3">
                    <img src="assets/logo.png" 
                    class="w-14 h-14 rounded-full bg-white p-2 shadow-2xl">

                    <div>
                        <p class="font-semibold">Antonio Mendoza</p>
                        <p class="text-xs opacity-70">Desarrollador</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- PANEL DERECHO FORM -->
        <div class="p-10 bg-gray-800 text-gray-100">

            <h2 class="text-2xl font-bold">Bienvenido 👋</h2>
            <?php if (isset($error)): ?>
                <div class="bg-red-500/20 text-red-400 p-3 rounded-lg mt-4 text-sm">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="mt-6 space-y-4">

                <div>
                    <label class="text-sm">Correo</label>
                    <input type="email" name="correo" required
                        class="w-full p-3 bg-white/10 backdrop-blur border border-white/20 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                </div>

                <div>
                    <label class="text-sm">Contraseña</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full p-3 pr-10 bg-white/10 backdrop-blur border border-white/20 rounded-lg focus:ring-2 focus:ring-primary outline-none text-white">
                        <span onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-white text-lg">
                            👁️
                        </span>
                    </div>
                </div>

                <div class="flex justify-between text-sm text-gray-400">
                    <a href="forgot_password.php" class="hover:text-primary">¿Olvidaste tu contraseña?</a>
                </div>

                <button class="w-full mt-4 bg-primary hover:bg-indigo-500 transition p-3 rounded-lg font-bold">
                    Iniciar sesión
                </button>

                <p class="text-gray-400 text-sm mt-1">
                    ¿No tienes cuenta? <a href="register.php" class="text-primary">Regístrate</a>
                </p>

            </form>

        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = event.target; // Obtener el elemento clickeado

            if (input.type === "password") {
                input.type = "text";
                icon.textContent = "🙈";
            } else {
                input.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>
    <script>
        // Animación del contenedor glass
        gsap.from(".bg-white\\/10", {
            opacity: 0,
            y: 50,
            duration: 1,
            ease: "power3.out"
        });

        // Animación de inputs y botones
        gsap.from("h2, form > div, .animated-btn", {

            opacity: 0,
            y: 20,
            duration: 0.6,
            stagger: 0.1,
            delay: 0.3
        });
    </script>


</body>

</html>