<?php

/* 
 * @Autor: Obed Martinez
 * @Fecha: 15/11/2017
 * @Descripción: Programa Resumen del congreso 
 */

session_start();
require_once("../../../dompdf/dompdf_config.inc.php");
require '../../../funciones/funcion_traducir.php';
require '../../../clases/class_base.php';

global $bdd;
$bdd = new basedatos();  
$idcongreso = $_SESSION['idcongreso'];
$idprog = $_GET['idprog'];

$html = "";

/*Actividades*/
    $datos = $bdd->select("select * from tbl_actividad a                                     
                                join tbl_congreso_actividad c on a.id_actividad_pk = c.id_actividad_fk
                                join tbl_congreso b on c.id_congreso_fk=b.id_congreso_pk
                                join tbl_tipo_actividad d on a.id_tipo_actividad_fk = d.id_tipo_actividad_pk
                                join tbl_espacio e on a.id_espacio_pk = e.id_espacio_pk                                   
                                where c.id_congreso_fk='".$idcongreso."'
                                group by a.fecha_actividad , a.hora_inicio order by a.fecha_actividad , a.hora_inicio asc");
    $filas = $datos->num_rows;
    foreach ($datos as $val) {
        $nombre_congreso = $val['nombre_congreso'] ." (". $val['siglas'].")";
        $lugar = strtoupper($val['lugar']);
        $lema = $val['lema'];
        setlocale(LC_ALL,'Spanish_Honduras');
        $newfi = strftime('%A %d de %B',strtotime($val['fecha_inicio']));
        $newfi = ucfirst(iconv("ISO-8859-1","UTF-8",$newfi));
        $newff = strftime('%A %d de %B del %Y',strtotime($val['fecha_finalizacion']));
        $newff = ucfirst(iconv("ISO-8859-1","UTF-8",$newff));
        
        
        $fecha = $newfi." - ".$newff;
    }
    if($filas > 0){
        $html.= "<style>
                        table.blueTable {
                                border: 1px solid #1C6EA4;
                                background-color: #AECDEE;
                                width: 100%;
                                text-align: left;
                                border-collapse: collapse;
                              }
                              table.blueTable td, table.blueTable th {
                                border: 1px solid #AAAAAA;
                                padding: 3px 2px;
                              }
                              table.blueTable tbody td {
                                font-size: 15px;
                              }
                              table.blueTable tr:nth-child(even) {
                                background: #D0E4F5;
                              }
                              table.blueTable thead {
                                background: #1C6EA4;
                                background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
                                background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
                                background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
                                border-bottom: 2px solid #444444;
                              }
                              table.blueTable thead th {
                                font-size: 15px;
                                font-weight: bold;
                                color: #000000;
                                border-left: 2px solid #D0E4F5;
                              }
                              table.blueTable thead th:first-child {
                                border-left: none;
                              }

                              table.blueTable tfoot {
                                font-size: 14px;
                                font-weight: bold;
                                color: #FFFFFF;
                                background: #D0E4F5;
                                background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
                                background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
                                background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
                                border-top: 2px solid #444444;
                              }
                              table.blueTable tfoot td {
                                font-size: 14px;
                              }
                              table.blueTable tfoot .links {
                                text-align: right;
                              }
                              table.blueTable tfoot .links a{
                                display: inline-block;
                                background: #1C6EA4;
                                color: #FFFFFF;
                                padding: 2px 8px;
                                border-radius: 5px;
                              }
                    </style>                    
                    <table class='blueTable'>
                        <thead>
                        <tr>
                            <th colspan='4'>@@programa_resumen@@</th>
                        </tr>
                        <tr>
                            <th colspan='4'><br><b>".$nombre_congreso."<br>".$lema."<br><br>".$lugar."<br>".$fecha." </b><br><br></th>
                        </tr>
                        <tr>
                            <th>@@hinicio@@</th>
                            <th>@@hfinal@@</th>
                            <th>@@evento@@</th>
                            <th>@@localizacion@@</th>
                        </tr>
                        </thead>
                        <tbody align='justify'>";
                            foreach ($datos as $act){ 
                                setlocale(LC_ALL,'Spanish_Honduras');
                                $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($act['fecha_actividad'])));
                                $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));
                                                        
                                $newhorai = date("g:i A",strtotime($act['hora_inicio']));
                                $newhoraf = date("g:i A",strtotime($act['hora_final']));
                                $html.="<tr align='center'>
                                             <td colspan='4'><p>".$newfecha."</p></td>                                                
                                         </tr>
                                         <tr>
                                             <td><p>".$newhorai."</p></td>
                                             <td><p>".$newhoraf."</p></td>
                                             <td><p>".$act['nombre_actividad']."</p></td>
                                             <td><p>".$act['nombre_espacio']."</p></td>
                                         </tr>";
                            }
                        $html.="</tbody></table>";
        
        $html1 = traducirstring($html, '../../../idiomas/es/es.php');
        $dompdf=new DOMPDF();
        $dompdf->load_html(utf8_decode($html1));
        ini_set("memory_limit","40M");
        $dompdf->set_paper("letter","portrait"); /*TIPO DE LETRA Y FORMA FORMA VERTICAL*/
        $dompdf->render();
        $dompdf->stream('Programa_Resumen' , array("Attachment" => 0)); /*NOMBRE DE ARCHIVO AL DESCARGAR*/
    }else{
        $error = "<script language='javascript'>alert('@@error_no_existen_actividades@@');window.close();</script>";
        $html1 = traducirstring($error, '../../../idiomas/es/es.php');
        echo utf8_decode($html1);
    }
?>