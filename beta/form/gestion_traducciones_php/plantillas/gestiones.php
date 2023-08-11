<?php
require '../../../clases/class_base.php';
$base = new basedatos();
    $mensajes = $base->select("SELECT nombre_usuario, id_mensaje, asunto, contenido_mensaje, fecha, hora FROM tbl_usuario, tbl_mensaje WHERE id_usuario_pk = id_usuario_fk ORDER BY fecha DESC, hora DESC");
    foreach ($mensajes as $key => $value) {
    echo $value['contenido_mensaje']."<br>";
}
 ?>
