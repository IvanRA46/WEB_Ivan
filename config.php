<?php
define("KEY_TOKEN", "APR.wqc-4658");
define("MONEDA", "$");
    session_start();

    $num_cart = 0;
    if(isset($_SESSION['carrito']['productos'])){
        $num_cart = count($_SESSION['carrito']['productos']);
        $nombre_usuario = $_SESSION['nombre_usuario'];
    }
?>