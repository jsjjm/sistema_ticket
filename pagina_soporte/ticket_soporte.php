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
$sql = "SELECT COUNT(*) AS num_tickets FROM tickets WHERE tipo_ticket = 'soporte' ";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $numTickets = $row['num_tickets'];
    //echo "El número total de tickets es: " . $numTickets;
} else {
    echo "Error al realizar la consulta: " . $conn->error;
}


// Consulta para calcular el número de tickets pendientes
$sqlPendientes = "SELECT COUNT(*) AS num_tickets_pendientes FROM tickets WHERE estado_ticket = 'pendiente' and tipo_ticket = 'soporte' ";
$resultPendientes = $conn->query($sqlPendientes);

// Consulta para calcular el número de tickets en proceso
$sqlEnProceso = "SELECT COUNT(*) AS num_tickets_en_proceso FROM tickets WHERE estado_ticket = 'en proceso' and tipo_ticket = 'soporte' ";
$resultEnProceso = $conn->query($sqlEnProceso);

// Consulta para calcular el número de tickets terminados
$sqlTerminados = "SELECT COUNT(*) AS num_tickets_terminados FROM tickets WHERE estado_ticket = 'terminado' and tipo_ticket = 'soporte' ";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../styles/sidebar.css">

    <title> <?php echo $nombre_usuario  ?></title>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
            <h3>Multiservicios Benites <i class="bi bi-printer-fill"></i></h3>
            </div>

            <ul class="list-unstyled components">
            

                <li >
                    <a href="./inicio.php">Dashboard</a>                    
                </li>
                
                <li class="active"> 
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Tickets</a>
                    <ul class="collapse list-unstyled show" id="pageSubmenu">
                        <li >
                            <a href="./ticket_todos.php">Tickets Todos</a>
                        </li>
                        <li class="active">
                            <a href="./ticket_soporte.php">Tickets Soporte</a>
                        </li>
                        <li>
                            <a href="./ticket_toner.php">Tickets Toner</a>
                        </li>
                    </ul>
                </li>


                <li >                
                <a href="./contador.php">Contador</a>
                </li>

                


                <li>
                    <a href="" id="sidebarCerrar" data-toggle="modal" data-target="#ModalCerrarsesion">Cerrar Sesión</a>
                        <!-- Modal -->
                        <div class="modal fade" id="ModalCerrarsesion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">¿Seguro que quieres Cerrar la Sesión?</h1>
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
                </li>
            </ul>


        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                            <?php  echo $nombre_usuario ?>
                                
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- contenido de la pagina -->


            <div class="row ">

            <h3>Tickets Soporte</h3>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                            <a href="./ticket_soporte.php">
                                <div class="row">
                                    <div class="col-4 text-secondary">
                                        <i class="bi bi-list-ol" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <div class="col-8">
                                        N° de Tickets
                                        <h3><?php echo $numTickets; ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                        <a href="./ticket_soporte.php?ver=p">
                            <div class="row">
                                <div class="col-4 text-warning">
                                 <i class="bi bi-alarm" style="font-size: 2.5rem;"></i>
                                </div>
                                <div class="col-8">
                                    Pendientes
                                    <h3><?php echo $numTicketsPendientes ;?></h3>
                                </div>
                            </div>
                            </a>

                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                        <a href="./ticket_soporte.php?ver=e">
                            <div class="row">
                                <div class="col-4 text-info">
                                    <i class="bi bi-gear" style="font-size: 2.5rem;"></i>
                                </div>
                                <div class="col-8">
                                    En Proceso
                                    <h3><?php echo $numTicketsEnProceso ;?></h3>       
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                        <a href="./ticket_soporte.php?ver=t">
                            <div class="row">
                                <div class="col-4 text-success">
                                    <i class="bi bi-check2-circle" style="font-size: 2.5rem;"></i>
                                </div>
                                <div class="col-8">
                                    Terminados
                                    <h3><?php echo $numTicketsTerminados ;?></h3>
                                </div>
                            </div>
                            </a>
                            
                        </div>
                    </div>
                </div>



                <div class="seccion_soporte row pt-2 p-3">


<!------ Include the above in your HEAD tag ---------->

            
                <div class="row pt-3">
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
                    
                </div>
            

    <?php
        // Obtener el tipo
        $tipo = 'soporte';

        // Verificar si ?ver está presente en la URL
if (isset($_GET['ver'])) {
    $opcion = $_GET['ver'];

    // Realizar acciones según el valor de ?ver
    switch ($opcion) {
        case 'p':
            // Hacer algo cuando ver es 'p'
            $stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets
            WHERE tipo_ticket = ? AND estado_ticket='pendiente' ORDER BY fecha_ticket DESC");
            $stm->bind_param("s", $tipo);
            $stm->execute();
            $resultado = $stm->get_result();
            break;

        case 'e':
            // Hacer algo cuando ver es 'e'
            $stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets
            WHERE tipo_ticket = ? AND estado_ticket='en proceso' ORDER BY fecha_ticket DESC");
            $stm->bind_param("s", $tipo);
            $stm->execute();
            $resultado = $stm->get_result();
            break;

        case 't':
            // Hacer algo cuando ver es 't'
            $stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets
            WHERE tipo_ticket = ? AND estado_ticket='terminado' ORDER BY fecha_ticket DESC");
            $stm->bind_param("s", $tipo);
            $stm->execute();
            $resultado = $stm->get_result();
            break;

        default:
            // Hacer algo por defecto si ?ver tiene un valor no esperado
            echo 'Opción no válida';
            break;
    }
} else {
    // Hacer algo si ?ver no está presente en la URL
    $stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets
    WHERE tipo_ticket = ? ORDER BY fecha_ticket DESC");
    $stm->bind_param("s", $tipo);
    $stm->execute();
    $resultado = $stm->get_result();
}




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

                                <div class="col-4">
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
                                        echo '<label for="" class=" px-4 py-1 rounded-pill ">'. $row['tipo_ticket'] . '</label>';
                                    }
                                    elseif($row['tipo_ticket'] == 'toner'){
                                        echo '<label for="" class=" px-4 py-1 rounded-pill ">'. $row['tipo_ticket'] . '</label>';
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
                                    <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalVer<?php echo $row['id_ticket']; ?>">
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
                                            <div class="row">
                                                <form action="./actualizar_estado_ticket.php?page=2" method="post">
                                                    <input class="d-none" name="numero_ticket" type="text" value="<?php echo $row['numero_ticket']; ?> " >
                                                <div class="col-6">
                                                <label for="">Numero</label>
                                                    <h3><?php echo $row['numero_ticket']; ?></h3>
                                                </div>
                                                
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



 <!--/ contenido de la pagina -->

</body>
</html>

<script>
    $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>

<script>
    $(document).ready(function () {
            $('#sidebarCerrar').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>