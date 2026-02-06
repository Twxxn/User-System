<?php //este bloque de codigo es para verificar que el usuario este autenticado y que sea admin

require_once "../includes/verificar_admin.php";
require_once "../includes/conexion.php";

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id = $id";
$conexion->query($sql);

header("Location: usuarios.php");
exit();
