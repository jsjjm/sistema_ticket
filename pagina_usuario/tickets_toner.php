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
        <div class="col-lg-10 col-md-10 col-sm-8 col-8">
            Bienvenido <?php echo $nombre_usuario; ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-4">
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
            
                <div class="row px-2 pt-2">

                    <div class="col-md-6 col-sm-12 p-3 card ">
                        <div class="row">
                            <h2>Todos los Tickets</h2>
                        </div>

                        <div class="row">
                            
                            <div class="col-6">
                                <a href="./inicio.php" class="btn btn-success">Tickets</a>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 p-3 card">
                    <div class="row">
                        <h2>TONER</h2>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalToner">
                                Crear Ticket
                                </button>  

                            </div>
                           
                                                         
                        </div>
                        
                    </div>
                </div>
                
           
        </div>
    </div>

    <div class="seccion_soporte row pt-2 p-3">


<!------ Include the above in your HEAD tag ---------->

            <div class="container">
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
            </div>

    <?php
        // Obtener el id_usuario
        $tipo = 'toner';
        include ('../conexion/conexion.php');
        // Consultar la tabla tickets
        $stm = $conn->prepare("SELECT id_ticket, numero_ticket, nombre_solicitante, tipo_ticket, detalle_ticket,id_impresora, estado_ticket, fecha_ticket FROM tickets WHERE id_usuario = ? and tipo_ticket = ? ORDER BY fecha_ticket DESC");
        $stm->bind_param("ss", $id_usuario, $tipo);
        $stm->execute();
        $resultado = $stm->get_result();
        ?>

        <!-- Crear la tabla -->
        <table class="table table-list-search">
            <thead>
                <tr>
                   <!-- <th>ID Ticket</th>-->
                    <th>Ticket</th>
                    <th class="d-none d-md-table-cell">Solicitante</th>
                    <th class="d-none d-md-table-cell">Tipo</th>
                    <!--<th>Detalle del Ticket</th>-->
                    <th>Estado</th>
                    <th>Ver</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()) : ?>
                    <tr>
                        <!--<td><?php echo $row['id_ticket']; ?></td>-->
                        <td><?php echo $row['numero_ticket']; ?></td>
                        <td class="d-none d-md-table-cell"><?php echo $row['nombre_solicitante']; ?></td>
                        <td class="d-none d-md-table-cell">
                        <?php
                        if($row['tipo_ticket'] == 'soporte'){
                            echo '<label for="" class="bg-secondary px-2 rounded-pill text-white">'. $row['tipo_ticket'] . '</label>';
                         }
                         elseif($row['tipo_ticket'] == 'toner'){
                            echo '<label for="" class="bg-primary px-2 rounded-pill text-white">'. $row['tipo_ticket'] . '</label>';
                         }
                         ?>
                            
                        </td>
                        <!--<td><?php echo $row['detalle_ticket']; ?></td>-->

                        <td >
                        <?php
                         if($row['estado_ticket'] == 'pendiente'){
                            echo '<label for="" class="bg-warning px-2 rounded-pill text-white">'. $row['estado_ticket'] . '</label>';
                         }
                         elseif($row['estado_ticket'] == 'en proceso'){
                            echo '<label for="" class="bg-info px-2 rounded-pill text-white">'. $row['estado_ticket'] . '</label>';
                         }
                         elseif($row['estado_ticket'] == 'terminado'){
                            echo '<label for="" class="bg-success px-2 rounded-pill text-white">'. $row['estado_ticket'] . '</label>';
                         }
                         ?>
                            
                        </td>

                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVer<?php echo $row['id_ticket']; ?>">
                            <i class="bi bi-eye"></i>
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
                                        <div class="col-6">
                                        <label for="">Numero</label>
                                            <h3><?php echo $row['numero_ticket']; ?></h3>
                                        </div>
                                        <div class="col-6">
                                        <label for="">Estado</label>
                                        <?php
                                        if($row['estado_ticket'] == 'pendiente'){
                                            echo '<h5 for="" class="bg-warning px-4 py-1 rounded-pill text-white text-center">'. $row['estado_ticket'] . '</h5>';
                                        }
                                        elseif($row['estado_ticket'] == 'en proceso'){
                                            echo '<h5 for="" class="bg-info px-4 py-1 rounded-pill text-white">'. $row['estado_ticket'] . '</h5>';
                                        }
                                        elseif($row['estado_ticket'] == 'terminado'){
                                            echo '<h5 for="" class="bg-success px-4 py-1 rounded-pill text-white">'. $row['estado_ticket'] . '</h5>';
                                        }
                                        ?>
                                            
                                        </div>
                                        
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
                                </div>

                                </div>
                            </div>
                            </div>

                        </td>


                        <td>
                        <?php
                            // Supongamos que $row['fecha_ticket'] contiene la fecha en formato Y-m-d (por ejemplo, "2023-01-15")
                            $fecha_ticket = $row['fecha_ticket'];

                            // Formatear la fecha
                            //$fecha_formateada = date("d, M Y", strtotime($fecha_ticket));
                            $fecha_formateada = date("d-m-Y", strtotime($fecha_ticket));

                            // Mostrar la fecha formateada
                            echo "$fecha_formateada";
                            ?>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>




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


</div>


    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

 <!-- Modal Toner-->
 <div class="modal fade" id="modalToner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Ticket de Toner</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-3">
                                            <form action="./guardar_ticket.php" method="post">
                                                <div class="row">
                                                    <label for="">Tipo</label>
                                                    <select name="tipo" id="" class="form-select" required>
                                                    <option value="toner">Toner</option>
                                                       
                                                        
                                                    </select>
                                                </div>

                                                <div class="row pt-2">
                                                    <label for="">Impresora</label>
                                                
                                                    <div class="">
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
                                                    
                                                </div>

                                                <div class="row">
                                                    <label for="">Nombre Solicitante</label>
                                                    <input type="text" class="form-control" name="solicitante" required>
                                                </div>
                                                <div class="row">
                                                    <label for="">Detalle</label>
                                                    <textarea type="form-control" class="form-control"  name="detalle" required></textarea>
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


                                <!-- Modal Sopoerte-->
                                <div class="modal fade" id="modalSoporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Ticket de Soporte</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-3">
                                            <form action="./guardar_ticket.php" method="post">
                                                <div class="row">
                                                    <label for="">Tipo</label>
                                                    <select name="tipo" id="" class="form-select" required>
                                                        <option value="soporte">Soporte</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <label for="">Nombre Solicitante</label>
                                                    <input type="text" class="form-control" name="solicitante" required>
                                                </div>
                                                <div class="row">
                                                    <label for="">Detalle</label>
                                                    <textarea type="form-control" class="form-control"  name="detalle" required></textarea>
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