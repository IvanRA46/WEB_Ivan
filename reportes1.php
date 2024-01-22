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

<?php

    require_once 'fpdf/fpdf.php';

    class PDF extends FPDF
    {
        function Header()
        {
            $this->SetFillColor(0, 0, 0); // Fondo negro
            $this->SetFont('Arial', 'B', 20); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
            $this->Cell(45); // Movernos a la derecha
            $this->SetTextColor(255, 128, 0); //color
            $this->SetFont('Arial', 'B', 20);
            $this->Cell(0, 10, 'Gracias por su compra en: MusicStore!   ', 0, 1, 'C');
            $this->Ln(10);

        }

        function Footer()
        {
            $this->SetY(-25);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Gracias por la compra en MusicStore!', 0, 1, 'C');
            $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
            $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

            $this->SetFont('Arial', 'I', 8); 
            $hoy = date('d/m/Y');
            $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'R');
        }
    }

    $pdf = new PDF();
    $pdf->AddPage("landscape");
    $pdf->AliasNbPages();

    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Datos del usuario: ', 0, 1, 'L');
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Nombre: ' . $nombre_usuario, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Correo: ' . $correo_usuario, 0, 1, 'L');


    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(110, 10, 'Numero de orden: #' . 46589426  , 0, 1, 'L');

    $pdf->Ln(1);

    $pdf->SetFillColor(255, 128, 0) ; //colorFondo
    $pdf->SetTextColor(255, 255, 255); //colorTexto
    $pdf->SetDrawColor(163, 163, 163); //colorBorde
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(20, 10, utf8_decode('ID'), 1, 0, 'C', 1);
    $pdf->Cell(50, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
    $pdf->Cell(20, 10, utf8_decode('CANTIDAD'), 1, 0, 'C', 1);
    $pdf->Cell(30, 10, utf8_decode('PRECIO'), 1, 0, 'C', 1);
    $pdf->Cell(30, 10, utf8_decode('TOTAL'), 1, 1, 'C', 1); 
    if ($lista_carrito == null){
        echo '<tr><td colspan="5" class="text-center"><b>Lista Vacia</b></td></tr>';
      }else{
        $total = 0;
        foreach($lista_carrito as $producto){
          $pdf->SetFillColor(255, 255, 255); //colorFondo
          $pdf->SetTextColor(0, 0, 0); //colorTexto
          $pdf->SetDrawColor(163, 163, 163); //colorBorde
          $_id = $producto['id'];
          $nombre = $producto['nombre'];
          $precio = $producto['precio'];
          $cantidad = $producto['cantidad'];
          $subtotal = $cantidad * $precio;
          $total += $subtotal;
          $pdf->SetFont('Arial', '', 11);
          $pdf->Cell(20, 10, '' . $_id, 1, 0, 'C', 1);
          $pdf->Cell(50, 10, '' . $nombre, 1, 0, 'C', 1);
          $pdf->Cell(20, 10, '' . $cantidad, 1, 0, 'C', 1);
          $pdf->Cell(30, 10, 'MXN $' . $precio, 1, 0, 'C', 1);
          $pdf->Cell(30, 10, 'MXN $' . $total, 1, 0, 'C', 1);
          $pdf->Ln(10);
        }
    }
    

    $pdf->Ln(10);
    $pdf->SetFillColor(255, 128, 0); //colorFondo
    $pdf->SetTextColor(255, 255, 255); //colorTexto
    $pdf->SetDrawColor(163, 163, 163); //colorBorde
    $pdf->Cell(110, 10, 'TOTAL', 1, 1, 'C', 1);
    $pdf->SetTextColor(0, 0, 0); //colorTexto
    $pdf->Cell(110, 10, 'Total: MXN $' . $total, 1, 1, 'C');


    $pdf->Output('Ticket.pdf', 'F');
    // Configurar encabezados para mostrar el PDF en el navegador
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="Ticket.pdf"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize('Ticket.pdf'));
    readfile('Ticket.pdf');


    

?>


<?php 
$pdfFile = 'Ticket.pdf';
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
$mail->addAttachment($pdfFile);
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