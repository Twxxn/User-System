<?php
require_once "includes/auth.php";
require_once "includes/conexion.php";

$id = $_SESSION["id"];

$sql = "SELECT nombre, correo, rol, imagen FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100">

<?php include "includes/sidebar.php"; ?>

<main class="ml-64 p-10">

    <h1 class="text-3xl font-bold mb-8">Mi perfil</h1>

    <div class="max-w-3xl bg-gray-800 rounded-2xl p-8 shadow-xl">

        <div class="flex items-center gap-6">

            <!-- Imagen -->
            <div class="w-28 h-28 rounded-full bg-gray-700 flex items-center justify-center overflow-hidden">
                <?php if (!empty($usuario["imagen"])): ?>
                    <img src="uploads/perfiles/<?= htmlspecialchars($usuario["imagen"]) ?>"
                        class="w-full h-full object-cover">
                <?php else: ?>
                    <i data-lucide="user" class="w-12 h-12 text-gray-400"></i>
                <?php endif; ?>
            </div>

            <!-- Datos -->
            <div>
                <h2 class="text-2xl font-bold"><?= htmlspecialchars($usuario["nombre"]) ?></h2>
                <p class="text-gray-400"><?= htmlspecialchars($usuario["correo"]) ?></p>

                <span class="inline-block mt-2 px-3 py-1 rounded-full text-sm
                    <?= $usuario["rol"] === "admin" ? "bg-indigo-600" : "bg-gray-600" ?>">
                    <?= ucfirst($usuario["rol"]) ?>
                </span>
            </div>
        </div>

        <!-- Acciones -->
        <div class="mt-8 flex gap-4">
            <button
                onclick="openModal()"
                class="px-4 py-2 bg-indigo-600 rounded-lg hover:bg-indigo-700">
                Cambiar imagen
            </button>

            <button class="px-4 py-2 bg-gray-700 rounded-lg hover:bg-gray-600">
                Editar datos
            </button>
        </div>

    </div>
    
    <!-- Modal para subir foto -->
    <div id="modalFoto"
        class="fixed inset-0 bg-black/60 hidden items-center justify-center">

    <div class="bg-gray-900 p-6 rounded-xl w-96">
        <h3 class="text-lg font-bold mb-4">Actualizar foto</h3>

        <form action="includes/subir_foto.php" method="POST" enctype="multipart/form-data">
            <input type="file" 
                    name="imagen" 
                    accept="image/*" 
                    required 
                    onchange="previewImagen(event)"
                    class="mb-4 block w-full text-sm">

            <img id="preview" class="w-32 h-32 rounded-full hidden mx-auto object-cover border border-gray-600">


            <div class="flex justify-end gap-2">
                <button type="button"
                        onclick="closeModal()"
                        class="px-4 py-2 bg-gray-700 rounded">
                    Cancelar
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 rounded">
                    Guardar
                </button>
            </div>
        </form>
    </div>
    
</div>
<script>
function previewImagen(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const img = document.getElementById("preview");
        img.src = reader.result;
        img.classList.remove("hidden");
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>


</main>
<script>
function openModal() {
    document.getElementById("modalFoto").classList.remove("hidden");
    document.getElementById("modalFoto").classList.add("flex");
}

function closeModal() {
    document.getElementById("modalFoto").classList.add("hidden");
}
</script>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
lucide.createIcons();
</script>

</body>
</html>
