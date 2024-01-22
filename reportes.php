<?php
    require 'database.php';
    require 'config.php';
    require 'conn.php';
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
    $sql1 = mysqli_query($con, "SELECT Correo FROM usuario WHERE Nombre = '$nombre_usuario'");
    $resultado = mysqli_fetch_assoc($sql1);
    $correo_usuario = $resultado['Correo'];
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
</head>
<style>
            *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Dosis', sans-serif;
        }

        body {
        font-family: 'Arial', sans-serif;
        background-color: #000;
        color: #fff;
        margin: 0;
        padding: 0;
        }

        header {
        background-color: #000;
        color: #fb5607; /* Dorado */
        text-align: center;
        padding: 20px;
        font-size: 24px;
        font-weight: bold;
        font-family: 'Gothic', sans-serif;
        }

        section {
        background-color: #000;
        color: #fff;
        font-family: 'Gothic', sans-serif;
        padding: 20px;
        margin: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }

        h2 {
        color: #fb5607; /* Dorado */
        border-bottom: 2px solid #ffd700; /* Línea dorada bajo el encabezado */
        padding-bottom: 10px;
        }

        ul {
        list-style-type: none;
        padding: 0;
        }

        li {
        margin-bottom: 10px;
        }

        span {
        font-weight: bold;
        }

        /* Estilo para los enlaces */
        a {
        color: #fb5607;
        text-decoration: none;
        border-bottom: 1px solid #fb5607;
        transition: border-bottom 0.3s;
        }

        a:hover {
        border-bottom: 2px solid #fb5607;
        }

        table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        }

        th, td {
        border: 1px solid #fff;
        padding: 10px;
        text-align: left;
        }

        th {
        background-color: #fb5607; /* Dorado */
        }

        tr:nth-child(even) {
        background-color: #333;
        }

        footer {
        background-color: #000;
        color: #fb5607; /* Dorado */
        text-align: center;
        padding: 20px;
        font-size: 16px;
        font-family: 'Gothic', sans-serif;
        }
</style>
<body>
    <header>
        <h1>MusicStore</h1>
    </header>

    <section>
        <h2>¡Gracias por su compra!</h2>
            <ul>
                <br>
                <li><span>Nombre:</span> <?php echo $nombre_usuario;?></li>
    </section>
    <table class="table">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Subtotal</th>
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
                        <?php echo $cantidad ?>  
                      </td>
                      <td>
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                      </td>
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
    <section>
            <p><p>¡Gracias por comprar en MusicStore! Cualquier duda o aclaración, comuníquese al No.: 3331783029.</p></p>
    </section>

    <footer></footer>


</body>
</html>
<?php 
    $html = ob_get_clean();
    require_once 'dompdf\autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    
    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled'=>true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');
    //$dompdf->setPaper('A4', 'landscape');
    
    $dompdf->render();

    //Para adjuntar el correo
    $pdfOutput = $dompdf->output();
    $pdfFile = 'Reporte.pdf';
    file_put_contents($pdfFile, $pdfOutput);
    
    $dompdf->stream("Reporte.pdf", array("Attachment"=>false));

?>

<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

$mail = new PHPMailer(true);

try {

$mail->SMTPDebug = SMTP::DEBUG_SERVER;                   
$mail->isSMTP();                                          
$mail->Host       = 'smtp.gmail.com';                   
$mail->SMTPAuth   = true;                                   
$mail->Username   = 'musicstoreoficialteam@gmail.com';                     
$mail->Password   = 'efouwvgdxxcmqqwm';                              
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


$mail->setFrom('musicstoreoficialteam@gmail.com', 'MusicStore');    
$mail->addAddress($correo_usuario, $nombre_usuario);    


$mail->isHTML(true);                                  
$mail->Subject = 'Detalles de su compra';
$mail->addAttachment($pdfFile, 'Reporte.pdf');
$cuerpo = '<h4>Gracias por su compra: '.$nombre_usuario.'</<h4>';
$mail->Body    = utf8_decode($cuerpo);

// Adjunta el PDF al correo
$mail->setLanguage('es','phpmailer.lang-es.php');

//Para que no muestre un chorro de texto sobre SMTP
$mail->SMTPDebug = SMTP::DEBUG_OFF;


$mail->send();

// Elimina el archivo PDF después de enviar el correo
//unlink($pdfFile);

} catch (Exception $e) {
echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
exit;   
}


?>