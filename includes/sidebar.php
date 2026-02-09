<?php
$id = $_SESSION["id"];
$img = $_SESSION["imagen"] ?? null;
?>

<div class="flex items-center gap-3 mb-6 p-3 bg-white/5 backdrop-blur-lg border border-white/10 rounded-xl">

    <div class="w-10 h-10 rounded-full bg-white/10 overflow-hidden">
        <?php if ($img): ?>
            <img src="/user_system/uploads/perfiles/<?= $img ?>" class="w-full h-full object-cover">
        <?php else: ?>
            <i data-lucide="user" class="w-6 h-6 text-gray-400 m-auto"></i>
        <?php endif; ?>
    </div>
    <div>
        <p class="text-sm font-bold text-white"><?= $_SESSION["nombre"] ?></p>
        <p class="text-xs text-gray-400"><?= $_SESSION["rol"] ?></p>
    </div>

</div>


<aside class="w-64 min-h-screen bg-white/5 backdrop-blur-xl border-r border-white/10 p-6 fixed">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-xl font-bold text-white">
            UserSystem
        </h2>

        <button id="themeToggle"
            class="flex items-center justify-center
            w-10 h-10 rounded-full
            bg-white/10 hover:bg-white/20
            text-gray-300 hover:text-white
            shadow transition
            hover:scale-105 active:scale-95">
            <i data-lucide="moon" class="w-5 h-5"></i>
        </button>
    </div>
    <a href="/user_system/perfil.php" class="sidebar-link">
        <i data-lucide="user-circle" class="w-5 h-5"></i>
        <span>Perfil</span>
    </a>

    <nav class="space-y-4">
        <a href="/user_system/dashboard.php" class="sidebar-link">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span>Dashboard</span>
        </a>

        <?php if ($_SESSION["rol"] === "admin"): ?>
            <a href="/user_system/admin/usuarios.php" class="sidebar-link">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span>Usuarios</span>
            </a>
        <?php endif; ?>

        <form action="/user_system/logout.php" method="POST">
            <button type="submit" class="sidebar-link text-red-400 hover:text-red-300">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>


    </nav>
</aside>