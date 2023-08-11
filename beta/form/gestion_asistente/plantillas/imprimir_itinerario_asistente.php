<?php
session_start();
require '../../../funciones/funcion_traducir.php';
require '../../../clases/class_base.php';

global $bdd;
$bdd = new basedatos();  
$idcongreso = $_SESSION['idcongreso'];
$idusuario= $_SESSION['idusuario'];
$idioma = $_SESSION['idioma'];
$html = "" ;
$html .= "<html>
    <head>
    <style type='text/css'>

    .container_12 {
        margin-left: 25px;
        margin-right: 25px;

    }
    @page {margin-top: 6.5em;}
    #header { position: fixed; left: 0px; top: -102px; right: 0px; height: 150px; background-repeat: no-repeat;background-image:url(../../../img/congresos/header.png) ;  text-align: justify; }
    .nopar{color: #4d4d4d ;}

        
    </style>

    </head>

    <body style='background-image:url(../../../img/congresos/listas_sistema_horizontal.jpg) ;'>

        <div id='header' >
        </div>
        <div id='content'>
    
        <table style='margin-top:10px;' width='100%' CELLPADDING='8' >
                    <tr >
                        <th width='3%' >@@num@@</th>
                         <th align= 'left' width='12%'>@@tipo_actividad@@ </th>
                         <th align= 'left' width='20%'>@@actividades@@</th>
                         <th align= 'left' width='9%'>@@fechatrab@@</th>
                         <th align= 'left' width='20%'>@@espacio@@</th>
                     </tr>

                 <tbody >";
                        $datos = $bdd->select('select * from tbl_usuario_actividad_congreso a
                            join tbl_actividad b on b.id_actividad_pk = a.id_actividad_fk
                            join tbl_tipo_actividad c on c.id_tipo_actividad_pk = b.id_tipo_actividad_fk
                            join tbl_espacio d on d.id_espacio_pk = b.id_espacio_pk
                            where a.id_congreso_fk ="'.$idcongreso.'"  and a.id_usuario_fk = "'.$idusuario.'" order by  nombre_tipo_actividad');
                        $num = 1 ;
                         
                        foreach ($datos as $fila) {
                            if($num%2==0){
                                $html .="<tr style='background: #f2f2f2;'> 
                                        <td style='color: #996633 ' >$num</td>
                                        <td>".$fila['nombre_tipo_actividad']."</td>
                                        <td>".$fila['nombre_actividad']."</td>
                                        <td>".$fila['fecha_actividad']."</td>
                                        <td>".$fila['nombre_espacio']."</td>
                                    </tr>" ;
                            }else{
                                $html .="<tr class='nopar' > 
                                        <td style='color: #996633 '>$num</td>
                                        <td>".$fila['nombre_tipo_actividad']."</td>
                                        <td >".$fila['nombre_actividad']."</td>
                                        <td >".$fila['fecha_actividad']."</td>
                                        <td >".$fila['nombre_espacio']."</td>
                                    </tr>" ;
                            }
                            
                            $num++;
                        }
                
        
        $html .="</tbody>";
        $html .="</table>
                </div>
            </div>
        </div>
      </div>
                                    
";
$html .= "</body > ";
$html .= " 
  </div>
  </body >
</html>
";
//echo $html;    
require_once("../../../dompdf/dompdf_config.inc.php");
$dompdf=new DOMPDF();
$html1 = traducirstring($html, '../../../idiomas/es/es.php');
  $dompdf->load_html(utf8_decode($html1));
  ini_set("memory_limit","40M");
  
  $dompdf->set_paper("letter","landscape"); /*TIPO DE LETRA Y FORMA FORMA VERTICAL*/
  $dompdf->render();
  $dompdf->stream('Listas_'.$nombre , array("Attachment" => 0)); /*NOMBRE DE ARCHIVO AL DESCARGAR*/

?>