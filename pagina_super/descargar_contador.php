<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Incluir la lógica de conexión a la base de datos (usando $conn)
include ('../conexion/conexion.php');

// Obtener datos de la tabla contador_impresiones
$stm = $conn->prepare("SELECT id_contador, id_usuario, id_impresora, id_area, id_sede, id_ubicacion, fecha_inicial, contador_inicial, fecha_final, contador_final, contador_mes, monto_cambio, total_producido, fecha_registro FROM contador_impresiones");
$stm->execute();
$resultado = $stm->get_result();

// Crear una instancia de Spreadsheet
$spreadsheet = new Spreadsheet();

// Configurar el contenido de la hoja de cálculo
$spreadsheet->getActiveSheet()->setCellValue('A1', 'ID Contador');
$spreadsheet->getActiveSheet()->setCellValue('B1', 'ID Usuario');
$spreadsheet->getActiveSheet()->setCellValue('C1', 'ID Impresora');
$spreadsheet->getActiveSheet()->setCellValue('D1', 'ID Área');
$spreadsheet->getActiveSheet()->setCellValue('E1', 'ID Sede');
$spreadsheet->getActiveSheet()->setCellValue('F1', 'ID Ubicación');
$spreadsheet->getActiveSheet()->setCellValue('G1', 'Fecha Inicial');
$spreadsheet->getActiveSheet()->setCellValue('H1', 'Contador Inicial');
$spreadsheet->getActiveSheet()->setCellValue('I1', 'Fecha Final');
$spreadsheet->getActiveSheet()->setCellValue('J1', 'Contador Final');
$spreadsheet->getActiveSheet()->setCellValue('K1', 'Contador Mes');
$spreadsheet->getActiveSheet()->setCellValue('L1', 'Monto Cambio');
$spreadsheet->getActiveSheet()->setCellValue('M1', 'Total Producido');
$spreadsheet->getActiveSheet()->setCellValue('N1', 'Fecha de Registro');

// Configurar el índice de la fila
$fila = 2;

// Iterar a través de los resultados y agregar filas a la hoja de cálculo
while ($row = $resultado->fetch_assoc()) {

        // Ahora, $rowUsuario['area'] contiene el valor del área del usuario
        $id_areaUsuario = $row['id_area'];

        $sqlAreaU = "SELECT id_area,descripcion FROM area WHERE id_area=$id_areaUsuario";
        $resultAreaU = $conn->query($sqlAreaU);

        // Verificar si se encontraron resultados
        if ($rowAreaU = $resultAreaU->fetch_assoc()) {
            $areaUsuarioU = $rowAreaU['descripcion'];
        }
        else{
            $areaUsuarioU = "No se encontro área";
        }


    if ($row['id_impresora'] !== 0) {
        $id_impresora = $row['id_impresora']; 
        $sqlModelo = "SELECT id_impresora, marca, modelo FROM impresora WHERE id_impresora=$id_impresora";
        $resultModelo = $conn->query($sqlModelo);

        // Verificar si se encontraron resultados
        if ($rowModelo = $resultModelo->fetch_assoc()) {
            //echo "<label>Impresora</label>";
            //echo "<h6>" . $rowModelo['marca'] . " " . $rowModelo['modelo'] . "</h6>";
            $impresora = $rowModelo['marca'] . " " . $rowModelo['modelo'];
        }
    } 
    else{
        $impresora ="No se encontro impresora ";
    }

    // Ahora, $rowUsuario['id_sede'] contiene el valor de sede
    $id_sede = $row['id_sede'];

    $sqlsede = "SELECT id_sede,descripcion FROM sede WHERE id_sede=$id_sede";
    $resultsede = $conn->query($sqlsede);

    // Verificar si se encontraron resultados
    if ($rowsede = $resultsede->fetch_assoc()) {
        $sede = $rowsede['descripcion'];
    }
    else{
        $sede = "No se encontro sede";
    }

    // Ahora, $rowUsuario['id_sede'] contiene el valor de sede
    $id_ubicacion = $row['id_ubicacion'];

    $sqlubi = "SELECT id_ubicacion,descripcion FROM ubicacion WHERE id_ubicacion=$id_ubicacion";
    $resultubi = $conn->query($sqlubi);

    // Verificar si se encontraron resultados
    if ($rowubi = $resultubi->fetch_assoc()) {
        $ubicacion = $rowubi['descripcion'];
    }
    else{
        $ubicacion = "No se encontro ubicacion";
    }


    $spreadsheet->getActiveSheet()->setCellValue('A' . $fila, $row['id_contador']);
    $spreadsheet->getActiveSheet()->setCellValue('B' . $fila, $row['id_usuario']);
    $spreadsheet->getActiveSheet()->setCellValue('C' . $fila, $impresora);
    $spreadsheet->getActiveSheet()->setCellValue('D' . $fila, $areaUsuarioU);
    $spreadsheet->getActiveSheet()->setCellValue('E' . $fila, $sede);
    $spreadsheet->getActiveSheet()->setCellValue('F' . $fila, $ubicacion);
    $spreadsheet->getActiveSheet()->setCellValue('G' . $fila, $row['fecha_inicial']);
    $spreadsheet->getActiveSheet()->setCellValue('H' . $fila, $row['contador_inicial']);
    $spreadsheet->getActiveSheet()->setCellValue('I' . $fila, $row['fecha_final']);
    $spreadsheet->getActiveSheet()->setCellValue('J' . $fila, $row['contador_final']);
    $spreadsheet->getActiveSheet()->setCellValue('K' . $fila, $row['contador_mes']);
    $spreadsheet->getActiveSheet()->setCellValue('L' . $fila, $row['monto_cambio']);
    $spreadsheet->getActiveSheet()->setCellValue('M' . $fila, $row['total_producido']);
    $spreadsheet->getActiveSheet()->setCellValue('N' . $fila, $row['fecha_registro']);

    // Incrementar el índice de la fila
    $fila++;
}

// Crear el escritor (Writer) para guardar la hoja de cálculo en un archivo
$writer = new Xlsx($spreadsheet);

// Generar un nombre de archivo único basado en la fecha y hora actual
$nombreArchivo = 'contador_impresiones_' . date('Ymd_His') . '.xlsx';

// Configurar encabezados HTTP para forzar la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
header('Cache-Control: max-age=0');

// Enviar el archivo al navegador
$writer->save('php://output');
exit; // Importante: detener la ejecución del script después de enviar el archivo
?>
