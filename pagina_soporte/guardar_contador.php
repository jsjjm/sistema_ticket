<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
$id_impresora = $_POST['id_impresora'];
$id_area = $_POST['id_area'];
$id_sede = $_POST['id_sede'];
$id_ubicacion = $_POST['id_ubicacion'];
//$fecha_inicial = $_POST['fecha_inicial'];
//$contador_inicial = $_POST['contador_inicial'];
$fecha_final = $_POST['fecha_final'];
$contador_final = $_POST['contador_final'];

// Establecer la zona horaria a la de Perú (Lima)
date_default_timezone_set('America/Lima');
// Obtén la fecha actual
$fecha_actual = new DateTime();

// Formatear la fecha en el formato adecuado para un campo de tipo DATE
$fecha_formateada = $fecha_actual->format('Y-m-d');

// Incluir archivo de conexión
include('../conexion/conexion.php');

// Consultar el campo 'fecha final y contador final' de la última fila de la tabla 'contador_impresiones'
$sqlcontador = "SELECT fecha_final, contador_final FROM contador_impresiones WHERE id_impresora=$id_impresora AND id_area=$id_area  ORDER BY id_contador DESC LIMIT 1";
$resultcontador = $conn->query($sqlcontador);

// Verificar si la consulta fue exitosa
if ($resultcontador) {
    // Obtener el valor del campo 'fecha final y contador final'
    $rowcontador = $resultcontador->fetch_assoc();
    
    // Asignar valores predeterminados si no hay registros en la tabla
    if ($rowcontador) {
        $fecha_inicial = $rowcontador['fecha_final'];
        $contador_inicial = $rowcontador['contador_final'];
    } else {
        $fecha_inicial = '2023-01-01'; // Establecer una fecha predeterminada
        $contador_inicial = 0; // Establecer un contador predeterminado
    }
} else {
    echo "Error al obtener el contador: " . $conn->error;
}

// Consultar el campo 'monto' de la última fila de la tabla 'cambio_actual'
$sqlmonto = "SELECT monto FROM cambio_actual ORDER BY id_cambio DESC LIMIT 1";
$resultmonto = $conn->query($sqlmonto);

// Verificar si la consulta fue exitosa
if ($resultmonto) {
    // Obtener el valor del campo 'monto'
    $row = $resultmonto->fetch_assoc();
    $monto_cambio = floatval($row['monto']);
} else {
    echo "Error al obtener el monto: " . $conn->error;
}

// Calcular el contador_mes
$contador_mes = $contador_final - $contador_inicial;

// Calcular el total_producido
$total_producido = $contador_mes * $monto_cambio;

// Insertar en la base de datos
$sql = "INSERT INTO `contador_impresiones` (`id_usuario`, `id_impresora`, `id_area`,`id_sede`,`id_ubicacion`, `fecha_inicial`,
 `contador_inicial`, `fecha_final`, `contador_final`, `contador_mes`, `monto_cambio`, `total_producido`, `fecha_registro`)
VALUES ('$id_usuario', '$id_impresora', '$id_area','$id_sede','$id_ubicacion', '$fecha_inicial', '$contador_inicial',
'$fecha_final', '$contador_final', '$contador_mes', '$monto_cambio', '$total_producido', '$fecha_formateada')";

$result = $conn->query($sql);

if ($result) {
    header("Location: ./contador.php");
} else {
    echo "Error al insertar los datos: " . $conn->error;
}

$conn->close();
?>

