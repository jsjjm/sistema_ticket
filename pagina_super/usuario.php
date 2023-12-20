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
                
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Tickets</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Tickets Todos</a>
                        </li>
                        <li>
                            <a href="#">Tickets Soporte</a>
                        </li>
                        <li>
                            <a href="#">Tickets Toner</a>
                        </li>
                    </ul>
                </li>

                <li >                
                    <a href="./area.php">Áreas</a>
                </li>

                <li class="active">
                    <a href="./usuario.php">Usuarios</a>
                </li>

                <li>
                    <a href="./impresora.php">Impresoras</a>
                </li>


                <li>
                    <a href="" data-toggle="modal" data-target="#ModalCerrarsesion">Cerrar Sesión</a>
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

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
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
                    <div class="col-6">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcrear">
                            Crear Usuario
                        </button>
                    </div>
                </div>

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
                    // Obtener el id_usuario
                    //$id_usuario = $_SESSION['idUsuario'];

                    // Consultar la tabla tickets
                    $stm = $conn->prepare("SELECT id_usuario, nombre_usuario,password, id_area, tipo FROM usuarios WHERE tipo <> 'super' ORDER BY fecha_registro ASC");
                    
                    $stm->execute();
                    $resultado = $stm->get_result();
                    ?>

<div class="row">
    <div class="card px-3 table-responsive">


                    <!-- Crear la tabla -->
                    <table class="table table-list-search">
                        <thead>
                            <tr>
                                <th class="d-none">ID Usuario</th>
                                <th>Nombre Usuario</th>
                                <th class="d-lg-none d-md-none">Tipo</th>
                                <th class="d-lg-none d-md-none">Editar</th>
                                <th>Password</th>
                                <th class="d-none">ID Área</th>
                                <th>Área</th>
                                <th class="d-none d-sm-table-cell">Tipo</th>
                                <th class="d-none d-sm-table-cell">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $resultado->fetch_assoc()) : ?>
                                <?php
                                // Consultar la tabla de áreas
                                $sql_areas = $conn->prepare("SELECT descripcion FROM area WHERE id_area = ?");
                                $sql_areas->bind_param("i", $row['id_area']);
                                $sql_areas->execute();
                                $result_areas = $sql_areas->get_result();
                                $area_descripcion = $result_areas->fetch_assoc()['descripcion'];
                                $sql_areas->close();
                                ?>
                                <tr>
                                    <td class="d-none"><?php echo $row['id_usuario']; ?></td>
                                    <td><?php echo $row['nombre_usuario']; ?></td>
                                    
                                    <td class="d-lg-none d-md-none"><?php echo $row['tipo']; ?></td>
                                    <td class="d-lg-none d-md-none">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modaleditar<?php echo $row['id_usuario']; ?>">
                                    <i class="bi bi-pencil-fill"></i>
                                    </button>    
                                    </td>

                                    <td><?php echo strlen($row['password']) > 10 ? substr($row['password'], 0, 10) . '...' : $row['password']; ?></td>
                                    <td class="d-none"><?php echo $row['id_area']; ?></td>
                                    <td><?php echo $area_descripcion; ?></td>
                                    <td class="d-none d-sm-table-cell"><?php echo $row['tipo']; ?></td>
                                    <td class="d-none d-sm-table-cell">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modaleditar<?php echo $row['id_usuario']; ?>">
                                    <i class="bi bi-pencil-fill"></i>
                                    </button>    
                                    </td>
                                    <!-- Modal editar usu-->
                                    <div class="modal fade" id="Modaleditar<?php echo $row['id_usuario']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuarios</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row p-3">
                                                <form id="register-form" action="../mysql/actualizar_usuario.php" method="post" role="form"  style="/*display: none;*/">
                                                    <div class="form-group">
                                                        <label for="">Nombre Usuario</label>
                                                        <input type="text" name="id_usuario" id="id_usuario" tabindex="1" class="form-control" placeholder="" value="<?php echo $row['id_usuario']; ?>"  hidden >
                                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php echo $row['nombre_usuario']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="">Tipo Usuario</label>
                                                        <select name="tipo" class="form-select">
                                                            <option value="usuario" <?php echo ($row['tipo'] == 'usuario') ? 'selected' : ''; ?>>Usuario</option>
                                                            <option value="soporte" <?php echo ($row['tipo'] == 'soporte') ? 'selected' : ''; ?>>Soporte</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="">Área Usuario</label>
                                                    <select name="id_area" id="id_area" class="form-select" required>                                                            
                                                            <option value="<?php echo $row['id_area']; ?>"><?php echo $area_descripcion; ?></option>

                                                            <?php
                                                            // Consultar la tabla area para obtener id_area y descripcion
                                                            $sqlAreao = "SELECT id_area, descripcion FROM area";
                                                            $resultAreao = $conn->query($sqlAreao);
                                                            ?>
                                                        
                                                                    <?php
                                                                    // Iterar a través de los resultados de la consulta y crear opciones para el select
                                                                    while ($rowAreao = $resultAreao->fetch_assoc()) {
                                                                        echo "<option value='" . $rowAreao['id_area'] . "'>" . $rowAreao['descripcion'] . "</option>";
                                                                    }
                                                                    ?>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Contraseña Usuario</label>
                                                        <input type="text" name="password" tabindex="2" class="form-control" placeholder="Password" value="<?php echo $row['password']; ?>" required>
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

                                </tr>
                            <?php endwhile; ?>
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

<!-- Modal crear usu-->
<div class="modal fade" id="modalcrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Usuarios</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-3">
                                        <form id="register-form" action="../mysql/registrar_usuario.php" method="post" role="form"  style="/*display: none;*/">
                                            <div class="form-group">
                                                <label for="">Nombre Usuario</label>
                                                <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
                                            </div>
                                            <div class="form-group">
                                            <label for="">Tipo Usuario</label>
                                                <select name="tipo" id="tipo" class="form-select" required>
                                                <option value="">Seleccione tipo</option>
                                                    <option value="usuario">Usuario</option>
                                                    <option value="soporte">Soporte</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            <label for="">Área Usuario</label>
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
                                            <div class="form-group">
                                            <label for="">Contraseña Usuario</label>
                                                <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
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