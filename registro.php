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
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="registro.php">Registrate</a></li>
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
    <div class="form">
        <form action="register.php" method="POST">
            <div class="contenedor">  
             <h2>Registro</h2>
        <div class="hijo">
            <label id="lbl" for="name">Nombre:</label><br>
            <input type="text" id="name" name="name">
        </div>
        <div class="hijo">
            <label id="lbl" for="name">Correo:</label><br>
            <input type="email" id="mail" name="mail">
        </div>
        <div class="hijo">
            <label id="lbl" for="name">Contraseña:</label><br>
            <input type="password" id="pwd" name="pwd">
        </div>
        <div class="hijo">
            <label id="lbl" for="name">Calle:</label><br>
            <input type="text" id="calle" name="calle">
        </div>
        <div class="hijo">
            <label id="lbl" for="name">Codigo: Postal:</label><br>
            <input type="text" id="cp" name="cp">
        </div>
        <div class="hijo">
            <label id="lbl" for="name">Ciudad:</label><br>
            <input type="text" id="city" name="city">
        </div>
        <div class="hijo">
            <label id="lbl" for="name">Estado:</label><br>
            <input type="text" id="estado" name="estado">
        </div>
        <div class="hijo">
            <label id="lbl" for="name">Numero (Cel):</label><br>
            <input type="text" id="cel" name="cel">
        </div>
        <br>
        <div class="hijo">
            <button type="submit">Registrar</button>
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