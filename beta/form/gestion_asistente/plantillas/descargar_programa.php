<?php

/* 
 * Descargar el programa  del congreso  
 * Brayan Triminio
 * 3/08/17
 */
session_start();
require_once("../../../dompdf/dompdf_config.inc.php");
require '../../../funciones/funcion_traducir.php';
require '../../../clases/class_base.php';


global $bdd;
$bdd = new basedatos();  
$idcongreso = $_SESSION['idcongreso'];
$html = "";

$datos = $bdd->select(" Select * from tbl_persona a 
            join tbl_usuario b on b.id_persona_fk = a.id_persona_pk
            join tbl_usuario_congreso_roles c on c.id_usuario_fk = b.id_usuario_pk
            join tbl_perfiles d on d.id_usuario_congreso_roles_fk = c.tbl_usuario_congreso_rol_pk
            join tbl_usuario_trabajo e on e.id_usuario_fk = c.id_usuario_fk
            join tbl_trabajo f on f.id_trabajo_pk = e.id_trabajo_fk
            join tbl_actividad_trabajo g on g.id_trabajo_fk = f.id_trabajo_pk
            join tbl_actividad h on h.id_actividad_pk = g.id_actividad_fk
            join tbl_tipo_actividad i on i.id_tipo_actividad_pk = h.id_tipo_actividad_fk
            join tbl_espacio j on j.id_espacio_pk = h.id_espacio_pk
            join tbl_persona_institucion k on k.id_persona_fk = a.id_persona_pk
            join tbl_institucion l on l.id_institucion_pk = k.id_institucion_fk
            join tbl_persona_titulo m on m.id_persona_fk = a.id_persona_pk
            join tbl_titulo n on n.id_titulo_pk  = m.id_titulo_fk
            join tbl_pais o on o.id_pais_pk = a.id_pais_fk
            where i.nombre_tipo_actividad like '%internacionales%' 
        ");

    foreach ($datos as $persona){
        $nombre_persona     =   $persona['primer_nombre']." ".$persona['segundo_nombre']." ".$persona['primer_apellido']." ".$persona['segundo_apellido'] ;
        $titulo             =   $persona['nombre_titulo'];
        $titulo_trabajo     =   $persona['titulo_trabajo'];
        $tipo_actividad     =   $persona['nombre_actividad'];
        $espacio_actividad  =   $persona['nombre_espacio'];
        $fecha_acti         =   $persona['fecha_actividad'];
        $hota_ini_acti      =   $persona['hora_inicio'];
        $hora_fina_acti     =   $persona['hora_final'];
        $resumen            =   $persona['resumen'];
        $perfil_persona     =   $persona['resumen_bibliografico'];
        $imagen             =   $persona['img_usuario'];
        $institucion        =   $persona['nombre_institucion'];
        $pais               = explode(";" , $persona['nombre_pais']);
        
        $hora = explode('-', $fecha_acti) ;
            $dia= date("l", mktime(0, 0, 0, $hora[1], $hora[2], $hora[0]));
            if($_SESSION['idioma']=="es"){
                $hora_in=date("g:i A",strtotime($hota_ini_acti));
                $hora_f=date("g:i A",strtotime($hora_fina_acti));
                $dias = array("Sunday" =>"Domingo","Monday" =>"Lunes","Tuesday"=>"Martes","Wednesday"=>"Miercoles","Thursday"=>"Jueves","Friday"=>"Viernes","Saturday"=>"Sábado");
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                $hora_dia =  $dias[$dia]." ".date($hora[2])." de ".$meses[date($hora[1]-1)]. " del ".date($hora[0]) .' / '.$hora_in.' - '.$hora_f.'<br> ';
            }
            
     
            $html.= "<style>
                    hr {display: block;height: 1px; border: 1px; border-top: 2px solid #ffb366;}
                    #titulo {width:385px;}
                    table {border-spacing: 10px; }
                    p {text-align: justify; font-size: 12pt}
                    #datos{line-height: 0.5em; font-size: 12pt}
                    footer { position: fixed; bottom: -60px; left: 0px; right: 0px;  height: 50px;font-size: 9pt; text-align:center; }
                </style>
             <body BACKGROUND=''>
                    <div class='col-sm-12' >

                            <table >
                                <thead >
                                <tr>
                                    <th  ><img src='../../../$imagen' width ='30%' height='40%'  /> </th>
                                    <th  width=70% colspan='4'><p id='datos'>$nombre_persona </p><p id='datos' style='color:#66a3ff ;'>$titulo</p><p id='datos' style='color:#66a3ff ;'>$institucion</p><hr id='titulo'><p id='datos' style='font-style: italic;' >$titulo_trabajo</p><p id='datos' style='font-weight: normal;'>$tipo_actividad</p><p id='datos' style='font-weight: normal;'>$espacio_actividad</p><p id='datos' style='font-weight: normal;'>$hora_dia<p>  </th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td><p> $pais[0] </p> </td>
                                    </t>
                                </tbody>
                                </thead>
                            </table>

                            <p>@@resumen_trabajo@@</p><hr >
                            <p>$resumen</p>
                            <p>@@perfil@@</p><hr >
                            <p>$perfil_persona</p>
                    </div>
                    <footer>@@footer@@</footer>
                <div style='page-break-after: always;'></div>
                </body >


        ";
    }

    
   
/*
$cont = 1 ;
$numero = 0 ;


$actxtipo = $bdd->select("select a.*, b.*, c.*, d.*, f.*, k.*, l.* from tbl_trabajo a  
                                    join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk 
                                    join tbl_tipo_trabajo c on a.id_tipo_trabajo_fk = c.id_tipo_trabajo_pk 
                                    join tbl_linea_investigacion d on b.id_linea_investigacion_fk = d.id_linea_investigacion_pk 
                                    join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_pk = e.id_linea_investigacion_pk 
                                    join tbl_usuario_trabajo f on a.id_trabajo_pk = f.id_trabajo_fk
                                    join tbl_usuario k on f.id_usuario_fk = k.id_usuario_pk
                                    join tbl_persona l on k.id_persona_fk = l.id_persona_pk
                                    where a.id_estado_fk='6' and e.id_congreso_pk='".$idcongreso."'  and f.autor_principal = '1' 
                                    group by a.titulo_trabajo order by a.titulo_trabajo asc"); 
        $filas = $actxtipo->num_rows;
        echo $filas;
        /*Extraemos las actividades (sesiones paralelas) creadas para esta tematica*/
        /*Actividades
        $datos1 = $bdd->select("select a.*, b.*, c.*, d.*, e.* from tbl_actividad a 
                                    join tbl_actividad_tematica b on a.id_actividad_pk = b.id_actividad_fk
                                    join tbl_congreso_actividad c on a.id_actividad_pk = c.id_actividad_fk
                                    join tbl_tipo_actividad d on a.id_tipo_actividad_fk = d.id_tipo_actividad_pk
                                    join tbl_espacio e on a.id_espacio_pk = e.id_espacio_pk 
                                    where  c.id_congreso_fk='".$idcongreso."' 
                                    group by a.fecha_actividad , a.hora_inicio order by a.fecha_actividad , a.hora_inicio asc");
         

        /*$datos1 = $bdd->select("select * from tbl_actividad ");
        $fechas_totales= $datos1->num_rows;
        echo $fechas_totales;
        $a= 0;
        foreach ($datos1 as $adra){
            $fecha_actividad[$a]= $adra['fecha_actividad'];
            $hora_inicio[$a] =$adra['hora_inicio'];
            $hora_final[$a] =$adra['hora_final'];
            $a++;
        }
        $i=0;
        while($i<($fechas_totales)){
            $hora = explode('-', $fecha_actividad[$i]) ;
            $dia= date("l", mktime(0, 0, 0, $hora[1], $hora[2], $hora[0]));
            if($_SESSION['idioma']=="es"){
                $dias = array("Sunday" =>"Domingo","Monday" =>"Lunes","Tuesday"=>"Martes","Wednesday"=>"Miercoles","Thursday"=>"Jueves","Friday"=>"Viernes","Saturday"=>"Sábado");
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                echo $dias[$dia]." ".date($hora[2])." de ".$meses[date($hora[1]-1)]. " del ".date($hora[0]) .', '.substr($hora_inicio[$i], 0, -3).' - '.substr($hora_final[$i], 0, -3) .'<br> ';
            }else if($_SESSION['idioma']=="en"){
                $meses = array("January","February","March","April","May","June","July","August","September","October","November","December");
                echo $dia." ".date($hora[2])." of ".$meses[date($hora[1]-1)]. " ".date($hora[0]).', '. substr($hora_inicio[$i], 0, -3).' - '.substr($hora_final[$i], 0, -3) .'<br> ';
            }
            $i++;
        }
        */
        
      
        

/*foreach ($actxtipo as $programa){
    $nombreprograma = $programa['nombre_programa'];
}
                                                          
$html.="<body BACKGROUND=''>
       <div class='col-sm-12' >
                            <div >
                             <!-- <img src='../../../img/congresos/listas_sistema.jpg' width ='25%'> 
                             <!--  <img src='../../../img/congresos/iies_logo.png' width ='25%' align='right'> -->
                            
                                <h3 >$nombreprograma </h3>
                                <h4 > </h4>
                                <p > </p> 
                                
                                <div >
                                    <div >
                                    <div >
                                      <!--  @@info@@-->
                                    </div><br>
                                                                                  
                                    </div>
                                    <div class='panel-body'>
                                             <table CELLPADDING='8'border='' >
                                                <thead >
                                                <tr  >
                                                    <th width='3%%' >@@num@@</th>
                                                    <th width='20%' align='left'>@@tipo_actividad@@ </th>
                                                    <th width='30%' align='left'>@@actividades@@</th>
                                                    <th width='15% 'align='center'>@@fechatrab@@</th>
                                                    <th width='23%' align='left'>@@espacio@@</th>
                                                </tr>
                                                </thead>
                                                <tbody >";
                                               
                                                $datos = $bdd->select('select * from tbl_tipo_actividad 
                                                        ');
                                                $num = 1 ;
                                                foreach ($datos as $fila) {
                                                  $idtpoactividad = $fila['id_tipo_actividad_pk'];
                                                  $tipoactividad  = $fila['nombre_tipo_actividad'];

                                                    $html .= "<tr class='gradeA'>
                                                        <td>".$num."</td>
                                                        <td align='justify'>".$tipoactividad."</td>
                                                       " ;

                                                    $actxtipo= $bdd->select('select a.*, c.id_programa_fk, d.nombre_programa, e.nombre_espacio  from tbl_actividad a 
                                                        join tbl_programa_actividad c on c.id_actividad_fk = a.id_actividad_pk
                                                        join tbl_programa d on d.id_programa_pk = c.id_programa_fk
                                                        join tbl_espacio e on e.id_espacio_pk = a.id_espacio_pk
                                                        join  tbl_espacio_congreso f on f.id_espacio_fk = e.id_espacio_pk
                                                        where f.id_congreso_fk ="'.$idcongreso.'" and a.id_tipo_actividad_fk = "'.$idtpoactividad.'"
                                                        ');
                                                    $resultado = $actxtipo->num_rows;
                                                    $actividades = '' ;
                                                    $fechas = '' ;
                                                    $espacios = '' ;

                                                    if($resultado > 0){
                                                        foreach ($actxtipo as $valores) { 
                                                            $idactividad = $valores['id_actividad_pk'];
                                                            $actividad   = $valores['nombre_actividad'];
                                                            $fecha       = $valores['fecha_actividad'];
                                                            $espacio     = $valores['nombre_espacio'];
                                                            $actividades .= "<li>" . $actividad . "</li>" . "<br>";
                                                            $fechas .= "<li>" . $fecha . "</li>" . "<br>";
                                                            $espacios .= "<li >" . $espacio . "</li>" . "<br>";


                                                        }
                                                    }else{
                                                        $actividades = '@@n_actividad@@' ;
                                                        $fechas = '@@n_fecha@@' ;
                                                        $espacios = '@@n_espacio@@' ;
                                                    } 
                                                    $html .= "<td style='text-align: justify' >".$actividades."</td>
                                                              <td style='text-align: center' >".$fechas."</td>
                                                              <td style='text-align: justify' >".$espacios."</td>
                                                               " ;

                                                $num++;
                                                }
                                                $num--;
                                                $html .= "<tr class='alert alert-success'></tr></tbody>";
                                                
                                            $html .=" </tbody>
                                          </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    
";*/
/*echo $html;*/
$html1 = traducirstring($html, '../../../idiomas/es/es.php');
                                                       
$dompdf=new DOMPDF();
  $dompdf->load_html(utf8_decode($html1));
  ini_set("memory_limit","40M");
  $dompdf->set_paper("letter","portrait"); /*TIPO DE LETRA Y FORMA FORMA VERTICAL*/
  $dompdf->render();
  $dompdf->stream('Listas_' , array("Attachment" => 0)); /*NOMBRE DE ARCHIVO AL DESCARGAR*/
?>

