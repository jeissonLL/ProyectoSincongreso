<?php

/* 
 * funciones formulario editor gestor 
 * @OBED
 */

require '../../../clases/class_base.php';
require '../../../funciones/funcion_traducir.php';

//print_r($_POST);
//print_r($_SESSION);
switch ($_POST['caso']) {
    
    case 'recordar_autoria':   //OBED
        recordar_autoria();
        break; 
    case 'enviar_trab_revision':   //OBED
        enviar_trab_revision();
        break;
    case 'rechazar_trab':   //OBED
        rechazar_trab();
        break;   
        
}
function recordar_autoria(){  
        session_start();
        $idt = filter_input(INPUT_POST, 'idt');  
        $idcongreso = $_SESSION['idcongreso']; 
        global $bdd;
        $bdd = new basedatos();   
        $datos=$bdd->select("select * from tbl_usuario_trabajo a, tbl_trabajo b, tbl_usuario c, tbl_persona d, tbl_correo e where  a.id_trabajo_fk=c.id_usuario_pk and d.id_persona_pk=c.id_persona_fk and  d.id_persona_pk=e.id_persona_fk and a.id_trabajo_fk=b.id_trabajo_pk and a.id_trabajo_fk='$idt'");  
        $cont_autor = 0;
        $enviomj = 0; 
        foreach ($datos as $fila) { 
            $correo = $fila['correo'];
            if($fila['correo'] != 0){               
                //enviamos el correo al usuario para validar su autoria
                $titulo="AUTORÍA DE TRABAJO";  
                $mensaje="<html>"; 
                $mensaje.="<p>";
                $mensaje.="UNIVERSIDAD NACIONAL AUTÓNOMA DE HONDURAS (UNAH).";
                $mensaje.="</p><BR>";
                $mensaje.="<p>";
                $mensaje.="INSTITUTO DE INVESTIGACIONES ECONÓMICAS Y SOCIALES (IIES).";
                $mensaje.="</p>";
                //$mensaje.="<title></title";
                $mensaje.="<body>";
                $mensaje.="<p>";
                $mensaje.="Estimado(a) Sr(a): ". strtoupper($fila['primer_nombre'])." ".strtoupper($fila['primer_apellido']);
                $mensaje.="</p><BR>";
                $mensaje.="<p>";
                
                $mensaje.="EL CONGRESO ".strtoupper($_SESSION['nombre_congreso'])."<br>Comunica a usted lo siguiente:<br><br>";                                               
                
                $mensaje.="Es requerido confirmar la(s) autoría(s) de su TRABAJO DE INVESTIGACIÓN:  <b>".  strtoupper($fila['titulo_trabajo'])."</b> subido al Congreso en la fecha:  ".$fila['fecha_subida'].", para poder enviarlo a <b>REVISIÓN</b>, caso contrario su trabajo será <b>RECHAZADO</b>.<br><br><br><b>Ingrese a la sección de GESTIÓN DE TRABAJOS y luego ACEPTAR AUTORÍAS.</b>"
                        . "<br><br>PARA DICHO PROCESO INGRESE A LA DIRECCIÓN:<br> <a href='http://ceat-unah.org/sistemas/gcongreso/beta/index.php' target='_blank'>AQUÍ</a>"
                        . "<br><br>";
                $mensaje.="</p>";
                $mensaje.="<p>";     
                $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
                $mensaje.="</p>";
                $mensaje.="</body>";
                $mensaje.="</html>";      
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                if( mail($correo, $titulo, $mensaje, $cabeceras)){
                    $enviomj = 1;
                } 
                $cont_autor += 1; 
            }
                        
        }
        if($enviomj == 1){
            echo 1;
        }else{
            echo 2;
        }
}
function enviar_trab_revision(){
    session_start();    
//    print_r($_POST);
//    print_r($_SESSION);
    $idt = filter_input(INPUT_POST, 'idt'); 
    $idtp = filter_input(INPUT_POST, 'idtp'); 
    $nombretrabajo = filter_input(INPUT_POST, 'nombret'); 
    $idt = filter_input(INPUT_POST, 'idt'); 
    $idcongreso = $_SESSION['idcongreso'];     
    global $bdd;
    $bdd = new basedatos();
    $cnt = 0;
    $autoria = $bdd->select("select * from tbl_usuario_trabajo where id_trabajo_fk=$idt");
    foreach ($autoria as $val) {
        if($val['autoria'] == 0){
            $cnt += 1;
        }
    }
    if($cnt > 0){                        
        echo '4';
    }else{
           $datos = $bdd->update("update tbl_trabajo set id_estado_fk=3 where id_trabajo_pk=?",'i',[$idt]);
            $url_trabajo_origen = "../../gestion_trabajos/trabajos/congreso$idcongreso"."/tipotrabajo".$idtp."/".$nombretrabajo;
            $url_trabajo_destino = "../../gestion_trabajos/trabajos/congreso$idcongreso"."/tipotrabajo".$idtp."/Revisiones/".$nombretrabajo;
            if($datos == 1){
                /*enviamos el trabajo de investigación a revisión*/ 
                if(!file_exists($url_trabajo_destino)){
                    copy($url_trabajo_origen, $url_trabajo_destino);
                    echo '1';
                }else{
                    echo '2';
                }

            }else{
                echo '3';
            }

    }
}

  function rechazar_trab(){
         session_start();    

        $idtp = filter_input(INPUT_POST, 'idtp'); 
        $nombretrabajo = filter_input(INPUT_POST, 'nombret'); 
        $idt = filter_input(INPUT_POST, 'idt'); 
        $idcongreso = $_SESSION['idcongreso'];     
        global $bdd;
        $bdd = new basedatos();        
        $autoria = $bdd->select("select * from tbl_trabajo where id_trabajo_pk=$idt");
        foreach ($autoria as $val) {
            //echo $val['id_estado_fk'];
            if($val['id_estado_fk'] != 2 && $val['id_estado_fk'] != 3){
                $datos = $bdd->update("update tbl_trabajo set id_estado_fk=2 where id_trabajo_pk=?",'i',[$idt]);
//                $url_trabajo_origen = "../../gestion_trabajos/trabajos/congreso$idcongreso"."/tipotrabajo".$idtp."/".$nombretrabajo;
                $url_trabajo_destino = "../../gestion_trabajos/trabajos/congreso$idcongreso"."/tipotrabajo".$idtp."/Revisiones/".$nombretrabajo;
                if($datos == 1){                    
                    /*elimino de la carpeta revisiones el trabajo*/
                    if (!empty($url_trabajo_destino)) {
                        unlink($url_trabajo_destino); 
                                /*traigo a los autores de este trabajo y les envio un correo*/


                            $congreso = $bdd->select("SELECT * FROM tbl_congreso where id_congreso_pk='".$idcongreso."'");  

                                $infotrabajo = $bdd->select("SELECT * FROM tbl_trabajo where id_trabajo_pk='".$idt."'");

                                foreach ($infotrabajo as $informacion) {
                                $titulotrabajo = "".strtoupper($informacion['titulo_trabajo'])."";                                               
                                }

                                $coautores = $bdd->select("Select * from  tbl_usuario_trabajo a
                                            join tbl_usuario b on b.id_usuario_pk = a.id_usuario_fk
                                            join tbl_persona c on c.id_persona_pk = b.id_persona_fk 
                                            join tbl_correo d on d.id_persona_fk = c.id_persona_pk 
                                            where d.principal = 1 and a.id_trabajo_fk ='".$idt."'");

                                foreach ($coautores as $correos) {

                                            $correoautores = $correos['correo'];

                                            /*enviamos el correo a los usuario involucrados con el trabajo */
                                            $titulo="DICTAMEN DE TRABAJO";  
                                            $mensaje="<html>"; 
                                            $mensaje.="<p>";
                                            $mensaje.="UNIVERSIDAD NACIONAL AUTÓNOMA DE HONDURAS (UNAH).";
                                            $mensaje.="</p><BR>";
                                            $mensaje.="<p>";
                                            $mensaje.="INSTITUTO DE INVESTIGACIONES ECONÓMICAS Y SOCIALES (IIES).";
                                            $mensaje.="</p>";
                                            //$mensaje.="<title></title";
                                            $mensaje.="<body>";
                                            $mensaje.="<p>";
                                            $mensaje.="Estimado(a)";
                                            $mensaje.="</p><BR>";
                                            $mensaje.="<p>";
                                            foreach ($congreso as $key) {
                                            $mensaje.="EL CONGRESO ".strtoupper($key['nombre_congreso'])."<br>Le Comunica a usted lo siguiente:<br><br>";                                               
                                            }
                                            $mensaje.=" Le comunica que su TRABAJO DE INVESTIGACIÓN ".strtoupper($titulotrabajo)." ha sido revisado y este ha sido RECHAZADO, es probable que usted no haya adjuntado un documento que cumpla con los requisitos mínimos para participar."
                                                    . "<br><br>Le invitamos a que vea es estado de su trabajo en:<br> <a href='http://ceat-unah.org/sistemas/gcongreso/beta/' target='_blank'><b>INGRESAR A LA PLATAFORMA</b></a>"
                                                    . "<br><br>";
                                            $mensaje.="</p>";
                                            $mensaje.="<p>";     
                                            $mensaje.="Reciba un saludo muy cordial, y gracias por participar en el Congreso.!!!";
                                            $mensaje.="</p>";
                                            $mensaje.="</body>";
                                            $mensaje.="</html>";      
                                            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                                            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                                            if( mail($correoautores, $titulo, $mensaje, $cabeceras)){
                                                $enviomj = 1;
                                            }
                                }

                        echo '1';
                    }else{
                        echo '2';
                    }

                }else{
                    echo '3';
                }
            }else{
                echo '4';
            }
        }
       
}
    
