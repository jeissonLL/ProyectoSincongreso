<?php


/* 
 * Funciones para generar en pdf los  certificados.
 * Autor: Obed Martínez
 * 28/02/17
 */
session_start();
require_once "../../../clases/class_base.php";
require_once '../fpdf/fpdf.php';
require_once  '../../../funciones/funcion_traducir.php';


$id_certificado = filter_input(INPUT_POST, "idcert");
$id_trabajo = filter_input(INPUT_POST, "idtrab");
global $bdd;
$bdd = new basedatos();   
if($id_certificado != 0){        
        $datos=$bdd->select("select * from tbl_certificados where id_certificado_pk='".$id_certificado."' "); 
        $array_c = array();   
        $array_d = array(); 
        $array_e = array(); 
        foreach ($datos as $fila) {        
        $array_c=array("id_certificado_pk" => $fila["id_certificado_pk"],
                        "nombre_certificado" => $fila["nombre_certificado"],
                        "encabezado_certificado" => $fila["encabezado_certificado"],
                        "motivo_certificado" => $fila["motivo_certificado"],
                        "pie_certificado" => $fila["pie_certificado"],
                        "url_arte" => $fila["url_arte"],
                        "certificado_especial" => $fila["certificado_especial"],
                        "nombre_persona" => $fila["nombre_persona"],
                    ); 

        }
        $datos1=$bdd->select("select * from tbl_usuario_firma_certificado a, tbl_persona b where a.id_certificado_pk='".$id_certificado."' and a.id_persona_pk=b.id_persona_pk "); 
        $array_d = array();
        $i=0;
        foreach ($datos1 as $fila1) {        
                $array_d["id_persona_pk".$i] = $fila1["identificacion"];
                $array_d["identificacion".$i] = $fila1["identificacion"];
                $array_d["primer_nombre".$i] = $fila1["primer_nombre"];
                $array_d["segundo_nombre".$i] = $fila1["segundo_nombre"];
                $array_d["primer_apellido".$i] = $fila1["primer_apellido"];
                $array_d["segundo_apellido".$i] = $fila1["segundo_apellido"];
                $array_d["url_firma".$i] = $fila1["url_firma"];  
                $i++;
        } 
        $n_firmas = array();
        $n_firmas["n_firmas"] = $i;
        $array_e = array_merge($array_c,$array_d,$n_firmas); 


        /*codigo esta precedido por la abreviación siguiente, su idusuario, idcertificado, el idcongreso*/
        $codparticipacion = "CERT";
        $bool = false;
        /*verifico que el codigo no exista en la base de datos*/     
        $codigo_cert = $codparticipacion.$_SESSION['idusuario']."-".$id_certificado."-".$_SESSION['idcongreso'];
        $data = $bdd->select("select * from tbl_certificados_usuario where codigo_certificado='".$codigo_cert."'");
        $filas = $data->num_rows;
        if($filas != 0){
           $bool = true;
        }

        /*construyo el certificado*/
        if ($bool == true) {
            foreach ($data as $val) { /*extraigo el codigo del certificado ya creado*/
                $pdf=new FPDF('L','mm','A4');
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',22);
                $pdf->Cell(55,75);
                $pdf->Image('../../../img/certificados/'.$array_e['url_arte'],0 ,0, 295 , 210 , 'JPG');            
                /*nombres de la persona a quien va dirigido el  certificado*/
                $data_persona = $bdd->select("select * from tbl_persona where id_persona_pk='".$_SESSION['idpersona']."'");
                foreach ($data_persona as $value) {
                    $pdf->Write(174,  utf8_decode(strtoupper($value['primer_nombre'].' '.$value['segundo_nombre'].' '.$value['primer_apellido'].' '.$value['segundo_apellido'])));
                }
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(75,50);
                $pdf->Write(1,$val['codigo_certificado']);
                $pdf->Output();
            }        
        }else{
            $pdf=new FPDF('L','mm','A4');
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',22);
            $pdf->Cell(55,75);
            $pdf->Image('../../../img/certificados/'.$array_e['url_arte'],0 ,0, 295 , 210 , 'JPG');
            /*nombres de la persona a quien va dirigido el  certificado*/
            $data_persona = $bdd->select("select * from tbl_persona where id_persona_pk='".$_SESSION['idpersona']."'");
            foreach ($data_persona as $value) {
                $pdf->Write(174,  utf8_decode(strtoupper($value['primer_nombre'].' '.$value['segundo_nombre'].' '.$value['primer_apellido'].' '.$value['segundo_apellido'])));
            }
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(75,50);
            $pdf->Write(1,$codigo_cert);
            $pdf->Output();

            $icod_cert = $bdd->insert("INSERT INTO tbl_certificados_usuario(id_usuario_fk, id_certificado_fk, codigo_certificado) "
                    . "values (?,?,?)","iis",[$_SESSION['idusuario'],  $id_certificado,  $codigo_cert],True);


        }
/*
 *  
 * Certificado de AUTOR DE Trabajos
 * 
 */    
}elseif ($id_trabajo != 0) {
        $roles = $_SESSION['roles'];
        $idrol = array_search("Autor", $roles);
        $idrolp = array_search("Ponente", $roles);
        $datos=$bdd->select("select * from tbl_certificados where idrol_congreso='".$idrol."' or idrol_congreso='".$idrolp."' "); 
        $array_c = array();   
        $array_d = array(); 
        $array_e = array(); 
        foreach ($datos as $fila) {        
        $array_c=array("id_certificado_pk" => $fila["id_certificado_pk"],
                        "nombre_certificado" => $fila["nombre_certificado"],
                        "encabezado_certificado" => $fila["encabezado_certificado"],
                        "motivo_certificado" => $fila["motivo_certificado"],
                        "pie_certificado" => $fila["pie_certificado"],
                        "url_arte" => $fila["url_arte"],
                        "certificado_especial" => $fila["certificado_especial"],
                        "nombre_persona" => $fila["nombre_persona"],
                    ); 

        }
        $datos1=$bdd->select("select * from tbl_usuario_firma_certificado a, tbl_persona b where a.id_certificado_pk='".$array_c['id_certificado_pk']."' and a.id_persona_pk=b.id_persona_pk "); 
        $array_d = array();
        $i=0;
        foreach ($datos1 as $fila1) {        
                $array_d["id_persona_pk".$i] = $fila1["identificacion"];
                $array_d["identificacion".$i] = $fila1["identificacion"];
                $array_d["primer_nombre".$i] = $fila1["primer_nombre"];
                $array_d["segundo_nombre".$i] = $fila1["segundo_nombre"];
                $array_d["primer_apellido".$i] = $fila1["primer_apellido"];
                $array_d["segundo_apellido".$i] = $fila1["segundo_apellido"];
                $array_d["url_firma".$i] = $fila1["url_firma"];  
                $i++;
        } 
        $n_firmas = array();
        $n_firmas["n_firmas"] = $i;
        $array_e = array_merge($array_c,$array_d,$n_firmas); 


        /*codigo esta precedido por la abreviación siguiente, su idusuario, idcertificado, el idcongreso*/
        $codparticipacion = "CERT";
        $bool = false;
        /*verifico que el codigo no exista en la base de datos*/     
        $codigo_cert = $codparticipacion.$_SESSION['idusuario']."-".$array_c['id_certificado_pk']."-".$_SESSION['idcongreso'];
        $data = $bdd->select("select * from tbl_certificados_usuario where codigo_certificado='".$codigo_cert."'");
        $filas = $data->num_rows;
        if($filas != 0){
           $bool = true;
        }

        /*construyo el certificado con el nombre del trabajo*/
        if ($bool == true) {
            foreach ($data as $val) { /*extraigo el codigo del certificado ya creado*/
                $pdf=new FPDF('L','mm','A4');
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(60,75);
                $pdf->Image('../../../img/certificados/'.$array_e['url_arte'],0 ,0, 295 , 210 , 'JPG');            
                
                $pdf->Cell(200,10);
                $pdf->Write(1,$val['codigo_certificado']);
                $pdf->SetFont('Arial','B',16);	
                $pdf->SetXY(15,100);
                /*nombres de la persona a quien va dirigido el  certificado*/
                $data_persona = $bdd->select("select * from tbl_persona where id_persona_pk='".$_SESSION['idpersona']."'");
                foreach ($data_persona as $value) {
                    $pdf->Cell(265,5,utf8_decode(strtoupper($value['primer_nombre'].' '.$value['segundo_nombre'].' '.$value['primer_apellido'].' '.$value['segundo_apellido'])),0,0,'C');
                }
                $pdf->SetFont('Arial','B',10); 
                $pdf->SetXY(11,117);
                /*nombres del trabajo para el certificado*/
                $data_trab = $bdd->select("select * from tbl_trabajo where id_trabajo_pk='".$id_trabajo."'");
                foreach ($data_trab as $value) {
                    $pdf->MultiCell(275,3,'"'.utf8_decode($value['titulo_trabajo']).'"',0,'C');  
                }
                $pdf->Output();
            }        
        }else{
            $pdf=new FPDF('L','mm','A4');
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(60,75);
            $pdf->Image('../../../img/certificados/'.$array_e['url_arte'],0 ,0, 295 , 210 , 'JPG');            

            $pdf->Cell(200,10);
            $pdf->Write(1,$codigo_cert);
            $pdf->SetFont('Arial','B',16);	
            $pdf->SetXY(15,100);
            /*nombres de la persona a quien va dirigido el  certificado*/
            $data_persona = $bdd->select("select * from tbl_persona where id_persona_pk='".$_SESSION['idpersona']."'");
            foreach ($data_persona as $value) {
                $pdf->Cell(265,5,utf8_decode(strtoupper($value['primer_nombre'].' '.$value['segundo_nombre'].' '.$value['primer_apellido'].' '.$value['segundo_apellido'])),0,0,'C');
            }
            $pdf->SetFont('Arial','B',10); 
            $pdf->SetXY(11,117);
            /*nombres del trabajo para el certificado*/
            $data_trab = $bdd->select("select * from tbl_trabajo where id_trabajo_pk='".$id_trabajo."'");
            foreach ($data_trab as $value) {
                $pdf->MultiCell(275,3,'"'.utf8_decode($value['titulo_trabajo']).'"',0,'C');  
            }
            $pdf->Output();

            $icod_cert = $bdd->insert("INSERT INTO tbl_certificados_usuario(id_usuario_fk, id_certificado_fk, codigo_certificado) "
                    . "values (?,?,?)","iis",[$_SESSION['idusuario'],  $array_c['id_certificado_pk'],  $codigo_cert],True);


        }
}else {
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <script language='JavaScript'>alert('Debe seleccionar una opción para proceder, Inténtelo nuevamente...!!!');
                window.close();
        </script>";
}






   