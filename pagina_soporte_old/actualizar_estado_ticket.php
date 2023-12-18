<?php
session_start();
$id_usuario_soporte = $_SESSION['id_usuario'];
$nombre_usuario_soporte = $_SESSION['nombre_usu'];

$numero_ticket = $_POST['numero_ticket'];
$estado_ticket = $_POST['estado_ticket'];

// Establecer la zona horaria a la de Perú (Lima)
date_default_timezone_set('America/Lima');
// Obtén la fecha y hora actuales
$fecha_actual = new DateTime();
$fecha_revision_soporte = $fecha_actual->format('Y-m-d H:i:s');

// Incluir archivo de conexión
include ('../conexion/conexion.php');

$sql_update = "UPDATE tickets
               SET estado_ticket = '$estado_ticket',
                   id_usuario_soporte = '$id_usuario_soporte',
                   nombre_usuario_soporte = '$nombre_usuario_soporte',
                   fecha_revision_soporte = '$fecha_revision_soporte'
               WHERE numero_ticket = '$numero_ticket'";

$result_update = $conn->query($sql_update);

if ($result_update) {
    header("Location: ./inicio.php");
} else {
    echo "Error al actualizar el estado: " . $conn->error;
}

$conn->close();
?>
