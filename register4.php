<?php 
include "conn.php";
$id = $_POST['id'];
$nombre = $_POST['name'];
$descripcion = $_POST['desc'];
$precio = $_POST['prec'];

$sql3 = mysqli_query($con, "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id=$id;");

/*$sql2 = mysqli_query($con, "CREATE TRIGGER bitacora_producto_actual
AFTER UPDATE ON productos
FOR EACH ROW
BEGIN
INSERT INTO bitacora_productos (Fecha, Sentencia, Contrasentencia)
VALUES (NOW(), 
        CONCAT('UPDATE productos SET nombre = \'',NEW.nombre, '\',precio = ',NEW.precio,'\',descripcion=\'',NEW.descripcion,'\';'),
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