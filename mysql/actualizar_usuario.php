<?php
// Obtener datos del formulario
$id_usuario = $_POST['id_usuario'];
$usuario = $_POST['username'];
$tipo = $_POST['tipo'];
$id_area = $_POST['id_area'];
$contra = $_POST['password'];

// Función para verificar si una cadena es un hash SHA-256 válido
function esSHA256($cadena) {
    return (bool) preg_match('/^[a-f0-9]{64}$/i', $cadena);
}

// Verificar si la contraseña ya está hasheada
if (esSHA256($contra)) {
    // La contraseña ya está hasheada, no es necesario hacer nada
    $contrasena_hash = $contra;
} else {
    // La contraseña no está hasheada, hashearla con SHA-256
    $contrasena_hash = hash('sha256', $contra);
}

// Establecer la zona horaria a la de Perú (Lima)
date_default_timezone_set('America/Lima');
// Obtén la fecha 
$fecha_actual = new DateTime();
$fecha_y_hora = $fecha_actual->format('Y-m-d');

// Incluir archivo de conexión
include ('../conexion/conexion.php');

    // Es una actualización
    $sql = "UPDATE `usuarios` SET
            `nombre_usuario` = '$usuario',
            `password` = '$contrasena_hash',
            `id_area` = '$id_area',
            `tipo` = '$tipo',
            `fecha_registro` = '$fecha_y_hora'
            WHERE `id_usuario` = $id_usuario";


$result = $conn->query($sql);

if ($result) {
    header("Location: ../pagina_super/usuario.php");
} else {
    echo "Error al insertar o actualizar los datos: " . $conn->error;
}

$conn->close();
?>
