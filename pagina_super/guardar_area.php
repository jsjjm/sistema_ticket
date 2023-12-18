<?php
session_start();

$area = $_POST['area'];

// Establecer la zona horaria a la de Perú (Lima)
date_default_timezone_set('America/Lima');
// Obtén la fecha actual
$fecha_actual = new DateTime();

// Formatear la fecha en el formato adecuado para un campo de tipo DATE
$fecha_formateada = $fecha_actual->format('Y-m-d');

// Incluir archivo de conexión
include('../conexion/conexion.php');

$sql = "INSERT INTO `area` (`descripcion`, `fecha_registro`) VALUES ('$area', '$fecha_formateada')";

$result = $conn->query($sql);

if ($result) {
    header("Location: ./area.php");
} else {
    echo "Error al insertar los datos: " . $conn->error;
}

$conn->close();
?>
