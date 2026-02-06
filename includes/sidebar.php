
<aside class="w-64 min-h-screen bg-gray-800 p-6 fixed">
    <div class="flex items-center justify-between mb-8">
    <h2 class="text-xl font-bold text-primary">
        UserSystem
    </h2>

    <button id="themeToggle"
        class="flex items-center justify-center
            w-10 h-10 rounded-full
            bg-gray-700 hover:bg-gray-600
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
