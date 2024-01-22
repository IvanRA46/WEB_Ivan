<?php
require 'conn.php';
require 'config.php';
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    echo "<p style='color: white; font-size: 1.3em; background-color: #faa307; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;'>¡Bienvenido, $nombre_usuario! </p>";
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
    <?php
        include("conn.php");
    ?>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="registro.php">Registro</a></li>
            <li><a href="Login.php">Login</a></li>
            <li>
                <a href="checkout.php" id="carrito-link">
                    <div id="carrito">
                        <img class="basket" src="images/ELements/basket.png" alt="Carrito de compras">
                        <span id="num_cart"><?php echo $num_cart; ?></span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
    <h1>MusicStore</h1>
</header>
<body>
    <br>
    <br>
    <br>
    <br>
    <form action="loginus.php" method="POST" class="forml">
        <h2 class="login">Login</h2>
        <div>
            <label for="name" id="lbl"><b>Usuario:</b></label><br>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="name" id="lbl"><b>Contraseña:</b></label><br>
            <input type="password" id="pwd" name="pwd">
        </div>
            <br>
        <div class="boton">
            <button type="submit" id="btn">Iniciar</button>
        </div>  
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</body>
<footer>
    <p>@Bryan Iván Noé Ramírez Vivanco<br><b>4°P | BD | WEB</b></p>
</footer>
</html>