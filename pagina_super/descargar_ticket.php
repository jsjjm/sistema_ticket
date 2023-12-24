<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Incluir la lógica de conexión a la base de datos (usando $conn)
include ('../conexion/conexion.php');
// Obtener datos de la tabla ticket
$stm = $conn->prepare("SELECT id_ticket, numero_ticket, id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket, id_impresora, estado_ticket, fecha_ticket, id_usuario_soporte, nombre_usuario_soporte, fecha_revision_soporte FROM tickets");
$stm->execute();
$resultado = $stm->get_result();

// Crear una instancia de Spreadsheet
$spreadsheet = new Spreadsheet();

// Configurar el contenido de la hoja de cálculo
$spreadsheet->getActiveSheet()->setCellValue('A1', 'ID Ticket');
$spreadsheet->getActiveSheet()->setCellValue('B1', 'Número de Ticket');
$spreadsheet->getActiveSheet()->setCellValue('C1', 'Área Usuario');
$spreadsheet->getActiveSheet()->setCellValue('D1', 'Nombre Solicitante');
$spreadsheet->getActiveSheet()->setCellValue('E1', 'Tipo de Ticket');
$spreadsheet->getActiveSheet()->setCellValue('F1', 'Detalle del Ticket');
$spreadsheet->getActiveSheet()->setCellValue('G1', 'Impresora');
$spreadsheet->getActiveSheet()->setCellValue('H1', 'Estado del Ticket');
$spreadsheet->getActiveSheet()->setCellValue('I1', 'Fecha del Ticket');

$spreadsheet->getActiveSheet()->setCellValue('K1', 'Nombre Usuario Soporte');
$spreadsheet->getActiveSheet()->setCellValue('L1', 'Fecha de Revisión de Soporte');

// Configurar el índice de la fila
$fila = 2;

// Iterar a través de los resultados y agregar filas a la hoja de cálculo
while ($row = $resultado->fetch_assoc()) {

                // Consulta preparada para obtener el área del usuario
                $stm = $conn->prepare("SELECT id_area FROM usuarios WHERE id_usuario = ?");
                $stm->bind_param("s", $row['id_usuario']);
                $stm->execute();
                $result = $stm->get_result();
                
                if ($result->num_rows > 0) {
                    // Obtener el resultado
                    $rowUsuario = $result->fetch_assoc();

                    // Ahora, $rowUsuario['area'] contiene el valor del área del usuario
                    $id_areaUsuario = $rowUsuario['id_area'];

                    $sqlAreaU = "SELECT id_area,descripcion FROM area WHERE id_area=$id_areaUsuario";
                    $resultAreaU = $conn->query($sqlAreaU);

                    // Verificar si se encontraron resultados
                    if ($rowAreaU = $resultAreaU->fetch_assoc()) {
                        $areaUsuarioU = $rowAreaU['descripcion'];
                    }
                } else {
                    //echo "No se encontró el usuario con el id " . $idUsuario;
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
                    $impresora =" - ";
                }

                // Obtén el valor de $row['nombre_usuario_soporte']
                $valor_usuario_soporte = $row['nombre_usuario_soporte'];

                // Verifica si contiene letras o es igual a 0
                if (ctype_alpha($valor_usuario_soporte) || $valor_usuario_soporte == 0) {
                    // Si contiene letras o es igual a 0, asigna una cadena vacía a $nombre_soporte
                    $nombre_soporte = '';
                } else {
                    // Si es diferente de 0, asigna el valor de $valor_usuario_soporte a $nombre_soporte
                    $nombre_soporte = $valor_usuario_soporte;
                }

    $spreadsheet->getActiveSheet()->setCellValue('A' . $fila, $row['id_ticket']);
    $spreadsheet->getActiveSheet()->setCellValue('B' . $fila, $row['numero_ticket']);
    $spreadsheet->getActiveSheet()->setCellValue('C' . $fila, $areaUsuarioU);
    $spreadsheet->getActiveSheet()->setCellValue('D' . $fila, $row['nombre_solicitante']);
    $spreadsheet->getActiveSheet()->setCellValue('E' . $fila, $row['tipo_ticket']);
    $spreadsheet->getActiveSheet()->setCellValue('F' . $fila, $row['detalle_ticket']);
    $spreadsheet->getActiveSheet()->setCellValue('G' . $fila, $impresora);
    $spreadsheet->getActiveSheet()->setCellValue('H' . $fila, $row['estado_ticket']);
    $spreadsheet->getActiveSheet()->setCellValue('I' . $fila, $row['fecha_ticket']);
   
    $spreadsheet->getActiveSheet()->setCellValue('K' . $fila, $nombre_soporte);
    $spreadsheet->getActiveSheet()->setCellValue('L' . $fila, $row['fecha_revision_soporte']);

    // Incrementar el índice de la fila
    $fila++;
}

// Crear el escritor (Writer) para guardar la hoja de cálculo en un archivo
$writer = new Xlsx($spreadsheet);

// Generar un nombre de archivo único basado en la fecha y hora actual
$nombreArchivo = 'tickets_' . date('Ymd_His') . '.xlsx';

// Configurar encabezados HTTP para forzar la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
header('Cache-Control: max-age=0');

// Enviar el archivo al navegador
$writer->save('php://output');
exit; // Importante: detener la ejecución del script después de enviar el archivo
?>
