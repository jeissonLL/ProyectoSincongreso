<?php

/**----ARCHIVO CON FUNCION DE LLENADO DE TODAS LOS chex QUE ACOMPAÑAN LOS FORMULARIOS DE INGRESOS----**/

require_once '../clases/class_base.php';
require '../funciones/funcion_traducir.php';
session_start();
switch ($_POST['funcion']) {
    
    case 'checkbox_certificado':   //OBED
        checkbox_certificado();
        break; 
}


function checkbox_certificado(){  //OBED   ////FALTA CONDICIONAR AL CONGRESO QUE ESTA ACTIVO Y AL ROL DEL USUARIO LOGEADO
     /*                                     /////QUE CARGUE SOLO LOS CORRESPONDIENTES
    global $bdd;
    $bdd = new basedatos(); */
    /*ALEXIS ESCOTO 
01/DICIEMBRE/2022
 * METODO PDO EN SELECT
 */
     $base = new basedatos();  

         $pdo = $base->abrir_conexion();  
    $html="";
    $t = 0;
    $roles = $_SESSION['roles'];
    $idrol = array_search('Autor', $roles);
    $idrolp = array_search('Ponente', $roles);
    $idrolad = array_search('Administrador', $roles);
    $datos=$pdo->query('select * from tbl_certificados a 
                        join tbl_usuario_firma_certificado b on a.id_certificado_pk=b.id_certificado_pk
                        join tbl_persona c on b.id_persona_pk=c.id_persona_pk
                        join tbl_usuario d on d.id_persona_fk=c.id_persona_pk
                        join tbl_usuario_congreso_roles e on d.id_usuario_pk = e.id_usuario_fk
                        join tbl_roles_congreso f on e.id_rol_congreso_fk = f.tbl_rol_congreso_pk
                        where f.id_congreso_fk='.$_SESSION['idcongreso'].' and d.id_usuario_pk='.$_SESSION['idusuario']); 
    
    if($idrol == "" && $idrolad == "" && $idrolp == ""){
        foreach ($datos as $fila) {  
            if($t == 0){
                $html.="<div class='checkbox checkbox-primary checkbox-circle'> <input  type='checkbox' value='".$fila['id_certificado_pk']."' id='idcertificado".$fila['id_certificado_pk']."' onclick='checkval(this.value,".$fila['id_certificado_pk'].");'><label for='idcertificado".$fila['id_certificado_pk']."'>".$fila['nombre_certificado']."</label></input></div>";
                $t = $fila['id_certificado_pk'];
            }else{
                if($t != $fila['id_certificado_pk']){
                    $html.="<div class='checkbox checkbox-primary checkbox-circle'> <input  type='checkbox' value='".$fila['id_certificado_pk']."' id='idcertificado".$fila['id_certificado_pk']."' onclick='checkval(this.value,".$fila['id_certificado_pk'].");'><label for='idcertificado".$fila['id_certificado_pk']."'>".$fila['nombre_certificado']."</label></input></div>";
                }
                $t = $fila['id_certificado_pk'];
            }
        }
    }else{
        $datos1=$pdo->query("select * from tbl_certificados a
join tbl_roles_congreso b on a.idrol_congreso=b.tbl_rol_congreso_pk
join tbl_roles c on b.id_rol_fk = c.id_rol_pk
where b.id_congreso_fk=".$_SESSION['idcongreso']." and c.nombre_rol like 'Participante'");
        $filas = $datos1;
        if($filas > 0){
           foreach ($datos1 as $fila) {  
                if($t == 0){
                    $html.="<div class='checkbox checkbox-primary checkbox-circle'> <input  type='checkbox' value='".$fila['id_certificado_pk']."' id='idcertificado".$fila['id_certificado_pk']."' onclick='checkval(this.value,".$fila['id_certificado_pk'].");'><label for='idcertificado".$fila['id_certificado_pk']."'>".$fila['nombre_certificado']."</label></input></div>";
                    $t = $fila['id_certificado_pk'];
                }else{
                    if($t != $fila['id_certificado_pk']){
                        $html.="<div class='checkbox checkbox-primary checkbox-circle'> <input  type='checkbox' value='".$fila['id_certificado_pk']."' id='idcertificado".$fila['id_certificado_pk']."' onclick='checkval(this.value,".$fila['id_certificado_pk'].");'><label for='idcertificado".$fila['id_certificado_pk']."'>".$fila['nombre_certificado']."</label></input></div>";
                    }
                    $t = $fila['id_certificado_pk'];
                }
            } 
        }
        
        $html .= "<br><hr size=5><br><label align='center'><b>@@mis_trabajos@@</b><br><hr size=5><br>";
        $query = $pdo->query("select * from tbl_usuario_trabajo a 
                join tbl_trabajo b on a.id_trabajo_fk = b.id_trabajo_pk
                where a.id_usuario_fk = '".$_SESSION['idusuario']."'");
        foreach ($query as $valor) {
            $html .= "<div class='checkbox checkbox-primary checkbox-circle' align='justify'> <input  type='checkbox' value='".$valor['id_trabajo_pk']."' id='idtrabajo".$valor['id_trabajo_pk']."' onclick='checkval1(this.value,".$valor['id_trabajo_pk'].");'><label for='idtrabajo".$valor['id_trabajo_pk']."'>".$valor['titulo_trabajo']."</label></input></div>";
        }
    }
    
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}
