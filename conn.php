<?php
        $servername = "localhost";
        $database = "musicstore";
        $username = "root";
        $password = "";
    
        $con = mysqli_connect($servername, $username, $password, $database);
        
        if(!$con){
            die("Fallo la conexion". mysqli_connect_error());
        }else{
            
        }

?>