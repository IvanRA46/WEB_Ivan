<?php 
session_start();
$nombre_usuario = $_SESSION['nombre_usuario'];
echo "Bienvenido, $nombre_usuario"; 

// Incluye el archivo autoloader de DomPDF
require 'C:\xampp\htdocs\WEB_Ivan\dompdf\vendor\autoload.php';

// Crea una instancia de DomPDF
$dompdf = new Dompdf\Dompdf();


// Crea el contenido del PDF
$html ='<html>
<head><title>Ejemplo de PDF con DomPDF</title></head>
<body>
<h1>$nombre_usuario</h1>
<p>Este es un ejemplo de cómo generar un archivo PDF utilizando DomPDF.</p>
</body>
</html>';


// Carga el contenido HTML en DomPDF
$dompdf->loadHtml($html);

// Renderiza el PDF (puede ajustar el tamaño del papel y la orientación aquí)
$dompdf->setPaper('A4', 'portrait');

// Genera el PDF
$dompdf->render();

// Salva el PDF en un archivo o muestra en el navegador
$nombre_archivo = 'ejemplo.pdf';
$dompdf->stream($nombre_archivo);

?>