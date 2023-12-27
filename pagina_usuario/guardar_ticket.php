<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; // Agrega esta línea para importar la clase SMTP

require '../vendor/autoload.php'; // Asegúrate de cargar la autoloader de PHPMailer

// Incluir archivo de conexión
include ('../conexion/conexion.php');

session_start();
$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usu'];
$tipo = $_POST['tipo'];
$solicitante = $_POST['solicitante'];
$detalle = $_POST['detalle'];

//$id_marca_imp = $_POST['id_marca_imp'];
$id_impresora = $_POST['id_impresora'] ?? 0;

if ($id_impresora != 0) {
    $sqlModelo = "SELECT id_impresora,marca, modelo FROM impresora where $id_impresora";
    $resultModelo = $conn->query($sqlModelo);
    $fila = mysqli_fetch_assoc($resultModelo);
    $impresora = $fila['marca'] ."-".$fila['modelo'];
}else{

    $impresora = " ";
}
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

$sql = "INSERT INTO `tickets` (`numero_ticket`, `id_usuario`, `nombre_solicitante`, `tipo_ticket`, `detalle_ticket`, `id_impresora`, `estado_ticket`,`fecha_ticket`)
VALUES('$numero_ticket','$id_usuario', '$solicitante','$tipo','$detalle','$id_impresora','$estado','$fecha_y_hora')";

$result = $conn->query($sql);



if ($result) {
    // Envío de correo electrónico
    enviarCorreoNuevoTicket($numero_ticket, $solicitante, $tipo, $detalle,$impresora,$id_impresora);

    echo '<script>window.location.href = "./inicio.php";</script>';
    exit;
    

} else {
    echo "Error al insertar los datos: " . $conn->error;
}

$conn->close();

// Función para enviar el correo electrónico
function enviarCorreoNuevoTicket($numero_ticket, $solicitante, $tipo, $detalle,$impresora,$id_impresora) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor de correo
        /*correo: soporte_tickets@jymtecnologianetwork.com
        contraseña: Gk9TRw!X$f77F92s
        servidor: mx114.hostgator.mx
        puerto de entrada: 995 (este no se usa)
        puerto salida: 465
        seguridad: PHPMailer::ENCRYPTION_SMTPS (ponemos esto para que se detecte automaticamente)*/


        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();
        $mail->Host       = 'mx114.hostgator.mx'; // Cambia esto por el servidor SMTP que estés utilizando
        $mail->SMTPAuth   = true;
        $mail->Username   = 'soporte_tickets@jymtecnologianetwork.com'; // Cambia esto por tu correo electrónico
        $mail->Password   = 'Gk9TRw!X$f77F92s'; // Cambia esto por tu contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;

        // Configuración del remitente y destinatario
        $mail->setFrom('soporte_tickets@jymtecnologianetwork.com', 'Ticket Soporte');
        $mail->addAddress('jimenezmoralesjunior@gmail.com', 'Destinatario'); // Cambia esto por el destinatario real

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo Ticket Pendiente';

        if ($id_impresora != 0) {
            $mail->Body = "
                <html>
                    <body>
                        <div style='font-family: Arial, sans-serif;'>
                            <h2 style='color: #3498db;'>Nuevo Ticket Pendiente</h2>
                            <p>Se ha creado un nuevo ticket con la siguiente información:</p>
                            <ul>
                                <li><strong>Número de Ticket:</strong> $numero_ticket</li>
                                <li><strong>Solicitante:</strong> $solicitante</li>
                                <li><strong>Tipo:</strong> $tipo</li>
                                <li><strong>Impresora:</strong> $impresora</li>
                                <li><strong>Detalle:</strong> $detalle</li>
                            </ul>
                        </div>
                    </body>
                </html>
            ";
        } else {
            $mail->Body = "
                <html>
                    <body>
                        <div style='font-family: Arial, sans-serif;'>
                            <h2 style='color: #3498db;'>Nuevo Ticket Pendiente</h2>
                            <p>Se ha creado un nuevo ticket con la siguiente información:</p>
                            <ul>
                                <li><strong>Número de Ticket:</strong> $numero_ticket</li>
                                <li><strong>Solicitante:</strong> $solicitante</li>
                                <li><strong>Tipo:</strong> $tipo</li>
                                <li><strong>Detalle:</strong> $detalle</li>
                            </ul>
                        </div>
                    </body>
                </html>
            ";
        }

        $mail->send();
        //echo "enviado correctamente";
    } catch (Exception $e) {
        echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
    }
}
?>
