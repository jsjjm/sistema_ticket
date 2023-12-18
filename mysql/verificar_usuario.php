<?php
session_start();
$usuario = $_POST['usuario'];
$contrasena = $_POST['password'];

// Incluir archivo de conexión
include ('../conexion/conexion.php');

// Consulta a la tabla "usuario"
$sql = "SELECT id_usuario, nombre_usuario, password, tipo,id_area FROM usuarios";
$result = $conn->query($sql);

$encontrado = false; // Variable para indicar si se encuentra una coincidencia

if ($result->num_rows > 0) {
    // Verificar los datos en la tabla
    while ($row = $result->fetch_assoc()) {
        // Verificar la coincidencia del nombre de usuario
        if ($row["nombre_usuario"] == $usuario) {
            // Verificar la coincidencia del hash de la contraseña
            if (hash('sha256', $contrasena) == $row["password"]) {
                $encontrado = true;

                $_SESSION['id_usuario'] = $row["id_usuario"];
                $_SESSION['nombre_usu'] = $row["nombre_usuario"];

                // Verificar el tipo de usuario
                $tipoUsuario = $row["tipo"];
                $_SESSION['tipo'] = $tipoUsuario;

                $_SESSION['id_area'] = $row["id_area"];
                
                break;
            }
        }
    }
}

// Redireccionar según el tipo de usuario
if ($encontrado) {
    if ($tipoUsuario == 'usuario') {
        // Si es un vendedor, redireccionar a la página de vendedor
        header("Location: ../pagina_usuario/inicio.php");
    } elseif ($tipoUsuario == 'soporte') {
        // Si es un administrador, redireccionar a la página de administrador
        header("Location: ../pagina_soporte/inicio.php");
    }elseif($tipoUsuario == 'super'){
        // Si es un Super usuario, redireccionar a la página de super usuario
        header("Location: ../pagina_super/inicio.php");
    }
    exit; // Es importante detener la ejecución del script después de redireccionar
} else {
    header("Location: ../login.php?usu=0");
}

// Cerrar la conexión
$conn->close();
?>
