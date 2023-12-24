<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear una instancia de Spreadsheet
$spreadsheet = new Spreadsheet();

// Configurar el contenido de tu hoja de cálculo
$spreadsheet->getActiveSheet()->setCellValue('A1', 'Número de Ticket');
$spreadsheet->getActiveSheet()->setCellValue('B1', 'Estado');
$spreadsheet->getActiveSheet()->setCellValue('A2', '1');
$spreadsheet->getActiveSheet()->setCellValue('B2', 'En Proceso');

// Crear el escritor (Writer) para guardar la hoja de cálculo en un archivo
$writer = new Xlsx($spreadsheet);

// Generar un nombre de archivo único basado en la fecha y hora actual
$nombreArchivo = 'ticket_' . date('Ymd_His') . '.xlsx';

// Configurar encabezados HTTP para forzar la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
header('Cache-Control: max-age=0');

// Enviar el archivo al navegador
$writer->save('php://output');
exit; // Importante: detener la ejecución del script después de enviar el archivo
?>

