<?php
require_once "../includes/verificar_admin.php";
require_once "includes/auth.php";
require_role("admin");
?>

<?php
$id = $_SESSION["id"];
$img = $_SESSION["imagen"] ?? null;
?>

<h1>Panel de Administrador</h1>
<p>Solo admins pueden ver esto 👑</p>
