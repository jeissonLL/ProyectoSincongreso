<?php
require './clases/class_base.php';
$inicio = date("H:i:s");  
$bd = new basedatos();
 
$usuarios_respetidos = $bd->select('SELECT a.nombre_usuario, COUNT(*) AS cantidad
                                    FROM tbl_usuario a 
                                    GROUP BY a.nombre_usuario
                                    HAVING cantidad > 1
                                    ORDER BY cantidad DESC');
$html="<table>"
        . "<thead>"
        . "<th>Nombre_Usuario</th>"
        . "<th>Veces Repetidos</th>"
        . "</thead>"
        . "<tbody>";

$html2="<table>"
        . "<thead>"
        . "<th>ID Persona</th>"
        . "<th>ID Usuario</th>"
        . "<th>ID Correo</th>"
        . "<th>ID Telefono</th>"
        . "<th>Rol</th>"
        . "<th>Trabajos</th>"
        . "<th>B Correo</th>"
        . "<th>B Telefono</th>"
        . "<th>B Rol</th>"
        . "<th>B Usuario</th>"
        . "<th>B Persona</th>"                   
        . "</thead>"
        . "<tbody>";
foreach ($usuarios_respetidos as $usuario) 
    {
    $html.="<tr><td>".$usuario['nombre_usuario']."</td>"
            . "<td>".$usuario['cantidad']."</td><tr>";
    
    $datos_usuario = $bd->select('select a.id_persona_pk, b.id_usuario_pk,c.id_correo_pk, d.id_telefono_pk ,b.nombre_usuario from tbl_persona a
                                join tbl_usuario b on b.id_persona_fk=a.id_persona_pk
                                join tbl_correo c on c.id_persona_fk=b.id_persona_fk
                                join tbl_telefono d on d.id_persona_fk=b.id_persona_fk
                                where 1=1 and b.nombre_usuario="'.$usuario['nombre_usuario'].'"');

    $usuario_congreso_rol = $bd->select('select a.tbl_usuario_congreso_rol_pk from tbl_usuario_congreso_roles  a
                            where 1=1 and a.id_usuario_fk="'.$usuario['nombre_usuario'].'"');
    $cantidad = $bd->num_row();
    $trabajo_congreso = $bd->select('select a.id_usuario_pk, b.id_trabajo_fk from tbl_usuario a
                            join tbl_usuario_trabajo b on a.id_usuario_pk=b.id_usuario_fk
                            where a.nombre_usuario="'.$usuario['nombre_usuario'].'"');
    $cantidad_trabajos = $bd->num_row();
        foreach ($datos_usuario as $dusuario) 
        {
        $html2.="<tr><td>".$dusuario['id_persona_pk']."</td>"
                . "<td>".$dusuario['id_usuario_pk']."</td>"
                . "<td>".$dusuario['id_correo_pk']."</td>"
                . "<td>".$dusuario['id_telefono_pk']."</td>"
                . "<td>".$cantidad."</td>"
                . "<td>".$cantidad_trabajos."</td>";

        if($cantidad_trabajos==0)
        {
            $delete_correo = $bd ->delete('DELETE FROM tbl_correo WHERE 1 and id_correo_pk="'.$dusuario['id_correo_pk'].'"');
            $delete_telefono = $bd ->delete('DELETE FROM tbl_telefono WHERE 1 and id_telefono_pk="'.$dusuario['id_telefono_pk'].'"');
            $delete_usuario_congreso_roles = $bd ->delete('DELETE FROM tbl_usuario_congreso_roles WHERE 1 and id_usuario_fk="'.$dusuario['id_usuario_pk'].'"');
            $delete_persona = $bd ->delete('DELETE FROM tbl_persona WHERE 1 and id_persona_pk="'.$dusuario['id_persona_pk'].'"');
            $delete_usuario = $bd ->delete('DELETE FROM tbl_usuario WHERE 1 and id_usuario_pk="'.$dusuario['id_usuario_pk'].'"');
            $html2.= "<td>".$delete_correo."</td>"
                . "<td>".$delete_telefono."</td>"
                . "<td>".$delete_usuario_congreso_roles."</td>"
                . "<td>".$delete_persona."</td>"
                . "<td>".$delete_usuario."</td>";              
            
        }
            $html2.= "<tr>";        
        }
    
    
    
    
    
    }

echo $html.="</tbody></table>";
echo $html2.="</tbody></table>";
$fin = date("H:i:s");  
echo "se tardo".$fin-$inicio;

