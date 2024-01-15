<?php
require 'C:/xampp/htdocs/WEB_Ivan/conn.php';
session_start();
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    echo "<p style='color: white; font-size: 1.3em; background-color: #faa307; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;'> ¡Bienvenido, $nombre_usuario!";
} else {
    echo "<p style='color: white; font-size: 1.3em; background-color: #faa307; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;'> ¡Bienvenido!</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicStore</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<header>
    <nav>
        <ul>
            <li><a href="tabla.php">Productos</a></li>
            <li><a href="registro_admin.php">Registro</a></li>
            <li><a href="bitacora.php">Bitacora</a></li>
            <li><a href="index.php">Salir</a></li>
        </ul>
    </nav>
    <h1>MusicStore</h1>
</header>
<body>
<h2>Tabla de Productos</h2>
    <table class="body_table">
        <tr class="tabla_filas">
            <th class="tabla_col">ID</th>
            <th class="tabla_col">Nombre del Producto</th>
            <th class="tabla_col">Precio</th>
            <!-- Agrega más columnas según tu esquema de base de datos -->
        </tr>

        <?php
        // Consulta para obtener todos los registros de la tabla "productos"
        $sql = "SELECT * FROM productos";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos en la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>$" . $row["precio"] . "</td>";
                // Agrega más celdas según tu esquema de base de datos
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay productos</td></tr>";
        }
        ?>
    </table>
    <br>
    <ul class="u">
            <a class="btn_agregar" href="agregar.php">Agregar</a>
            <a class="btn_eliminar" href="eliminar.php">Eliminar</a>
            <a class="btn_modificar" href="modificar.php">Modificar</a>
    </ul>
</body>
<footer>
    <p>@Bryan Iván Noé Ramírez Vivanco<br><b>4°P | BD | WEB</b></p>
</footer>
</html>