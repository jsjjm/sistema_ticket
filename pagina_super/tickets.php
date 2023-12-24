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
            

                <li class="">
                    <a href="./inicio.php">Dashboard</a>                    
                </li>
                
                <li class="active">
                    <a href="./tickets.php">Tikects</a>                    
                </li>   
                
                <li class="">                
                    <a href="./contador.php">Contador</a>
                </li>

                <li class="">                
                    <a href="./area.php">Áreas</a>
                </li>

                <li>
                    <a href="./usuario.php">Usuarios</a>
                </li>

                <li>
                    <a href="./impresora.php">Impresoras</a>
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
                            <?php  ?>
                                
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- contenido de la pagina -->




<!-- /contenido de la pagina -->

<div class="seccion_soporte row pt-2 p-3">


<!------ Include the above in your HEAD tag ---------->

            <div class="container">

                <div class="row">
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
                        
                    <div class="col-md-4">
                            <a href="./descargar_ticket.php" class="btn btn-success mt-3">Descargar Excel</a>
                    </div>
                </div>
            
                <?php
    // Verificar si ?ver está presente en la URL
    if (isset($_GET['ver'])) {
        $opcion = $_GET['ver'];

        // Realizar acciones según el valor de ?ver
        switch ($opcion) {
            case 'p':
                // Hacer algo cuando ver es 'p'
                $stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets
                WHERE estado_ticket='pendiente'  ORDER BY fecha_ticket DESC");
                $stm->execute();
                $resultado = $stm->get_result();
                break;

            case 'e':
                // Hacer algo cuando ver es 'e'
                $stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets
                WHERE estado_ticket='en proceso'  ORDER BY fecha_ticket DESC");
                $stm->execute();
                $resultado = $stm->get_result();
                break;

            case 't':
                // Hacer algo cuando ver es 't'
                $stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets
                WHERE estado_ticket='terminado'  ORDER BY fecha_ticket DESC");
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
        $stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets  ORDER BY fecha_ticket DESC");
        $stm->execute();
        $resultado = $stm->get_result();
    }
    ?>
                
                <div class="row pt-3">
    <div class="card p-4 table-responsive">
                    <!-- Crear la tabla -->
                    <table class="table table-list-search">
                        <thead>
                            <tr>
                                <th>Ticket</th>
                                <th>Estado</th>
                                <th>Área</th>
                                <th>Solicitante</th>
                                <th>Tipo</th>
                                <th>Detalles</th>
                                <th>Ver</th>
                                <!-- Agrega más encabezados según tus necesidades -->
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // Iterar a través de los resultados y generar filas de la tabla
                            while ($row = $resultado->fetch_assoc()) {
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

                                    $sqlAreaU = "SELECT id_area,descripcion FROM area WHERE id_area=$id_areaUsuario";
                                    $resultAreaU = $conn->query($sqlAreaU);

                                    // Verificar si se encontraron resultados
                                    if ($rowAreaU = $resultAreaU->fetch_assoc()) {
                                        $areaUsuarioU = $rowAreaU['descripcion'];
                                    }
                                } else {
                                    //echo "No se encontró el usuario con el id " . $idUsuario;
                                }
                            ?>
                                <tr>
                                    <td><?php echo $row['numero_ticket']; ?></td>
                                    <td>
                                        <?php
                                        if ($row['estado_ticket'] == 'pendiente') {
                                            echo '<span class="bg-warning px-4 py-1 rounded-pill text-white">' . $row['estado_ticket'] . '</span>';
                                        } elseif ($row['estado_ticket'] == 'en proceso') {
                                            echo '<span class="bg-info px-4 py-1 rounded-pill text-white">proceso</span>';
                                        } elseif ($row['estado_ticket'] == 'terminado') {
                                            echo '<span class="bg-success px-4 py-1 rounded-pill text-white">' . $row['estado_ticket'] . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $areaUsuarioU; ?></td>
                                    <td><?php echo $row['nombre_solicitante']; ?></td>
                                    <td>
                                        <?php
                                        if ($row['tipo_ticket'] == 'soporte') {
                                            echo '<span class=" px-4 py-1 rounded-pill ">' . $row['tipo_ticket'] . '</span>';
                                        } elseif ($row['tipo_ticket'] == 'toner') {
                                            echo '<span class=" px-4 py-1 rounded-pill ">' . $row['tipo_ticket'] . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['detalle_ticket']; ?></td>
                                    <!-- Agrega más columnas según tus necesidades -->
                                    <td>
                                    
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
                                                        <form action="./actualizar_estado_ticket.php?page=1" method="post">
                                                            <div class="row">
                                                            
                                                                    <input class="d-none" name="numero_ticket" type="text" value="<?php echo $row['numero_ticket']; ?> " >
                                                                <div class="col-4">
                                                                    <label for="">Numero</label>
                                                                    <h3><?php echo $row['numero_ticket']; ?></h3>
                                                                </div>
                                                                
                                                                <div class="col-8">
                                                                    <label for="">Área </label>
                                                                    <h5 class="card-text"><?php echo $areaUsuarioU; ?></h5>
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
                                                
                                    </td>
                                </tr>

                            <?php } // Fin del bucle while ?>

                        </tbody>
                    </table>

                    </div>

</div>


                </div>

            </div>

</body>
</html>
<script>
    $(document).ready(function() {
    var activeSystemClass = $('.list-group-item.active');

    //something is entered in search form
    $('#system-search').keyup( function() {
       var that = this;
        // affect all table rows on in systems table
        var tableBody = $('.table-list-search tbody');
        var tableRowsClass = $('.table-list-search tbody tr');
        $('.search-sf').remove();
        tableRowsClass.each( function(i, val) {
        
            //Lower text for case insensitive
            var rowText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            if(inputText != '')
            {
                $('.search-query-sf').remove();
                tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Buscando: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
            }
            else
            {
                $('.search-query-sf').remove();
            }

            if( rowText.indexOf( inputText ) == -1 )
            {
                //hide rows
                tableRowsClass.eq(i).hide();
                
            }
            else
            {
                $('.search-sf').remove();
                tableRowsClass.eq(i).show();
            }
        });
        //all tr elements are hidden
        if(tableRowsClass.children(':visible').length == 0)
        {
            tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
        }
    });
});
</script>



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

<!-- Modal Sopoerte-->
<div class="modal fade" id="modalarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Áreas</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-3">
                                            <form action="./guardar_area.php" method="post">

                                                <div class="row">
                                                    <label for="">Nombre del Área</label>
                                                    <input type="text" class="form-control" name="area" required>
                                                </div>                                               

                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                                </div>