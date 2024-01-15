<?php 
    session_start();
    $nombre_usuario = $_SESSION['nombre_usuario'];
     
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'C:/xampp/htdocs/WEB_Ivan/phpmailer/src/PHPMailer.php';
    require 'C:/xampp/htdocs/WEB_Ivan/phpmailer/src/SMTP.php';
    require 'C:/xampp/htdocs/WEB_Ivan/phpmailer/src/Exception.php';

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
    $mail->addAddress('ivannoeramirezvivanco@gmail.com', 'Ivan Ramirez');    
  

    $mail->isHTML(true);                                  
    $mail->Subject = 'Detalles de su compra';
    $cuerpo = '<h4>Gracias por su compra: '.$nombre_usuario.'</<h4>';
    $mail->Body    = utf8_decode($cuerpo);
   

    $mail->setLanguage('es','C:/xampp/htdocs/WEB_Ivan/phpmailer.lang-es.php');

    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
    exit;   
}

?> 