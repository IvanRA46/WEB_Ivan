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
            <li><a href="registro.php">Registro/Admin</a></li>
            <li><a href="bitacora.php">Bitacora</a></li>
            <li><a href="#">Salir</a></li>
        </ul>
    </nav>
    <h1>MusicStore</h1>
</header>
<body>
    <br>
    <div class="form2">
        <form action="register3.php" method="POST" enctype="multipart/form-data">
            <div class="contenedor">  
             <h2>Eliminar/Productos</h2>
             <br>
        <div class="hijo_admin">
            <label id="lbl" for="name">Nombre:</label><br>
            <input type="text" id="name" name="id">
        </div>
        <br>
        <div class="hijo">
            <button type="submit" class="btn_admin">Eliminar</button>
        </div>
    </div>
    </form>
    </div>
    <br>
</body>
<footer>
    <p>@Bryan Iván Noé Ramírez Vivanco<br><b>4°P | BD | WEB</b></p>
</footer>
</html>