<?php
//var_dump($_POST);  // Mostrar los datos POST para depuración
$usuario = $_POST['username'];
$tipo = $_POST['tipo'];
$id_area = $_POST['id_area'];
$contra = $_POST['password'];

// Hash de la contraseña con SHA-256
$contrasena_hash = hash('sha256', $contra);

// Establecer la zona horaria a la de Perú (Lima)
date_default_timezone_set('America/Lima');
// Obtén la fecha 
$fecha_actual = new DateTime();
$fecha_y_hora = $fecha_actual->format('Y-m-d');

// Incluir archivo de conexión
include ('../conexion/conexion.php');
$sql = "INSERT INTO `usuarios` (`nombre_usuario`, `password`, `id_area`, `tipo`, `fecha_registro`)
VALUES('$usuario', '$contrasena_hash', '$id_area', '$tipo', '$fecha_y_hora')";

$result = $conn->query($sql);

if ($result){
    header("Location: ../pagina_super/usuario.php");
} else {
    echo "Error al insertar los datos: " . $conn->error;
}

$conn->close();
?>
