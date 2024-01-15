<?php 
include "conn.php";

$id = $_POST['id'];


$sql3 = mysqli_query($con, "DELETE FROM productos WHERE id = $id");

/*$sql2 = mysqli_query($con, "CREATE TRIGGER bitacora_producto_eliminar
AFTER DELETE ON productos
FOR EACH ROW
BEGIN
INSERT INTO bitacora_productos (Fecha, Sentencia, Contrasentencia)
VALUES (NOW(), 
        CONCAT('DELETE FROM productos WHERE id = ', OLD.id),
        CONCAT('INSERT INTO productos (nombre, precio, descripcion) VALUES (\'', OLD.nombre, '\', \'', OLD.precio, '\', ', OLD.descripcion, ');', OLD.id)
);
    IF ROW_COUNT() = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_producto';
    END IF;
END;
");
*/



if(!$sql3){
    echo "Hay un error";
}else{
    header('Location: http://localhost/web_ivan/productos.php');
}

?>