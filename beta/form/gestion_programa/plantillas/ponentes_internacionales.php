<?php

/* 
 * Lista de Ponentes Internacionales 
 * Brayan Triminio 
 * 11/10/2017
 */

session_start();
require_once("../../../dompdf/dompdf_config.inc.php");
require '../../../funciones/funcion_traducir.php';
require '../../../clases/class_base.php';


global $bdd;
$bdd = new basedatos();  
$idcongreso = $_SESSION['idcongreso'];
$id_prgrama = $_GET['idprog'];

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
            join tbl_programa_actividad p on p.id_actividad_fk = h.id_actividad_pk
            where i.nombre_tipo_actividad like '%internacionales%' and p.id_programa_fk = $id_prgrama
        ");
       $contar = $datos->num_rows;
       if($contar > 0){
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
        $html1 = traducirstring($html, '../../../idiomas/es/es.php');
        $dompdf=new DOMPDF();
        $dompdf->load_html(utf8_decode($html1));
        ini_set("memory_limit","40M");
        $dompdf->set_paper("letter","portrait"); /*TIPO DE LETRA Y FORMA FORMA VERTICAL*/
        $dompdf->render();
        $dompdf->stream('Ponentes_Internacionales' , array("Attachment" => 0)); /*NOMBRE DE ARCHIVO AL DESCARGAR*/
    }else{
        $error = "<script language='javascript'>alert('@@error_p_inter@@');window.close();</script>";
        $html1 = traducirstring($error, '../../../idiomas/es/es.php');
        echo utf8_decode($html1);
    }
?>

