<?php 
include "conn.php";

$nombre = $_POST['name'];
$descripcion = $_POST['desc'];
$precio = $_POST['prec'];

$sql3 = mysqli_query($con, "INSERT INTO productos (nombre, precio, descripcion) VALUES ('$nombre', '$precio', '$descripcion');");

/*sql2 = mysqli_query($con, "CREATE TRIGGER bitacora_producto
AFTER INSERT ON productos
FOR EACH ROW
BEGIN
INSERT INTO bitacora_productos (Fecha, Sentencia, Contrasentencia)
VALUES (NOW(), 
        CONCAT('INSERT INTO productos (nombre, precio, descripcion) VALUES (\'', NEW.nombre, '\', \'', NEW.precio, '\', ', NEW.descripcion, ');'),
        CONCAT('DELETE FROM productos WHERE id = ', NEW.id)
);
    IF ROW_COUNT() = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_producto';
    END IF;
END;
");*/



if(!$sql3){
    echo "Hay un error";
}else{
    header('Location: http://localhost/web_ivan/productos.php');
}

?>