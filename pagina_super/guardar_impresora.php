<?php
session_start();

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];

// Establecer la zona horaria a la de Perú (Lima)
date_default_timezone_set('America/Lima');
// Obtén la fecha actual
$fecha_actual = new DateTime();

// Formatear la fecha en el formato adecuado para un campo de tipo DATE
$fecha_formateada = $fecha_actual->format('Y-m-d');

// Incluir archivo de conexión
include('../conexion/conexion.php');

$sql = "INSERT INTO `impresora` (`marca`, `modelo`, `fecha_registro`) VALUES ('$marca',$modelo', '$fecha_formateada')";

$result = $conn->query($sql);

if ($result) {
    header("Location: ./impresora.php");
} else {
    echo "Error al insertar los datos: " . $conn->error;
}

$conn->close();
?>
