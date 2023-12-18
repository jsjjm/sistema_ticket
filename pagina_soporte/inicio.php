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

    <title> <?php echo $nombre_usuario  ?></title>
</head>

<body>

    <style>       

        @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
        body {
            font-family: 'Poppins', sans-serif;
            /*background: #fafafa;*/
            background-color: #f0f0f0; /* Color de fondo del body */
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            font-weight: 300;
            line-height: 1.7em;
            color: #999;
        }

        a,
        a:hover,
        a:focus {
            color: inherit;
            text-decoration: none;
            transition: all 0.3s;
        }

        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 40px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar-btn {
            box-shadow: none;
            outline: none !important;
            border: none;
        }

        .line {
            width: 100%;
            height: 1px;
            border-bottom: 1px dashed #ddd;
            margin: 40px 0;
        }

        /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #7386D5;
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #6d7fcc;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }

        #sidebar ul li a:hover {
            color: #7386D5;
            background: #fff;
        }

        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            color: #6d7fcc;
            background: #ffff;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        ul ul a {
            font-size: 0.9em !important;
            padding-left: 30px !important;
            background: #6d7fcc;
        }

        ul.CTAs {
            padding: 20px;
        }

        ul.CTAs a {
            text-align: center;
            font-size: 0.9em !important;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        a.download {
            background: #fff;
            color: #7386D5;
        }

        a.article,
        a.article:hover {
            background: #6d7fcc !important;
            color: #fff !important;
        }

        /* ---------------------------------------------------
            CONTENT STYLE
        ----------------------------------------------------- */

        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* ---------------------------------------------------
            MEDIAQUERIES
        ----------------------------------------------------- */

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #sidebarCollapse span {
                display: none;
            }
        }
    </style>



    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Bootstrap Sidebar</h3>
            </div>

            <ul class="list-unstyled components">
            

                <li class="active">
                    <a href="./inicio.php">Dashboard</a>                    
                </li>
                
                <li >
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

                <li >                
                    <a href="./contador.php">Contador</a>
                </li>

                


                <li>
                    <a href="" id="sidebarCerrar" data-toggle="modal" data-target="#ModalCerrarsesion" >Cerrar Sesión</a>
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
                

            <h3>Dashboard</h3>

        <div class="col-md-12 col-sm-12 card p-4">
            
                <h3>Tickets</h3>

                <div class="row pt-2">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                            <a href="./ticket_todos.php">
                                <div class="row">
                                    <div class="col-4 text-secondary">
                                        <i class="bi bi-list-ol" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <div class="col-8">
                                        N° Tickets
                                        <h3><?php echo $numTickets; ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2">
                            <a href="./ticket_todos.php?ver=p">
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
                            <a href="./ticket_todos.php?ver=e">
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
                            <a href="./ticket_todos.php?ver=t">
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

            
                
           
        </div>
    </div>

    <div class="row">
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Tickets
        </a>

    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">

        <?php
// Obtener el id_usuario
//$id_usuario = $_SESSION['idUsuario'];
// include ('../conexion/conexion.php');
// Consultar la tabla tickets
$stm = $conn->prepare("SELECT id_ticket, numero_ticket,id_usuario, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets /*WHERE id_usuario = ?*/ ORDER BY fecha_ticket DESC");
//$stm->bind_param("s", $id_usuario);
$stm->execute();
$resultado = $stm->get_result();
?>

<!-- Crear la tabla -->
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ticket</th>
                    <th>Estado</th>
                    <th>Área</th>
                    <th>De</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
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
                                echo '<span class="badge bg-warning text-white">' . $row['estado_ticket'] . '</span>';
                            } elseif ($row['estado_ticket'] == 'en proceso') {
                                echo '<span class="badge bg-info text-white">' . $row['estado_ticket'] . '</span>';
                            } elseif ($row['estado_ticket'] == 'terminado') {
                                echo '<span class="badge bg-success text-white">' . $row['estado_ticket'] . '</span>';
                            }
                            ?>
                        </td>
                        <td><?php echo $areaUsuarioU; ?></td>
                        <td><?php echo $row['nombre_solicitante']; ?></td>
                        <td>
                            <?php
                            if ($row['tipo_ticket'] == 'soporte') {
                                echo '<span class="badge bg-secondary">' . $row['tipo_ticket'] . '</span>';
                            } elseif ($row['tipo_ticket'] == 'toner') {
                                echo '<span class="badge bg-primary">' . $row['tipo_ticket'] . '</span>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
        

    </div>
    </div>





<!--
    <div class="row pt-3">
        <div class="card p-4">
            <h3>Contador</h3>
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
    </div>

                    -->

<?php
// Incluir archivo de conexión
//include('../conexion/conexion.php');

// Consulta SQL
$sql = "SELECT 
            i.id_impresora, 
            i.marca, 
            i.modelo, 
            a.id_area, 
            a.descripcion, 
            SUM(c.contador_final) AS contador
        FROM 
            contador_impresiones c
        JOIN 
            impresora i ON c.id_impresora = i.id_impresora
        JOIN 
            area a ON c.id_area = a.id_area
        GROUP BY 
            c.id_impresora, 
            c.id_area
        ORDER BY 
            i.marca, 
            i.modelo, 
            a.descripcion";

$result = $conn->query($sql);

// Almacenar los resultados en un array para luego usarlo en HTML
$data = array();

// Verificar si la consulta fue exitosa
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "Error al obtener los datos: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>

<div class="row pt-3">
    <div class="card p-4 table-responsive">
<h3>Contador</h3>

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

        <table class="table table-list-search w-100">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Impresora</th>                    
                    <th>Contador</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['descripcion'] ?></td>
                        <td><?= $row['marca'] .' - '.$row['modelo'] ?> </td>

                        <td><?= $row['contador'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>




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

