<?php
// Inicia la sesión (si aún no está iniciada)
session_start();

// Verifica si la variable de sesión está definida y tiene un valor
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Si no hay una sesión válida, redirige a la página de inicio de sesión
    header("Location: ../login.php");
    exit(); // Asegura que el script se detenga después de la redirección
}

// Aquí continúa el contenido de tu página, ya que el usuario ha iniciado sesión
?>
<?php
//session_start();
$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre_usu'];
$tipo_usuario = $_SESSION['tipo'];
//$area_usuario = $_SESSION['area'];

include ('../conexion/conexion.php');
$id_area = $_SESSION['id_area'];

$sqlArea = "SELECT id_area,descripcion FROM area WHERE id_area=$id_area";
$resultArea = $conn->query($sqlArea);

// Verificar si se encontraron resultados
if ($rowArea = $resultArea->fetch_assoc()) {

 $areaUsuario = $rowArea['descripcion'] ;
}

// Incluir archivo de conexión
//include ('../conexion/conexion.php');

// Consulta para calcular el número de tickets
$sql = "SELECT COUNT(*) AS num_tickets FROM tickets";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $numTickets = $row['num_tickets'];
    //echo "El número total de tickets es: " . $numTickets;
} else {
    echo "Error al realizar la consulta: " . $conn->error;
}


// Consulta para calcular el número de tickets pendientes
$sqlPendientes = "SELECT COUNT(*) AS num_tickets_pendientes FROM tickets WHERE estado_ticket = 'pendiente'";
$resultPendientes = $conn->query($sqlPendientes);

// Consulta para calcular el número de tickets en proceso
$sqlEnProceso = "SELECT COUNT(*) AS num_tickets_en_proceso FROM tickets WHERE estado_ticket = 'en proceso'";
$resultEnProceso = $conn->query($sqlEnProceso);

// Consulta para calcular el número de tickets terminados
$sqlTerminados = "SELECT COUNT(*) AS num_tickets_terminados FROM tickets WHERE estado_ticket = 'terminado'";
$resultTerminados = $conn->query($sqlTerminados);

// Verificar resultados y mostrar el total para cada estado
if ($resultPendientes && $resultEnProceso && $resultTerminados) {
    $rowPendientes = $resultPendientes->fetch_assoc();
    $numTicketsPendientes = $rowPendientes['num_tickets_pendientes'];

    $rowEnProceso = $resultEnProceso->fetch_assoc();
    $numTicketsEnProceso = $rowEnProceso['num_tickets_en_proceso'];

    $rowTerminados = $resultTerminados->fetch_assoc();
    $numTicketsTerminados = $rowTerminados['num_tickets_terminados'];

    //echo "El número total de tickets pendientes es: " . $numTicketsPendientes . "<br>";
    //echo "El número total de tickets en proceso es: " . $numTicketsEnProceso . "<br>";
    //echo "El número total de tickets terminados es: " . $numTicketsTerminados;
} else {
    echo "Error al realizar las consultas: " . $conn->error;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Inicio Ususario</title>
</head>
<style>
    
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Evita la barra de desplazamiento horizontal */
            background-color: #f0f0f0; /* Color de fondo del body */
        }

        .seccion-menu {
            background-color: #333; /* Color de fondo del menú */
            color: #fff; /* Color del texto del menú */
            padding: 10px; /* Espaciado interno del menú */
        }
        .cerrar-sesion{
            color: #fff; /* Color del texto del menú */
            text-decoration: none; /* Quitar el subrayado del enlace */
        }
    </style>
<body class="bg-body-secondary">

<div class="seccion-menu">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-6 col-6">
            Bienvenido <?php echo $nombre_usuario; ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6 col-6">
            <!-- Button trigger modal -->
            <a type="button" class="cerrar-sesion" data-bs-toggle="modal" data-bs-target="#ModalCerrarsesion">
            <i class="bi bi-power"></i> Cerrar Sesión
            </a>

        </div>
    </div>
        
</div>

<div class="container ">
    
    <div class="row pt-4">
        <div class="col-md-4 col-sm-12">
            <div class="card border">
                <div class="card-header bg-info text-center">
                    <!-- Circulo centrado con una imagen -->
                    <div class="rounded-circle overflow-hidden mx-auto" style="width: 80px; height: 80px; background-color: white;">
                        <!-- Añade tu imagen aquí -->
                        <img src="../images/user-image.png" alt="Imagen del usuario" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <h3 class="text-center"><?php echo $nombre_usuario ?></h3>
                    </div>
                    <div class="row pt-2 pb-2">
                        <label class="text-center"><?php echo 'Área | ' . $areaUsuario ?> | </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12">
            
                <div class="row px-2 pt-1">

                    <div class="col-6 p-3 card ">
                        <div class="row">
                            <h2>SOPORTE</h2>
                        </div>

                        <div class="row">

                            <div class="col-12">
                                <a href="./tickets_soporte.php" class="btn btn-success">Tickets Soporte</a>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-6 p-3 card">
                        <div class="row">
                        <h2>TONER</h2>
                        </div>
                        <div class="row">

                            <div class="col-12">
                            <a href="./tickets_toner.php" class="btn btn-success">Tickets Toner</a>
                            </div>
                                                         
                        </div>
                        
                    </div>
                </div>


                <div class="row pt-2">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                            <div class="row">
                                <div class="col-4 text-secondary">
                                    <i class="bi bi-list-ol" style="font-size: 2.5rem;"></i>
                                </div>
                                <div class="col-8">
                                    N° Tickets
                                    <h3><?php echo $numTickets; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                            <div class="row">
                                <div class="col-4 text-warning">
                                 <i class="bi bi-alarm" style="font-size: 2.5rem;"></i>
                                </div>
                                <div class="col-8">
                                    Pendientes
                                    <h3><?php echo $numTicketsPendientes ;?></h3>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                            <div class="row">
                                <div class="col-4 text-info">
                                    <i class="bi bi-gear" style="font-size: 2.5rem;"></i>
                                </div>
                                <div class="col-8">
                                    En Proceso
                                    <h3><?php echo $numTicketsEnProceso ;?></h3>       
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                            <div class="row">
                                <div class="col-4 text-success">
                                    <i class="bi bi-check2-circle" style="font-size: 2.5rem;"></i>
                                </div>
                                <div class="col-8">
                                    Terminado
                                    <h3><?php echo $numTicketsTerminados ;?></h3>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>

            
                
           
        </div>
    </div>

    <div class="seccion_soporte row pt-2 p-3">


<!------ Include the above in your HEAD tag ---------->

            <div class="container">
                <div class="row pt-3 justify-content-between">
                    <div class="col-md-4 col-sm-12">
                        <form action="#" method="get">
                            <div class="">
                                <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                <input class="form-control" id="system-search" name="q" placeholder="Buscar por: " required>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                   <!--   <div class="col-md-4 col-sm-12 pb-2">
                        <form action="inicio.php" method="get">
                            <div class="input-group">
                                 Campo de entrada de tipo date 
                                <input type="date" class="form-control" name="fecha_seleccionada">
                                <span class="input-group-btn">
                                     Botón para enviar el formulario 
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </span>
                            </div>
                        </form>
                    </div>-->
                    
                </div>
            </div>

    <?php
        // Obtener el id_usuario
        //$id_usuario = $_SESSION['idUsuario'];
      //  include ('../conexion/conexion.php');
        // Consultar la tabla tickets
        $stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets /*WHERE id_usuario = ?*/ ORDER BY fecha_ticket DESC");
        //$stm->bind_param("s", $id_usuario);
        $stm->execute();
        $resultado = $stm->get_result();
        ?>

        <!-- Crear la tabla -->
        <div class="row">
            <?php while ($row = $resultado->fetch_assoc()) : ?>
                <?php
                $idUsuario = $row['id_usuario'];
                    // Consulta preparada para obtener el área del usuario
                    $stm = $conn->prepare("SELECT id_area FROM usuarios WHERE id_usuario = ?");
                    $stm->bind_param("s", $idUsuario);
                    $stm->execute();
                    $result = $stm->get_result();

                    if ($result->num_rows > 0) {
                        // Obtener el resultado
                        $rowUsuario = $result->fetch_assoc();
                        
                        // Ahora, $rowUsuario['area'] contiene el valor del área del usuario
                        $id_areaUsuario = $rowUsuario['id_area'];
                        //echo "El área del usuario es: " . $areaUsuario;
                            $sqlAreaU = "SELECT id_area,descripcion FROM area WHERE id_area=$id_areaUsuario";
                            $resultAreaU = $conn->query($sqlAreaU);

                            // Verificar si se encontraron resultados
                            if ($rowAreaU = $resultAreaU->fetch_assoc()) {

                            $areaUsuarioU = $rowAreaU['descripcion'] ;
                            }

                    } else {
                        //echo "No se encontró el usuario con el id " . $idUsuario;
                    }

                    

                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="card ">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <!-- Contenido del encabezado de la tarjeta -->
                                    <h5 class="card-title"><?php echo $row['numero_ticket']; ?></h5>
                                </div>
                                <div class="col-6">
                                    <?php
                                    if($row['estado_ticket'] == 'pendiente'){
                                        echo '<label for="" class="bg-warning px-4 py-1 rounded-pill text-white">'. $row['estado_ticket'] . '</label>';
                                    }
                                    elseif($row['estado_ticket'] == 'en proceso'){
                                        echo '<label for="" class="bg-info px-4 py-1 rounded-pill text-white">'. $row['estado_ticket'] . '</label>';
                                    }
                                    elseif($row['estado_ticket'] == 'terminado'){
                                        echo '<label for="" class="bg-success px-4 py-1 rounded-pill text-white">'. $row['estado_ticket'] . '</label>';
                                    }
                                    ?>
                                </div>
                            </div>

                            
                        </div>
                        <div class="card-body">
                            <!-- Contenido del cuerpo de la tarjeta -->
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Área </label>
                                </div>
                                <div class="col-8">
                                    <p class="card-text"><?php echo $areaUsuarioU; ?></p>
                                </div>

                                <div class="col-4 pt-1">
                                    <label for="">De: </label>
                                </div>
                                <div class="col-8">
                                    <p class="card-text"><?php echo $row['nombre_solicitante']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Tipo: </label>
                                </div>
                                <div class="col-8">
                                    <?php
                                    if($row['tipo_ticket'] == 'soporte'){
                                        echo '<label for="" class="bg-secondary px-4 py-1 rounded-pill text-white">'. $row['tipo_ticket'] . '</label>';
                                    }
                                    elseif($row['tipo_ticket'] == 'toner'){
                                        echo '<label for="" class="bg-primary px-4 py-1 rounded-pill text-white">'. $row['tipo_ticket'] . '</label>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <!--    <div class="row p-2">
                                    <div class="card p-2">
                                        <p class="card-text"><?php echo $row['detalle_ticket']; ?></p>
                                    </div>
                            </div> -->
                            
                           
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6 ">
                                    <!-- Contenido del pie de la tarjeta -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVer<?php echo $row['id_ticket']; ?>">
                                        <i class="bi bi-eye"></i> Ver
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalVer<?php echo $row['id_ticket']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $row['id_ticket']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle del Ticket</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="./actualizar_estado_ticket.php" method="post">
                                            <div class="row">
                                               
                                                    <input class="d-none" name="numero_ticket" type="text" value="<?php echo $row['numero_ticket']; ?> " >
                                                <div class="col-6">
                                                    <label for="">Numero</label>
                                                    <h3><?php echo $row['numero_ticket']; ?></h3>
                                                </div>
                                                
                                                <div class="col-6">
                                                    <label for="">Área </label>
                                                    <h5 class="card-text"><?php echo $areaUsuario; ?></h5>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <label for="">Estado</label>
                                                <?php
                                                if($row['estado_ticket'] == 'pendiente'){
                                                    echo '
                                                    <select class="form-select bg-warning text-white" name="estado_ticket" id="estado_ticket">
                                                            <option value="pendiente" >'. $row['estado_ticket'] . '</option>
                                                            <option value="en proceso" >en proceso</option>
                                                            <option value="terminado" >terminado</option>
                                                        </select>';
                                                }
                                                elseif($row['estado_ticket'] == 'en proceso'){
                                                    echo '
                                                    <select class="form-select bg-info text-white" name="estado_ticket" id="estado_ticket">
                                                            <option value="en proceso" >'. $row['estado_ticket'] . '</option>
                                                            <option value="pendiente" >pendiente</option>
                                                            <option value="terminado" >terminado</option>
                                                        </select>';
                                                }
                                                elseif($row['estado_ticket'] == 'terminado'){
                                                    echo '
                                                    <select class="form-select bg-success text-white" name="estado_ticket" id="estado_ticket">
                                                            <option value="terminado" >'. $row['estado_ticket'] . '</option>
                                                            <option value="pendiente" >pendiente</option>
                                                            <option value="en proceso" >en proceso</option>
                                                        </select>';
                                                }
                                                ?>                                               

                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="">Solicitante</label>
                                                    <h5><?php echo $row['nombre_solicitante']; ?></h5>
                                                </div>
                                                <div class="col-6">
                                                <label for="">Tipo</label>
                                                    <h5>
                                                    <?php
                                                    if($row['tipo_ticket'] == 'soporte'){
                                                        echo '<label for="" class="bg-secondary px-4 py-1 rounded-pill text-white">'. $row['tipo_ticket'] . '</label>';
                                                        }
                                                        elseif($row['tipo_ticket'] == 'toner'){
                                                        echo '<label for="" class="bg-primary px-4 py-1 rounded-pill text-white">'. $row['tipo_ticket'] . '</label>';
                                                        }
                                                        ?>        
                                                </h5>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    
                                                <?php 
                                                if ($row['id_impresora'] !== 0) {
                                                    $id_impresora = $row['id_impresora']; 
                                                    $sqlModelo = "SELECT id_impresora, marca, modelo FROM impresora WHERE id_impresora=$id_impresora";
                                                    $resultModelo = $conn->query($sqlModelo);

                                                    // Verificar si se encontraron resultados
                                                    if ($rowModelo = $resultModelo->fetch_assoc()) {
                                                        echo "<label>Impresora</label>";
                                                        echo "<h6>" . $rowModelo['marca'] . " " . $rowModelo['modelo'] . "</h6>";
                                                    }
                                                } 
                                                // No necesitas un 'else' si no estás haciendo nada en caso de $row['id_impresora'] igual a 0
                                                ?>


                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="">Descripcion de ticket</label>
                                                    <div class="card p-3">
                                                        <h6 ><?php echo $row['detalle_ticket']; ?></h6>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                    
                                                    <div class="col-6"></div>
                                                    <div class="col-6">
                                                    <label for="">Fecha</label>
                                                        <h6 ><?php echo $row['fecha_ticket']; ?></h6>

                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <div class="row">
                                                    
                                                    <div class="col-6">
                                                        <button class="btn btn-success">Guardar</button>

                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>

                                        </div>

                                        
                                        
                                    </div>
                                    </div>
                                </div>
                                <div class="col-6 p-2">
                                 <small class="text-muted"><?php echo date("d-m-Y", strtotime($row['fecha_ticket'])); ?></small>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Modal y su contenido permanecen igual -->
                <!-- ... -->

            <?php endwhile; ?>
        </div>





    </div>


    




<script>
    $(document).ready(function() {
    var activeSystemClass = $('.list-group-item.active');

    // algo se ingresa en el formulario de búsqueda
    $('#system-search').keyup( function() {
        var that = this;
        // afecta a todas las tarjetas en la sección de soporte
        var cards = $('.seccion_soporte .card');
        $('.search-sf').remove();
        
        cards.each(function(i, val) {
            var cardText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            
            if (inputText !== '') {
                $('.search-query-sf').remove();
                $('.seccion_soporte').prepend('<div class="search-query-sf"><strong>Buscando: "'
                    + $(that).val()
                    + '"</strong></div>');
            } else {
                $('.search-query-sf').remove();
            }

            if (cardText.indexOf(inputText) == -1) {
                // ocultar tarjetas
                cards.eq(i).hide();
            } else {
                $('.search-sf').remove();
                cards.eq(i).show();
            }
        });

        // todos los elementos de tarjetas están ocultos
        if (cards.filter(':visible').length === 0) {
            $('.seccion_soporte').append('<div class="search-sf"><p class="text-muted">No se encontraron resultados.</p></div>');
        }
    });
});

</script>


</div>


    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>




 <!-- Modal -->
<div class="modal fade" id="ModalCerrarsesion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Seguro que quieres Cerrar la Sesión?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-footer">
      <form action="../mysql/cerrar_sesion.php" method="post">
        <button type="submit" class="btn btn-primary">Cerrar Sesión</button>
        </form>
      </div>
    </div>
  </div>
</div>       