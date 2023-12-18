<?php
// Inicia la sesión si no está iniciada
session_start();

// Limpia todas las variables de sesión
$_SESSION = array();

// Destruye la sesión
session_destroy();

// Redirige al usuario a la página de inicio de sesión
header("Location: ../login.php");
exit(); // Asegura que el script se detenga después de redirigir
?>
