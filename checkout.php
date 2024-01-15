<?php
require 'C:/xampp/htdocs/WEB_Ivan/database.php';
require 'C:/xampp/htdocs/WEB_Ivan/config.php';
echo "<p style='color: white; font-size: 1.3em; background-color: #faa307; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;'>¡Bienvenido, $nombre_usuario! </p>";
$db = new Database();
$conn = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
$lista_carrito = array();
if($productos != null){
  foreach($productos as $clave => $cantidad){
    $sql = $conn->prepare("SELECT id, nombre, precio, descripcion, $cantidad AS cantidad   FROM productos WHERE id=?");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    
  }
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
            <li><a href="#">Salir</a></li>
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
<table class="table1">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if ($lista_carrito == null){
                    echo '<tr><td colspan="5" class="text-center"><b>Lista Vacia</b></td></tr>';
                  }else{
                    $total = 0;
                    foreach($lista_carrito as $producto){
                      $_id = $producto['id'];
                      $nombre = $producto['nombre'];
                      $precio = $producto['precio'];
                      $cantidad = $producto['cantidad'];
                      $subtotal = $cantidad * $precio;
                      $total += $subtotal;

                  ?>
                    <tr>
                      <td><b><?php echo $nombre; ?></b></td>
                      <td><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></td>
                      <td>
                        <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5" id="cantidad_<?php echo $_id; ?>" 
                        onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">  
                      </td>
                      <td>
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                      </td>
                      <td><button class="btn-elimina" onclick="eliminar(<?php echo $_id; ?>)" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</button></td>

                    </tr>

                  <?php } ?>
                  <tr>
                      <td colspan="3"><b>Total:</b></td>
                      <td colspan="2">
                        <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ',');  ?></p>
                      </td>

                  </tr>
              </tbody>
              <?php } ?>
            </table>
            <?php if ($lista_carrito != null){ ?>
        <div class="row">
                      <div class="col-md-5 offset-md-7 d-grid gap-2">
                        <button class="pago" onclick="redirigir()">Realizar pago</button>
                      </div>
        </div>

        <?php } ?>
</body>
<script>
            function actualizaCantidad(cantidad, id){
                let url='actualizar_carrito.php'
                let formData = new FormData() 
                formData.append('action', 'agregar')
                formData.append('id', id)
                formData.append('cantidad', cantidad)
                fetch(url,{
                    method: 'POST',
                    body: formData,
                    mode: 'cors' 
                }).then(response => response.json())
                .then(data=>{
                    if(data.ok){
                        let divsubtotal = document.getElementById('subtotal_'+id)
                        divsubtotal.innerHTML = data.sub

                      let total = 0.00
                      let list = document.getElementsByName('subtotal[]')
                      for(let i = 0; i< list.length; i++){
                        total += parseFloat(list[i].innerHTML.replace(/[$,]/g,''))
                      }
                      total = new Intl.NumberFormat('en-US', {
                        minimunFractionDigits: 2
                      }).format(total)
                      document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total
                    }
                })
            }

            function eliminar(id){
                let url='actualizar_carrito.php'
                let formData = new FormData() 
                formData.append('action', 'eliminar')
                formData.append('id', id)
                
                fetch(url,{
                    method: 'POST',
                    body: formData,
                    mode: 'cors' 
                }).then(response => response.json())
                .then(data=>{
                    if(data.ok){
                        location.reload()
                    }
                })
            }

            function redirigir() {
    // Cambia la URL a la que deseas redirigir
    window.location.href = 'reportes.php';
  }

        </script>
<footer>
    <p>@Bryan Iván Noé Ramírez Vivanco<br><b>4°P | BD | WEB</b></p>
</footer>
</html>