<?php 
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "miweb";

// Crear una conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// procesar.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $edad = $_POST["edad"];

    //Estas lineas las dejo como dato curioso.
    // Escapar los valores antes de la inserción (esto no es tan seguro como usar declaraciones preparadas, pero evita la inyección SQL)
    
    // $nombre = $conexion->real_escape_string($nombre);
    // $email = $conexion->real_escape_string($email);
    // $edad = $conexion->real_escape_string($edad);

    $consulta = "INSERT INTO usuarios (nombre, email, edad) VALUES ('$nombre', '$email', '$edad');";

    if ($conexion->query($consulta) === true) {
        echo "Registro insertado con éxito.";
    } else {
        echo "Error al insertar registro: " . $conexion->error;
    }
}

$conexion->close();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// $nombre = $_POST["nombre"];
// $email = $_POST["email"];

// $consulta = "INSERT INTO usuario (nombre, email) VALUES ('$nombre',
// '$email')";

// if ($conexion->query($consulta) === true) {
// echo "Registro insertado con �xito.";
// } else {
// echo "Error al insertar registro: " . $conexion->error;
// }


// }
?>



