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
    <div class="flex">
        <div class="espacio">
            <h2>Misión</h2>
            <br>
            <p class="sub">Nuestra misión en <b>MusicStore</b> es brindar a nuestros clientes una experiencia única y enriquecedora de la música. Nos esforzamos por ser un destino de elección para los amantes de la música, ofreciendo una amplia selección de discos de vinilo, CD y otros formatos, así como una cuidadosa curación de música de todos los géneros. Nos comprometemos a proporcionar un servicio excepcional y una atención personalizada para ayudar a nuestros clientes a encontrar la música que aman. También promovemos la preservación de la cultura musical a través de la venta de música física y el fomento de la comunidad musical local.</p>
            <img class="imagen" src="images/inicio/mision.png" alt="Mision">
        </div>
        <div class="espacio">
            <h2>Visión</h2>
            <br>
            <p class="sub">Nuestra visión en <b>MusicStore</b> es ser reconocidos como el destino de referencia para los apasionados de la música en nuestra comunidad y más allá. Buscamos convertirnos en un centro cultural que celebre la diversidad musical y apoye a artistas locales y emergentes. Queremos expandir nuestra presencia en línea para llegar a una audiencia global de amantes de la música y seguir siendo una fuente confiable de música de alta calidad en formato físico y digital. Aspiramos a seguir evolucionando con la industria de la música y las necesidades cambiantes de nuestros clientes, manteniendo siempre nuestro compromiso con la autenticidad y la pasión por la música.</p>
            <img class="imagen"src="images/inicio/musica.png" alt="Vision">
        </div>
        <div class="espacio">
            <h2>Acerca de...</h2>
            <br>    
            <p class="sub"><b>MusicStore</b> se fundó en 2021 con la visión de crear un espacio donde la música sea más que solo sonidos: es una experiencia que une a las personas, despierta emociones y crea recuerdos duraderos. Durante 2 años, hemos servido a nuestra comunidad como un destino de confianza para descubrir, comprar y disfrutar de música en una variedad de formatos. Nos enorgullecemos de ofrecer una selección cuidadosamente curada de música que abarca géneros y épocas, desde clásicos atemporales hasta las últimas tendencias. Nuestro equipo apasionado y conocedor está dedicado a ayudarte a encontrar la música perfecta para cada ocasión.</p>
            <img class="imagen" src="images/inicio/vinilo.png" alt="Acerca de">
        </div>
    </div>
    
</body>
<footer>
    <p>@Bryan Iván Noé Ramírez Vivanco<br><b>4°P | BD | WEB</b></p>
</footer>
</html>