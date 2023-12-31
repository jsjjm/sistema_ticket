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
                
                <li class="">
                    <a href="./tickets.php">Tikects</a>                    
                </li>   
                
                <li class="active">                
                    <a href="./contador.php">Contador</a>
                </li>

                <li >                
                    <a href="./area.php">Áreas</a>
                </li>

                <li>
                    <a href="./usuario.php">Usuarios</a>
                </li>


                <li class="">
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

                    <div class="col-md-4">
                        <a href="./descargar_contador.php" class="btn btn-success">Descargar excel</a>
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