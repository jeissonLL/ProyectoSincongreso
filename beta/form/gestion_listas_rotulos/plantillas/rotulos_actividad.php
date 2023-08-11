<?php

/* 
 * Preview  de los rotulos 
 * Brayan Triminio
 * 30/07/17
 */
session_start();
require_once("../../../dompdf/dompdf_config.inc.php");
require '../../../funciones/funcion_traducir.php';
require '../../../clases/class_base.php';


global $bdd;
$bdd = new basedatos();  

$html = "";
$arractividades  =   (filter_input(INPUT_GET, 'actividad'));
$nombre = $_SESSION['nombre_congreso'];
$idcongreso = $_SESSION['idcongreso'];
$cont = 1 ;
$numero = 0 ;

$actividades =explode (',', $arractividades);
$aja = count($actividades);

for($i=0;$i<$aja;$i++){ 
    $datos1 =$bdd->select("select * from tbl_actividad a
            join tbl_espacio b on b.id_espacio_pk = a.id_tipo_actividad_fk
             join tbl_espacio_congreso c on c.id_espacio_fk = b.id_espacio_pk 
            where id_actividad_pk ='".$actividades[$i]."'  and c.id_congreso_fk = '".$idcongreso."'
        ");
}

$actividad = "";
$horainicio = "";
$horafinal ="";
$fechaactividad = "";
$espacio = "";

foreach($datos1 as $datognrls){
    $actividad  = $datognrls['nombre_actividad'];
    $horainicio = $datognrls['hora_inicio'];
    $horafinal  = $datognrls['hora_final'];
    $fechaactividad = $datognrls['fecha_actividad'];
    $mapa = $datognrls['mapa_espacio'];
    $espacio= $datognrls['nombre_espacio'];
}


$html.="<body >
       <div class='col-sm-12' >
                            <div >
                            <img src='../../../img/congresos/logo-unah.png' width ='25%'> 
                          <!--  <img src='../../../img/congresos/iies_logo.png' width ='25%' align='right'> -->
                            
                                <h3 >@@n_actividad@@:  <b>$actividad</b></h3>
                                <h4 >@@n_espacio@@: $espacio</h4>
                                <h4 ><b>@@fecha_inicio@@: $fechaactividad</b></h4>
                                <p >@@h_inicio@@: $horainicio  @@h_final@@: $horafinal </p> 
                                
                                <div >
                                    <div >
                                    <div >
                                      <!--  @@info@@-->
                                    </div><br>
                                                                                  
                                    </div>
                                    <div class='panel-body'>
                                             <table CELLPADDING='8'>
                                                <thead >
                                                <tr  >
                                                    <th width='5%' style='text-align:center; '>@@num@@</th>
                                                    <th width='35%'>@@nombre@@</th>
                                                    <th width='15%'>@@correo_principal@@</th>
                                                    <th width='15%' style='text-align: center;'>@@firma@@</th>
                                                </tr>
                                                </thead>
                                                <tbody >";
                                               
                                                for($i=0;$i<$aja;$i++){
                                                    $datos =$bdd->select("select * from tbl_actividad a
                                                                join tbl_espacio b on b.id_espacio_pk = a.id_espacio_pk
                                                                join tbl_espacio_congreso c on c.id_espacio_fk = b.id_espacio_pk
                                                                join tbl_tipo_actividad d on d.id_tipo_actividad_pk = a.id_tipo_actividad_fk
                                                                where a.id_actividad_pk = '".$actividades[$i]."'  and c.id_congreso_fk = '".$idcongreso."' 
                                                             ");  
                                                    
                                                        foreach($datos as $valor){
                                                            $id = $valor['id_actividad_pk'];
                                                            $nombreactividad=$valor['nombre_actividad'];
                                                            
                                                            $html .= "<tr><td style='text-align: left; color: #996633 ' >".$cont."</td>
                                                                        <td style='text-align: justify' >".$valor['nombre_tipo_actividad']."</td>
                                                                        <td style='text-align: justifys; color: #6666ff ; ' >".$nombreactividad."</td>
                                                                        <td style='text-align: left; ' >".$valor['nombre_espacio']."</td></tr>
                                                                        " ;
                                                                
                                                           $cont++;     
                                                        }  
                                                    
                                                         
                                                }
                                            $html .=" </tbody>
                                            
                                          </table><br>
                                          <!-- this is optional <img  src='../../gestion_programa/mapas_espacio/espacio.jpg' style='margin-left: 87px;' heigth='25%' width ='75%' > -->
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                                    
";
$html .= "</body > ";
$html1 = traducirstring($html, '../../../idiomas/es/es.php');
                                                       
$dompdf=new DOMPDF();
  $dompdf->load_html(utf8_decode($html1));
  ini_set("memory_limit","40M");
  $dompdf->set_paper("letter","portrait"); /*TIPO DE LETRA Y FORMA FORMA VERTICAL*/
  $dompdf->render();
  $dompdf->stream('Listas_'.$nombre , array("Attachment" => 0)); /*NOMBRE DE ARCHIVO AL DESCARGAR*/
?>
<div src='../../../img/congresos/fondo.jpg'>
                                            </div>

<img src="../../gestion_programa/mapas_espacio/espacio.jpg"><>
