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
<?php
include "conn.php";

$sql1 = mysqli_query($con, "SELECT ID, Fecha, Sentencia, Contrasentencia FROM bitacora_productos");

if ($sql1->num_rows > 0) {
    echo "<table border='1' class='tabla_bit'>    
            <tr class='tr_bit'>
                <th class='th_bit'>ID</th>
                <th class='th_bit'>Fecha</th>
                <th class='th_bit'>Sentencia</th>
                <th class='th_bit'>Contrasentencia</th>
            </tr>";

    while($row = $sql1->fetch_assoc()) {
        echo "<tr class='tr_bit'>
                <td class='td_bit'>" . $row["ID"] . "</td>
                <td class='td_bit'>" . $row["Fecha"] . "</td>
                <td class='td_bit'>" . $row["Sentencia"] . "</td>
                <td class='td_bit'>" . $row["Contrasentencia"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "0 resultados";
}
?>
    
</body>
</html>

