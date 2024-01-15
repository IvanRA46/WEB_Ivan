<?php

include "conn.php";

$usuario = $_POST['name'];
$password = $_POST['pwd'];

$sql = mysqli_query($con, "SELECT * FROM usuario WHERE Nombre = '$usuario' AND Pwd = '$password'");
$sql2 = mysqli_query($con, "SELECT * FROM administrador WHERE Nombre = '$usuario' AND Pwd  = '$password'");

if($sql && mysqli_num_rows($sql) > 0){
    header('Location: http://localhost/web_ivan/Login.php');
}
else if ($sql2 && mysqli_num_rows($sql2) == 1){
    header('Location: http://localhost/web_ivan/tabla.php');
}
else{
    die("<br>Error en la conexión a la base de datos: " . mysqli_error($con));
}

session_start();
$_SESSION['nombre_usuario'] = $usuario;

?>