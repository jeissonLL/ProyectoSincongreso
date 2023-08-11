<?php
/**--------
 * 
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */
    include '../../funciones/funcion_traducir.php';
    require '../../clases/class_base.php';    
    session_start();
    
    $total_trabajos="";
    $total_usuarios="";
    $total_trabajos_aceptados="";
    $total_trabajos_rechazados="";
    global $bdd;
    $bdd = new basedatos();

    $datos=$bdd->select('select count(a.id_trabajo_pk) as total from tbl_trabajo a
                join tbl_tematica b on b.id_tematica_pk=a.id_tematica_fk
                join tbl_linea_investigacion c on c.id_linea_investigacion_pk=b.id_linea_investigacion_fk
                join tbl_congreso_linea_investigacion d on d.id_linea_investigacion_pk=c.id_linea_investigacion_pk
                where d.id_congreso_pk='.$_SESSION["idcongreso"].'');
    
    foreach ($datos as $fila) {
    $total_trabajos='<div id="total_trabajos" class="circliful-chart" data-dimension="90" data-text="'.$fila['total'].'" data-width="5" data-fontsize="14" data-percent="100" data-fgcolor="#5fbeaa" data-bgcolor="#ebeff2"></div>
           <h3 class="text-success counter">'.$fila['total'].'</h3>
            <p class="text-muted text-nowrap">@@total_trabajos@@</p>'; 
    }
    
    $total_trabajos = traducirstring($total_trabajos, '../../'.$_SESSION['idm']);

    $datos=$bdd->select('select count(f.id_usuario_pk) as total from tbl_trabajo a
                join tbl_tematica b on b.id_tematica_pk=a.id_tematica_fk
                join tbl_linea_investigacion c on c.id_linea_investigacion_pk=b.id_linea_investigacion_fk
                join tbl_congreso_linea_investigacion d on d.id_linea_investigacion_pk=c.id_linea_investigacion_pk
                join tbl_usuario_trabajo e on e.id_trabajo_fk=a.id_trabajo_pk
                join tbl_usuario f on f.id_usuario_pk=e.id_usuario_fk
                where d.id_congreso_pk='.$_SESSION["idcongreso"].'');
    
    foreach ($datos as $fila) {
    $total_usuarios='<div id="total_resgistros" class="circliful-chart" data-dimension="90" data-text="'.$fila['total'].'" data-width="5" data-fontsize="14" data-percent="100" data-fgcolor="#3bafda" data-bgcolor="#ebeff2"></div>
                <h3 class="text-primary counter">'.$fila['total'].'</h3>
                <p class="text-muted text-nowrap">@@total_registros@@</p>';    
    }
    
    $total_usuarios = traducirstring($total_usuarios, '../../'.$_SESSION['idm']);
    
    $datos=$bdd->select('select count(a.id_trabajo_pk) as total from tbl_trabajo a
                join tbl_tematica b on b.id_tematica_pk=a.id_tematica_fk
                join tbl_linea_investigacion c on c.id_linea_investigacion_pk=b.id_linea_investigacion_fk
                join tbl_congreso_linea_investigacion d on d.id_linea_investigacion_pk=c.id_linea_investigacion_pk
                where d.id_congreso_pk='.$_SESSION["idcongreso"].' and a.id_estado_fk="6"');
    
    foreach ($datos as $fila) {
    $total_trabajos_aceptados='<div id="total_taceptados" class="circliful-chart" data-dimension="90" data-text="'.$fila['total'].'" data-width="5" data-fontsize="14" data-percent="100" data-fgcolor="#023c56" data-bgcolor="#ebeff2"></div>
                <h3 class="text-primary counter">'.$fila['total'].'</h3>
                <p class="text-muted text-nowrap">@@total_trabajos_aceptados@@</p>';    
    }
    
    $total_trabajos_aceptados = traducirstring($total_trabajos_aceptados, '../../'.$_SESSION['idm']);    
    
    $datos=$bdd->select('select count(a.id_trabajo_pk) as total from tbl_trabajo a
                join tbl_tematica b on b.id_tematica_pk=a.id_tematica_fk
                join tbl_linea_investigacion c on c.id_linea_investigacion_pk=b.id_linea_investigacion_fk
                join tbl_congreso_linea_investigacion d on d.id_linea_investigacion_pk=c.id_linea_investigacion_pk
                where d.id_congreso_pk='.$_SESSION["idcongreso"].' and a.id_estado_fk="2"');
    
    foreach ($datos as $fila) {
    $total_trabajos_rechazados='<div id="total_trechazados" class="circliful-chart" data-dimension="90" data-text="'.$fila['total'].'" data-width="5" data-fontsize="14" data-percent="100" data-fgcolor="#b7403a" data-bgcolor="#ebeff2"></div>
                <h3 class="text-primary counter">'.$fila['total'].'</h3>
                <p class="text-muted text-nowrap">@@total_trabajos_rechazados@@</p>';    
    }
    
    $total_trabajos_rechazados = traducirstring($total_trabajos_rechazados, '../../'.$_SESSION['idm']);        
    
    $linea=array();
    $total=array();

    $i=0;
    $datos=$bdd->select('select c.id_linea_investigacion_pk, c.nombre_linea_investigacion, count(a.id_trabajo_pk) as total from tbl_trabajo a 
                    join tbl_tematica b on b.id_tematica_pk=a.id_tematica_fk
                    join tbl_linea_investigacion c on c.id_linea_investigacion_pk=b.id_linea_investigacion_fk
                    join tbl_congreso_linea_investigacion d on d.id_linea_investigacion_pk=c.id_linea_investigacion_pk
                    where 1=1  and d.id_congreso_pk='.$_SESSION["idcongreso"].' group by c.id_linea_investigacion_pk');    
    
    foreach ($datos as $fila) {
    array_push($linea,$i.":".$fila['nombre_linea_investigacion']);
    array_push($total,$fila['total']);
    $i++;
    }
    
    $total_x_linea=array('linea'=>$linea,'total'=>$total);

    $tematica=array();
    $totalt=array();

    $i=0;
    $datos=$bdd->select('select b.id_tematica_pk, b.nombre_tematica, count(a.id_trabajo_pk) as total from tbl_trabajo a 
                        join tbl_tematica b on b.id_tematica_pk=a.id_tematica_fk
                        join tbl_congreso_linea_investigacion c on c.id_linea_investigacion_pk=b.id_linea_investigacion_fk
                        where 1=1  and c.id_congreso_pk='.$_SESSION["idcongreso"].' group by b.id_tematica_pk');    
    
    foreach ($datos as $fila) {
    array_push($tematica,$i.":".$fila['nombre_tematica']);
    array_push($totalt,$fila['total']);
    $i++;
    }
    
    $total_x_tematica=array('tematica'=>$tematica,'totalt'=>$totalt);    
    
    $carrera=array();
    $totaluc=array();

    $i=0;
    $datos=$bdd->select('select  f.nombre_carrera, count(b.id_usuario_fk) as total from tbl_trabajo a
                        join tbl_usuario_trabajo b on b.id_trabajo_fk=a.id_trabajo_pk
                        join tbl_usuario c on c.id_usuario_pk=b.id_usuario_fk
                        join tbl_persona_institucion d on d.id_persona_pk=c.id_persona_fk
                        join tbl_institucion_facultad_carrera e on e.id_institucion_facultad_carrera=d.id_institucion_facultad_carrera
                        join tbl_carrera f on f.id_carrera_pk=e.id_carrera_fk
                        join tbl_tematica g on g.id_tematica_pk=a.id_tematica_fk
                        join tbl_linea_investigacion h on h.id_linea_investigacion_pk=g.id_linea_investigacion_fk
                        join tbl_congreso_linea_investigacion i on i.id_linea_investigacion_pk=h.id_linea_investigacion_pk
                        where 1=1 and e.id_institucion_fk="1" and i.id_congreso_pk='.$_SESSION["idcongreso"].' and a.id_estado_fk="6" group by f.id_carrera_pk');    
    
    foreach ($datos as $fila) {
    array_push($carrera,$i.":".$fila['nombre_carrera']);
    array_push($totaluc,$fila['total']);
    $i++;
    }
    
    $total_x_usuario_x_carrera=array('carrera'=>$carrera,'totaluc'=>$totaluc);    
    
    $data=array('total_trabajos' => $total_trabajos,
            'total_usuarios' => $total_usuarios,
            'total_aceptados' => $total_trabajos_aceptados,
            'total_rechazados' => $total_trabajos_rechazados,
            'total_x_linea' => $total_x_linea,
            'total_x_tematica' => $total_x_tematica,
            'total_x_usuario_x_carrera'=> $total_x_usuario_x_carrera
             );    

    echo '' . json_encode($data) . '';