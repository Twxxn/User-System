<?php

// 1. Verificación de seguridad: comprueba que el usuario sea administrador
require_once "../includes/admin_auth.php";
// 2. Conexión a la base de datos
require_once "../includes/conexion.php";

// 3. Obtener parámetros de la URL (GET) para filtrado y ordenamiento
// "null coalescing operator" (??) asigna un valor por defecto si no existen
$buscar = $_GET["buscar"] ?? "";
$orden = $_GET["orden"] ?? "id_desc";

// 4. Lógica de búsqueda
$where = "";
if (!empty($buscar)) {
    // Escapar caracteres especiales para evitar inyecciones SQL
    $buscar = $conexion->real_escape_string($buscar);
    // Filtrar por nombre O correo coincide parcialmente (LIKE %...%)
    $where = "WHERE nombre LIKE '%$buscar%' OR correo LIKE '%$buscar%'";
}

// 5. Definir la cláusula ORDER BY según la opción seleccionada
switch ($orden) {
    case "nombre_asc":
        $orderBy = "ORDER BY nombre ASC";  // A-Z
        break;
    case "nombre_desc":
        $orderBy = "ORDER BY nombre DESC"; // Z-A
        break;
    case "id_asc":
        $orderBy = "ORDER BY id ASC";      // Más antiguos primero
        break;
    default:
        $orderBy = "ORDER BY id DESC";     // Más recientes primero (default)
}



// 6. Ejecución de la consulta final concatenando filtros y orden
$sql = "SELECT id, nombre, correo, rol FROM usuarios $where $orderBy";
$resultado = $conexion->query($sql);
$totalUsuarios = $conexion->query("SELECT COUNT(*) as total FROM usuarios")->fetch_assoc()["total"]; // Contar usuarios

?>


<!DOCTYPE html>
<html lang="es">

<head>



    <meta charset="UTF-8">
    <title>Lista de usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="dark bg-gray-900 text-gray-100">
    <?php include "../includes/sidebar.php"; ?>

    <main class="ml-64 p-8">
        <h1 class="text-3xl font-bold mb-6">Gestión de usuarios</h1>


        <div class="bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                <i data-lucide="users" class="w-6 h-6 text-primary"></i>
                Gestión de usuarios
                <span class="text-sm bg-gray-700 text-gray-300 px-2 py-1 rounded-full"><?= $totalUsuarios ?></span>
            </h2>


            <div class="overflow-x-auto">
                <form method="GET" class="flex flex-col md:flex-row gap-4 mb-6">

                    <!-- Buscar -->
                    <div class="flex-1">
                        <input
                            type="text"
                            name="buscar"
                            value="<?= htmlspecialchars($buscar) ?>"
                            placeholder="Buscar por nombre o correo..."
                            class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white
            focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Ordenar -->
                    <div>
                        <select
                            name="orden"
                            class="px-4 py-2 rounded-lg bg-gray-700 text-white
            focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="id_desc" <?= $orden == "id_desc" ? "selected" : "" ?>>
                                Más recientes
                            </option>
                            <option value="id_asc" <?= $orden == "id_asc" ? "selected" : "" ?>>
                                Más antiguos
                            </option>
                            <option value="nombre_asc" <?= $orden == "nombre_asc" ? "selected" : "" ?>>
                                Nombre A–Z
                            </option>
                            <option value="nombre_desc" <?= $orden == "nombre_desc" ? "selected" : "" ?>>
                                Nombre Z–A
                            </option>
                        </select>
                    </div>

                    <!-- Botón -->
                    <button
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700
        transition text-white font-medium">
                        Buscar
                    </button>


                </form>


                <table class="w-full text-sm text-left">
                    <thead class="text-gray-400 border-b border-gray-700">
                        <tr>
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Nombre</th>
                            <th class="py-3 px-4">Correo</th>
                            <th class="py-3 px-4">Rol</th>
                            <th class="py-3 px-4 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-700">
                        <!-- 7. Bucle para recorrer y mostrar cada usuario encontrado -->
                        <?php while ($usuario = $resultado->fetch_assoc()): ?>

                            <tr class="hover:bg-gray-700/40 transition">
                                <td class="py-3 px-4"><?= $usuario["id"] ?></td>
                                <td class="py-3 px-4 font-medium"><?= $usuario["nombre"] ?></td>
                                <td class="py-3 px-4 text-gray-400"><?= $usuario["correo"] ?></td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 rounded text-xs
                        <?= $usuario["rol"] === "admin"
                                ? "bg-purple-500/20 text-purple-400"
                                : "bg-blue-500/20 text-blue-400" ?>">
                                        <?= ucfirst($usuario["rol"]) ?>
                                    </span>
                                </td>

                                <td class="py-3 px-4 text-center space-x-2">
                                    <!-- 8. Botones de acción -->
                                    <!-- Bloqueamos acciones sobre el mismo usuario logueado para que no se auto-elimine -->
                                    <?php if ($usuario["id"] != $_SESSION["id"]): ?>

                                        <a href="cambiar_rol.php?id=<?= $usuario['id'] ?>"
                                            class="inline-flex items-center justify-center p-2 rounded-lg
                        bg-indigo-500/20 text-indigo-400 hover:bg-indigo-500/30 transition">
                                            <i data-lucide="repeat" class="w-4 h-4"></i>
                                        </a>

                                        <a href="eliminar.php?id=<?= $usuario['id'] ?>"
                                            onclick="return confirm('¿Eliminar este usuario?')"
                                            class="inline-flex items-center justify-center p-2 rounded-lg
                        bg-red-500/20 text-red-400 hover:bg-red-500/30 transition">
                                            <i data-lucide="trash" class="w-4 h-4"></i>
                                        </a>

                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Iconos -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tema -->
    <script src="../assets/js/theme.js"></script>


    <!-- Animaciones -->
    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
    <script src="../assets/js/animations.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>