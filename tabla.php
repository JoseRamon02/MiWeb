<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Usuarios</title>
</head>
<body>
    <h2>Tabla de Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Edad</th>
            <th>Editar</th>
        </tr>

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

        // Consultar la tabla "usuarios"
        $consulta = "SELECT * FROM `usuarios`";

        $result = $conexion->query($consulta);

        if ($result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["id"] . "</td>";
                echo "<td>" . $fila["nombre"] . "</td>";
                echo "<td>" . $fila["email"] . "</td>";
                echo "<td>" . $fila["edad"] . "</td>";   
                echo "<td><a href='editar.php?id=" . $fila["id"] . "'>Editar</a></td>";             
                echo "</tr>";
            }
        } else {
            echo "<p>No se encontraron registros en la tabla 'usuarios'.</p>";
        }

        $conexion->close();
        ?>

    </table>

        <br><br>

        <a href="formulario.html">Dirigirse al formulario</a>

</body>
</html>
