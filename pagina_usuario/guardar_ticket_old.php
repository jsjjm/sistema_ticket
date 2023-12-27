<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usu'];
$tipo = $_POST['tipo'];
$solicitante = $_POST['solicitante'];
$detalle = $_POST['detalle'];

//$id_marca_imp = $_POST['id_marca_imp'];
$id_impresora = $_POST['id_impresora'] ?? 0;


// Genera un número aleatorio de 10000 a 99999
$numero_aleatorio = rand(10000, 99999);
// Concatena "tk" al principio del número aleatorio
$numero_ticket = 'tk' . $numero_aleatorio;

// Establecer la zona horaria a la de Perú (Lima)
date_default_timezone_set('America/Lima');
// Obtén la fecha y hora actuales
$fecha_actual = new DateTime();
$fecha_y_hora = $fecha_actual->format('Y-m-d H:i:s');

$estado = 'pendiente';
// Incluir archivo de conexión
include ('../conexion/conexion.php');

$sql = "INSERT INTO `tickets` (`numero_ticket`, `id_usuario`, `nombre_solicitante`, `tipo_ticket`, `detalle_ticket`, `id_impresora`, `estado_ticket`,`fecha_ticket`)
VALUES('$numero_ticket','$id_usuario', '$solicitante','$tipo','$detalle','$id_impresora','$estado','$fecha_y_hora')";

$result = $conn->query($sql);

if ($result){
    header("Location: ./inicio.php");
}else{
    "Error al insertar los datos: ". $conn->error;
}

$conn->close();

?>