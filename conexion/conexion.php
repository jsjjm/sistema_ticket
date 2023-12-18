<?php

$servername = "localhost";
$username = "root"; // Reemplaza "tu_usuario" con tu nombre de usuario de MySQL
$password = ""; // Reemplaza "tu_contraseña" con tu contraseña de MySQL
$database = "sistema_ticket";
/*
$servername = "localhost";
$username = "id21620612_greackeu"; // Reemplaza "tu_usuario" con tu nombre de usuario de MySQL
$password = "Sistemas1."; // Reemplaza "tu_contraseña" con tu contraseña de MySQL
$database = "id21620612_sistema_ticket";
*/
// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    echo "La conexión falló: " . $conn->connect_error;
} else {
    //echo "Conexión exitosa a la base de datos";
}

// Cerrar la conexión
//$conn->close();
?>
