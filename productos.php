<?php
require 'database.php';
require 'config.php';
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    echo "<p style='color: white; font-size: 1.3em; background-color: #faa307; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;'>¡Bienvenido, $nombre_usuario! </p>";
} else {
    echo "<p style='color: white; font-size: 1.3em; background-color: #faa307; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;'> ¡Bienvenido!</p>";
}
$db = new Database();
$conn = $db->conectar();
$sql = $conn->prepare("SELECT id, nombre, precio, descripcion FROM productos");
$sql->execute();
$resultado = $sql->fetchall(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicStore</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="images/ELements/basket.png" type="image/png">    
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
    <ul id="lista-carrito">
    <!-- Aquí se mostrarán los productos agregados al carrito -->
    </ul>
    <h1>MusicStore</h1>
</header>
<body>
    <div class="cards">
        <?php
        foreach($resultado as $fila){
         
                $id = $fila['id'];  
                $imagen = "images/productos/$id/principal.jpg";
                if(!file_exists($imagen)){
                  $imagen = "images/no-photo.jpg";
                }
        ?>
                    <div class="card">
                    <img class="imagen-product" src="<?php echo $imagen; ?>">
                    <div class="titulo-product"><?php echo $fila['nombre']; ?></div>
                    <div class="descripcion-product"><?php echo $fila['descripcion']; ?></div>
                    <div class="precio">$<?php echo number_format($fila['precio'], 2, '.', ','); ?></div>
                    <button type="button" onclick="addProducto(<?php echo $fila['id']; ?>, '<?php echo hash_hmac('sha1', $fila['id'], KEY_TOKEN); ?>')">Agregar al carrito</button>
                    <br>
                    <br>
                </div>
        <?php
            
        }
        ?>
    </div>
    <script>
            function addProducto(id, token){
                let url='carrito.php'
                let formData = new FormData()
                formData.append('id', id)
                formData.append('token', token)
                fetch(url,{
                    method: 'POST',
                    body: formData,
                    mode: 'cors' 
                }).then(response => response.json())
                .then(data=>{
                    if(data.ok){
                        let elemento = document.getElementById("num_cart")
                        elemento.innerHTML = data.numero
                    }
                })
            }

        </script>
</body>
<footer>
    <p>@Bryan Iván Noé Ramírez Vivanco<br><b>4°P | BD | WEB</b></p>
</footer>
</html>