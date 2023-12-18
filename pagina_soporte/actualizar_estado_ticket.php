<?php
session_start();
$id_usuario_soporte = $_SESSION['id_usuario'];
$nombre_usuario_soporte = $_SESSION['nombre_usu'];

$numero_ticket = $_POST['numero_ticket'];
$estado_ticket = $_POST['estado_ticket'];

$pagina = isset($_GET['page']) ? $_GET['page'] : ''; // Verifica si 'page' está configurado en el método GET

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
    // Redireccionar según el valor de 'page'
    if ($pagina == 1) {
        header("Location: ./ticket_todos.php");
    } elseif ($pagina == 2) {
        header("Location: ./ticket_soporte.php");
    } elseif ($pagina == 3) {
        header("Location: ./ticket_toner.php");
    } else {
        // Página por defecto si 'page' no es 1, 2, ni 3
        header("Location: ./inicio.php");
    }
} else {
    echo "Error al actualizar el estado: " . $conn->error;
}

$conn->close();
?>
