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
                
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Tickets</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="./ticket_todos.php">Tickets Todos</a>
                        </li>
                        <li>
                            <a href="./ticket_soporte.php">Tickets Soporte</a>
                        </li>
                        <li>
                            <a href="./ticket_toner.php">Tickets Toner</a>
                        </li>
                    </ul>
                </li>

                <li class="active">                
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


<div class="container mt-5">
    
<h3>Contador</h3>
<!--
<div class="">
<?php
// Incluir archivo de conexión
include('../conexion/conexion.php');

// Consultar el último contador final de cada impresora
$sql = "SELECT i.id_impresora, i.marca, i.modelo, COALESCE(MAX(c.contador_final), 0) AS contador_final
        FROM impresora i
        LEFT JOIN contador_impresiones c ON i.id_impresora = c.id_impresora
        GROUP BY i.id_impresora, i.marca, i.modelo";

$result = $conn->query($sql);
?>
<div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-lg-3 col-md-3 col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['marca'] . ' - ' . $row['modelo'] ?></h5>
                        <p class="card-text">Contador: <?= $row['contador_final'] ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
        -->
<div class="card p-4 ">

    
        <form action="./guardar_contador.php" method="post">
            <div class="form-row">
                                
                <div class="form-group col-md-6">
                    <label for="id_impresora">Impresora</label>
                    <select name="id_impresora" class="form-select" required>
                        <option value="" >Selecciona una Impresora</option >
                            <?php
                                // Incluir archivo de conexión
                                //include ('../conexion/conexion.php');

                                // Consulta para obtener id_marca_imp y descripcion de la tabla marca_impresora
                                $sqlModelo = "SELECT id_impresora,marca, modelo FROM impresora";
                                $resultModelo = $conn->query($sqlModelo);

                                // Iterar a través de los resultados de la consulta
                                while ($rowModelo = $resultModelo->fetch_assoc()) {
                                                                    
                                echo "<option value='" . $rowModelo['id_impresora'] . "' >" .$rowModelo['marca']." - " . $rowModelo['modelo'] . "</option>";
                                }
                            ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="id_area">Área</label>
                    <?php
                        // Consultar la tabla area para obtener id_area y descripcion
                        $sqlArea = "SELECT id_area, descripcion FROM area";
                        $resultArea = $conn->query($sqlArea);
                    ?>

                    <select name="id_area" id="id_area" class="form-select" required>
                        <option value="">Seleccione el área</option>
                        <?php
                            // Iterar a través de los resultados de la consulta y crear opciones para el select
                            while ($rowArea = $resultArea->fetch_assoc()) {
                                echo "<option value='" . $rowArea['id_area'] . "'>" . $rowArea['descripcion'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

            </div>

            <div class="form-row">
                                
                <div class="form-group col-md-6">
                    <label for="">Sede</label>
                    <select name="id_sede" class="form-select" required>
                        <option value="" >Selecciona una Sede</option >
                            <?php
                                // Incluir archivo de conexión
                                //include ('../conexion/conexion.php');

                                // Consulta para obtener id_marca_imp y descripcion de la tabla marca_impresora
                                $sqlSede = "SELECT id_sede,descripcion FROM sede";
                                $resulSede = $conn->query($sqlSede);

                                // Iterar a través de los resultados de la consulta
                                while ($rowSede = $resulSede->fetch_assoc()) {
                                                                    
                                echo "<option value='" . $rowSede['id_sede'] . "' >" . $rowSede['descripcion'] . "</option>";
                                }
                            ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Ubicación</label>
                    <?php
                        // Consultar la tabla area para obtener id_area y descripcion
                        $sqlUbi = "SELECT id_ubicacion, descripcion FROM ubicacion";
                        $resultUbi = $conn->query($sqlUbi);
                    ?>

                    <select name="id_ubicacion" id="id_ubicacion" class="form-select" required>
                        <option value="">Seleccione una Ubicación</option>
                        <?php
                            // Iterar a través de los resultados de la consulta y crear opciones para el select
                            while ($rowUbi = $resultUbi->fetch_assoc()) {
                                echo "<option value='" . $rowUbi['id_ubicacion'] . "'>" . $rowUbi['descripcion'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fecha_final">Fecha Final</label>
                    <input type="date" class="form-control" id="fecha_final" name="fecha_final" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="contador_final">Contador Final</label>
                    <input type="text" class="form-control" id="contador_final" name="contador_final" required>
                </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary px-5">Guardar</button>
            </div>
        </div>

        </form>

        </div>

    </div>

            
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