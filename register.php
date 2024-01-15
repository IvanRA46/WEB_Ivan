<?php
    include "conn.php";

        $nombre = $_POST['name'];
        $correo = $_POST['mail'];
        $pwd = $_POST['pwd'];
        $calle = $_POST['calle'];
        $cp = $_POST['cp'];
        $ciudad = $_POST['city'];
        $estado = $_POST['estado'];
        $cel = $_POST['cel'];
    
        $con = mysqli_connect($servername, $username, $password, $database);

        $sql = mysqli_query($con, "INSERT INTO usuario (ID, Nombre, Correo, Pwd, Calle, CP, Ciudad, Estado, Cel) VALUES(0, '$nombre', '$correo', '$pwd', '$calle', '$cp', '$ciudad', '$estado', '$cel' )");

        

        if(!$sql){
            echo "Hay un error";
        }else{
            header('Location: http://localhost/web_ivan/registro.php');
        }
?>