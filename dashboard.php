<?php
require_once "includes/auth.php";

// Verificar autenticación
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
    
<head>
    <?php include "includes/head.php"; ?>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
        extend: {
            colors: { primary: '#6366f1',
            }
        }
        }
    }
    </script>


</head>

<body class="bg-gray-900 text-gray-100 transition-colors duration-300"> <!-- modo oscuro -->

<?php include "includes/sidebar.php"; ?>

<main class="ml-64 p-8">

    <h1 class="text-3xl font-bold mb-2">
        Bienvenido(a), <?= $_SESSION["nombre"] ?> 👋
    </h1>
    <p class="text-gray-400 mb-8">
        Rol: <?= $_SESSION["rol"] ?>
    </p>

    <!-- Cards principales -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="dashboard-card bg-gray-800 p-6 rounded-xl shadow hover:scale-[1.03] transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center gap-3">
                <i data-lucide="users" class="w-6 h-6 text-primary"></i>
                <h3 class="text-lg font-semibold">Usuarios</h3>
            </div>

            <p class="text-2xl mt-2">2</p>
        </div>

        <div class="dashboard-card bg-gray-800 p-6 rounded-xl shadow hover:scale-[1.03] transition-all duration-300 hover:shadow-xl"> 
            <div class="flex items-center gap-3">
                <i data-lucide="activity" class="w-6 h-6 text-primary"></i>
                <h3 class="text-lg font-semibold">Sesión</h3>
            </div>

            <p class="text-2xl mt-2 text-green-400">Activa</p>
        </div>

        <div class="dashboard-card bg-gray-800 p-6 rounded-xl shadow hover:scale-[1.03] transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center gap-3">
                <i data-lucide="shield-check" class="w-6 h-6 text-primary"></i>
                <h3 class="text-lg font-semibold">Seguridad</h3>
            </div>
            <p class="text-2xl mt-2 text-green-400">OK</p>
        </div>
    </div>

    <!-- Panel según rol -->
    <?php if ($_SESSION["rol"] === "admin"): ?>
        <div class="dashboard-card bg-gray-800 p-6 rounded-xl">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                <i data-lucide="settings" class="w-6 h-6 text-primary"></i>
                Panel de administrador
            </h2>
            <ul class="space-y-2">
                <li>
                    <a href="admin/usuarios.php" class="text-primary hover:underline">
                        Gestionar usuarios
                    </a>
                </li>
            </ul>
        </div>
    <?php else: ?>
        <div class="dashboard-card bg-gray-800 p-6 rounded-xl">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                <i data-lucide="users" class="w-6 h-6 text-primary"></i>
                Panel de usuario
            </h2>
            <p class="text-gray-400">
                No cuentas con permisos de administrador 🔒
            </p>
        </div>
    <?php endif; ?>

</main>


<!-- Iconos -->
<script src="https://unpkg.com/lucide@latest"></script>

<!-- Tema -->
<script src="assets/js/theme.js"></script>


<!-- Animaciones -->
<script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
<script src="assets/js/animations.js"></script>

<script>
lucide.createIcons();
</script>


</body>
</html>
