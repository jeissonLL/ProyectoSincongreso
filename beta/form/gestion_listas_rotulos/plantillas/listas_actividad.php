<?php

/* 
 * Preview  de las litas 
 * Brayan Triminio
 * 30/07/17
 */
session_start();
require_once("../../../dompdf/dompdf_config.inc.php");
require '../../../funciones/funcion_traducir.php';
require '../../../clases/class_base.php';


$base = new basedatos();  

$pdo = $base->abrir_conexion(); 

$html = "";
$arractividades  =   (filter_input(INPUT_GET, 'actividad'));
$nombre = $_SESSION['nombre_congreso'];
$idcongreso = $_SESSION['idcongreso'];
$cont = 1 ;
$numero = 0 ;

$actividades =explode (',', $arractividades);
$aja = count($actividades);

for($i=0;$i<$aja;$i++){ 
    $datos1 =$pdo->query("select * from tbl_actividad where id_actividad_pk='".$actividades[$i]."'
        ");
}

$actividad = "";
$horainicio = "";
$horafinal ="";
$fechaactividad = "";

foreach($datos1 as $datognrls){
    $actividad  = $datognrls['nombre_actividad'];
    $horainicio = $datognrls['hora_inicio'];
    $horafinal  = $datognrls['hora_final'];
    $fechaactividad = $datognrls['fecha_actividad'];
}

$html.="<body style='background-image:url(../../../img/congresos/listas_sistema1.jpg); height:75%;  '   >
       <div class='col-sm-12' >
                            <div >
                            <img > 
                            <br><br><br><br><br>
                                <h3 >@@n_actividad@@:  <b>$actividad</b></h3>
                               
                                <h4 ><b>@@fecha_inicio@@: $fechaactividad</b></h4>
                                <p >@@h_inicio@@ $horainicio  @@h_final@@ $horafinal </p> 
                                
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
                                                    $datos =$pdo->query("select * from tbl_actividad where id_actividad_pk='".$actividades[$i]."'  ");  
                                                    
                                                        foreach($datos as $valor){
                                                            $id = $valor['id_actividad_pk'];
                                                            $nombreactividad=$valor['nombre_actividad'];
      
                                                                $itinerarioxusuario = $pdo->query("select * from tbl_usuario_actividad_congreso a 
                                                                    join tbl_usuario b on b.id_usuario_pk = a.id_usuario_fk
                                                                    join tbl_persona c on c.id_persona_pk = b.id_persona_fk
                                                                    join tbl_correo d on d.id_persona_fk = c.id_persona_pk
                                                                    where a.id_actividad_fk ='".$id."' and d.principal = 1  
                                                                    ");
                                                                    $nombrecompleto = '' ;
                                                                    $contar = $itinerarioxusuario->fetch(PDO::FETCH_ASSOC) ;
                                                                    if ($contar == ""){
                                                                         $html .= "<tr><td ></td><td style='text-align: left; color: #996633 ' >@@no_personas@@</td> <tr>" ;
                                                                    }else{
                                                                        foreach ($itinerarioxusuario as $valor1){
                                                                                    $nombrecompleto = $valor1['primer_nombre']." ".$valor1['segundo_nombre']." ".$valor1['primer_apellido']." ".$valor1['segundo_apellido'];

                                                                                    if($cont%2==0){
                                                                                        $html .= "<tr  ><td style='text-align: left; color: #996633 ' >".$cont."</td>
                                                                                        <td style='text-align: justify;background: #f2f2f2; ' >".$nombrecompleto."</td>
                                                                                        <td style='text-align: justifys; color: #6666ff ;background: #f2f2f2 ' >".$valor1['correo']."</td>
                                                                                        <td style='text-align: left; ' >_____________________</td></tr>
                                                                                        " ;
                                                                                    }else{
                                                                                        $html .= "<tr><td style='text-align: left; color: #996633 ' >".$cont."</td>
                                                                                        <td style='text-align: justify' >".$nombrecompleto."</td>
                                                                                        <td style='text-align: justifys; color: #6666ff ; ' >".$valor1['correo']."</td>
                                                                                        <td style='text-align: left; ' >_____________________</td></tr>
                                                                                        " ;
                                                                                    }

                                                                                    $cont++;

                                                                                }
                                                                        }
                                                                
                                                        }  
                                                    
                                                         
                                                }
                                            $html .=" </tbody>
                                          </table>
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

