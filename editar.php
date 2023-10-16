<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <?php
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = "";
    $base_de_datos = "miweb";
    $id = '';
    // Crear una conexión
    $conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $id = $_GET["id"];

        // Obtener los datos del usuario que se quiere editar
        $consulta = "SELECT * FROM usuarios WHERE id = $id;";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
        } else {
            echo "Usuario no encontrado.";
            exit();
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        // Obtener los datos del formulario de edición
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $edad = $_POST["edad"];

        // Actualizar los datos del usuario en la base de datos
        $consulta = "UPDATE usuarios SET nombre='$nombre', email='$email', edad='$edad' WHERE id=$id;";

        if ($conexion->query($consulta) === true) {
            header("Location: tabla.php");
            exit(); // Asegurar que el script se detenga después de la redirección
        } else {
            echo "Error al actualizar usuario: " . $conexion->error;
        }
    }

    // Cerrar la conexión
    $conexion->close();
    ?>

    <h1>Editar Usuario</h1>

    <form action="editar.php" method="post">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $usuario['nombre']; ?>"><br>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $usuario['email']; ?>"><br>

        <label for="edad">Edad:</label>
        <input type="text" name="edad" id="edad" value="<?php echo $usuario['edad']; ?>"><br>

        <input type="submit" value="Guardar cambios">
    </form>

    <a href="tabla.php">Volver a la tabla de usuarios</a>
</body>
</html>