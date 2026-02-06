<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Iniciar sesion</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
    tailwind.config = {
        darkMode: 'class',
        theme: { extend: {
            colors: { primary: '#6366f1',
            }
        }
        }
    }
    </script>
    </head>


<body class="dark bg-gray-900 min-h-screen flex items-center justify-center text-gray-100">

<div id="loginCard" class="bg-gray-800 p-8 rounded-2xl shadow-xl w-full max-w-md">

    <div class="text-center mb-6">
        <i data-lucide="lock" class="w-10 h-10 mx-auto text-primary mb-3"></i>
        <h1 class="text-2xl font-bold">Bienvenido</h1>
        <p class="text-gray-400 text-sm">Inicia sesión para continuar</p>
    </div>

    <form method="POST" class="space-y-4">

        <div>
            <label class="text-sm text-gray-400">Correo</label>
            <div class="flex items-center bg-gray-700 rounded-lg px-3">
                <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                <input type="email" name="correo" required class="bg-transparent w-full p-2 focus:outline-none text-gray-100">
            </div>
        </div>

        <div>
            <label class="text-sm text-gray-400">Contraseña</label>
            <div class="flex items-center bg-gray-700 rounded-lg px-3">
                <i data-lucide="key" class="w-5 h-5 text-gray-400"></i>
                <input type="password" name="password" required class="bg-transparent w-full p-2 focus:outline-none text-gray-100">
            </div>
        </div>

        <button type="submit" class="w-full bg-primary hover:bg-indigo-500 transition p-3 rounded-lg font-semibold">
            Iniciar sesión
        </button>

        <div class="text-center text-sm mt-4">
            <a href="forgot_password.php" class="text-primary hover:underline">
                ¿Olvidaste tu contraseña?
            </a>
        </div>

    </form>
</div>

<!-- Lucide -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>

<!-- GSAP -->
<script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
<script src="assets/js/login-animations.js"></script>

</body>
</html>

    <?php
    require_once "includes/conexion.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $correo = $_POST["correo"];
        $password = $_POST["password"];

        //Buscar usuario por correo. No sql injection -------------------------
        $stmt = $conexion->prepare(
            "SELECT id, nombre, password, rol FROM usuarios WHERE correo = ?");

        $stmt->bind_param("s", $correo); // s = string
        $stmt->execute();
        $result = $stmt->get_result();

        //validamos la contraseña
        if($result->num_rows == 1){

            $usuario = $result->fetch_assoc();

            if(password_verify($password, $usuario["password"])){

                session_start();
                session_regenerate_id(true); //regenera el id de la sesion
                $_SESSION["id"] = $usuario["id"];
                $_SESSION["nombre"] = $usuario["nombre"];
                $_SESSION["rol"] = $usuario["rol"];

                header("Location: dashboard.php");
    exit();
                
            }else{
                echo "Credenciales incorrectas 🚫";
            }
        }else{
            echo "Usuario no encontrado 🚫";
        }
    }
    ?>
