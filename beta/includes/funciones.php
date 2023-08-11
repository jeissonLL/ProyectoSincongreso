<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../funciones/funcion_traducir.php';

switch ($_GET['funcion']) {

    case 'roles_congreso':   
        roles_congreso();
        break;
    case 'select_idioma':   
        select_idioma();
        break;
    case 'congresos_perfil':
        congresos_perfil();
        break;
    case 'congresos':
        congresos();
        break;    
    case 'ambiente':
        ambiente();
        break;    
    case 'congresos_activos':
        congresos_activos();
        break;
    case 'info_congreso':
        info_congreso();
        break;         
    case 'inscribirse_congreso':
        inscribirse_congreso();
        break;    
    case 'roles_congreso_usuario':   
        roles_congreso_usuario();
        break;  
    case 'tpersona':   
        tpersona();
        break;     
    case 'veri_info':   
       // veri_info();
        break;  
}
function veri_info(){
    include '../clases/class_base.php';
    
    session_start();        
    $idpersona = $_SESSION['idpersona'];
    
    $bdd = new basedatos();
    
    $datos=$bdd->select("select * from tbl_persona_institucion a 
                where a.id_persona_pk=".$idpersona."" );
    $num_r=$bdd->num_row();
    if($num_r==0)
    {
        echo 1;
    }else{
        echo 0;
    }
}

function tpersona(){
    $html="";
    include '../clases/class_base.php';
switch ($_POST['tpersona']) {

    case 1:  
    case 2:  
    case 3:         
        $bdd = new basedatos();
        $datos=$bdd->select("select a.id_institucion_facultad_carrera, b.* from tbl_institucion_facultad_carrera a
                            join tbl_carrera b on b.id_carrera_pk = a.id_carrera_fk
                            where a.id_institucion_fk = 1 order by b.nombre_carrera");
        $html="<option value='0'>@@seleccione@@</option>";

        foreach ($datos as $fila)
        {

                $html.="<option value='".$fila['id_institucion_facultad_carrera']."'>".$fila['nombre_carrera']."</option>";
        }
        $html = traducirstring($html, '../idiomas/es/es.php');

        break;
    case 4:  
    case 5:
    case 6: 
        $bdd = new basedatos();
        $datos=$bdd->select("select * from tbl_institucion where id_institucion_pk!=1");
        $html="<option value='0'>@@seleccione@@</option>";

        foreach ($datos as $fila)
        {

                $html.="<option value='".$fila['id_institucion_pk']."'>".$fila['nombre_institucion']."</option>";

        }
        $html = traducirstring($html, '../idiomas/es/es.php');
 
        break;        
}

        echo $html;            
    
    
}
function roles_congreso_usuario(){
    include '../clases/class_base.php';
    global $bdd;
    if(isset($_POST['congreso']))
    {
        $congreso=filter_input(INPUT_POST,'congreso');
    }else{
        session_start();        
        $congreso = $_SESSION['idcongreso'];
    }

    $bdd = new basedatos();
    $datos=$bdd->select("select a.nombre_rol,  b.tbl_rol_congreso_pk, b.id_rol_fk 
                            from tbl_roles a, tbl_roles_congreso b, tbl_congreso c, tbl_usuario_congreso_roles d
                            where a.id_rol_pk=b.id_rol_fk and b.id_congreso_fk=c.id_congreso_pk and c.id_estado_congreso_fk and b.id_congreso_fk=".$congreso."
                            and d.id_rol_congreso_fk=b.tbl_rol_congreso_pk and d.id_usuario_fk=".$_SESSION['idusuario']."");

     $roles = [];
    foreach ($datos as $fila)
    {
    $roles+=['id_rol' => $fila['tbl_rol_congreso_pk'], ];
    }
    $informacion = json_encode($roles);
    echo $informacion;    
}

function inscribirse_congreso()
{
    $idcongreso = filter_input(INPUT_POST, 'idcongreso');
    $idusuario = filter_input(INPUT_POST, 'idusuario');
    
    global $bdd;
    $bdd = new basedatos();
        
    $datos = $bdd -> select("select a.tbl_rol_congreso_pk from tbl_roles_congreso  a
                    join tbl_roles b on b.id_rol_pk=a.id_rol_fk
                    join tbl_congreso c on c.id_congreso_pk=a.id_congreso_fk 
                    where b.nombre_rol = 'Participante' and c.id_congreso_pk='$idcongreso'" );
     
    $respuesta = "";
    foreach ($datos as $fila)
    {
        $rol = $fila['tbl_rol_congreso_pk']; 
        include_once '../clases/class_usuario.php';    
        $usuario = new usuario();
        $usuario->uinicializar($idusuario, "", "", "", "",$rol,'');        
        $respuesta = $usuario->asignar_rol_congreso();
    }
   if($respuesta>0)
   {
       echo 1;
   }else{
       echo 0;
   }
    
}
function info_congreso()
{
    $idcongreso = filter_input(INPUT_POST, 'idcongreso');
    
    include_once '../clases/clase_Congreso.php';
    session_start();
    
    $congreso = new Congreso();
    $congreso->cinicializar6($idcongreso);
    $info_congreso = $congreso->get_congreso_inf();
    $icongreso=[];
    
    
    foreach($info_congreso as $info)
    {
        $pais = explode(';', $info['nombre_pais']);
        $icongreso+=['nombre_congreso' => $info['nombre_congreso'], 
            'descripcion_congreso' => $info['descripcion_congreso'], 
            'siglas'=>$info['siglas'],
            'nombre_estado' => $info['nombre_estado'], 
       // 'fecha' => $info['fecha_inicio'].'-'.$info['fecha_finalizacion'],
            'lugar' => $info['lugar'],
            'idusuario' => $_SESSION['idusuario'],
            'pais' => $pais[1]];
    }
    $informacion = json_encode($icongreso);
    echo $informacion;    
    
}
function congresos_activos(){
    include '../clases/class_base.php';
    global $bdd;
    session_start();
    $bdd = new basedatos();
    $datos=$bdd->select("select c.id_congreso_pk, c.nombre_congreso, c.siglas, c.logo_congreso from tbl_congreso c 
                         where c.id_estado_congreso_fk <>0
                         ");
//    $datos = $datos->fetch_array(MYSQLI_ASSOC);
    $html="";
    
    foreach ($datos as $fila)
    {
        $entro = 0;
        $idcongreso = $fila['id_congreso_pk']; 
        $datos2 = $bdd->select("select distinct b.id_congreso_fk  from tbl_usuario_congreso_roles a
                    join tbl_roles_congreso b on b.tbl_rol_congreso_pk=a.id_rol_congreso_fk
                    where a.id_usuario_fk = ".$_SESSION['idusuario']." and b.id_congreso_fk = ".$fila['id_congreso_pk']."");


    foreach ($datos2 as $fila2)
    {

        $entro = 1;
    }        
    if($entro == 0)
       {
           $html.="<div class='col-sm-4'>
                    <div class='gal-detail thumb'>
                        <a href='#' onclick=info_congreso('".$idcongreso."')  class='image-popup' data-toggle='modal' data-target='#con-close-modal' title='".$fila['siglas']."'>
                            <img src='./img/congresos/".$fila['logo_congreso']."' class='thumb-img' alt='work-thumbnail'>
                        </a>
                        <h4 class='text-center'>".$fila['siglas']."</h4>
                        <div class='ga-border'></div>
                        <p class='text-muted text-center'><small>".$fila['nombre_congreso']."</small></p>
                    </div>
                </div>";     
           
       }
    }   
    if($html == "")
    {
        $html.="<div class='col-sm-12'>
                <div class='gal-detail thumb'>
                    <h2 class='text-center'>Actualmente usted esta inscrito en todos los congresos activos</h2>
                    <div class='ga-border'></div>

                </div>
            </div>";           
    }
echo $html;    
}
function ambiente(){
    
    $idcongreso=filter_input(INPUT_POST,'idcongreso');    
    include '../clases/class_base.php';    
    global $bdd;
    session_start();
    $bdd = new basedatos();
    
    $datos=$bdd->select("select nombre_congreso, siglas, logo_congreso, lema from tbl_congreso where id_congreso_pk = ".$idcongreso."");

    foreach ($datos as $fila)
    {
        $siglas = $fila['siglas']; 
        $nombre_congreso = $fila['nombre_congreso']; 
        $logo_congreso = $fila['logo_congreso']; 
        $lema = $fila['lema']; 
    }
    $datos2 = $bdd -> select("select c.id_rol_pk, a.id_rol_congreso_fk, c.nombre_rol from tbl_usuario_congreso_roles a, tbl_roles_congreso b, tbl_roles c
                         where a.id_rol_congreso_fk and b.tbl_rol_congreso_pk=a.id_rol_congreso_fk
                         and b.id_rol_fk=c.id_rol_pk
                         and a.id_usuario_fk = ".$_SESSION['idusuario']." and b.id_congreso_fk=".$idcongreso."");
    $roles=[];
    $rol=[];
    foreach ($datos2 as $fila2)
    {
        $roles += [$fila2['id_rol_congreso_fk'] => $fila2['nombre_rol']];
        $rol += [$fila2['id_rol_pk'] => $fila2['nombre_rol']];
    }
    $_SESSION['roles'] = $roles; //Contiene el id del rol en el congreso
    $_SESSION['idcongreso'] = $idcongreso;
    $_SESSION['siglas'] = $siglas;
    $_SESSION['nombre_congreso'] = $nombre_congreso;
    $_SESSION['logo_congreso'] = $logo_congreso;
    $_SESSION['lema'] = $lema;
    $_SESSION['rol'] = $rol; //Contiene el id del rol en el sistema
    
    $html = json_encode($_SESSION);
    echo $html;
    
}

function congresos(){
    include '../clases/class_base.php';
    global $bdd;
    session_start();
    $bdd = new basedatos();
    $datos=$bdd->select("select distinct c.id_congreso_pk, c.nombre_congreso, c.siglas, c.logo_congreso from tbl_usuario_congreso_roles a, tbl_roles_congreso b, tbl_congreso c
                         where a.id_rol_congreso_fk and b.tbl_rol_congreso_pk=a.id_rol_congreso_fk and c.id_congreso_pk=b.id_congreso_fk
                         and a.id_usuario_fk = ".$_SESSION['idusuario']."");
//    $datos = $datos->fetch_array(MYSQLI_ASSOC);
    $html="";
    
    foreach ($datos as $fila)
    {
        $idcongreso = $fila['id_congreso_pk']; 
        
        $html.="<div class='col-sm-4'>
                <div class='gal-detail thumb'>
                    <a href='#' onclick=ambiente('".$idcongreso."')  class='image-popup' title='".$fila['siglas']."'>
                        <img src='./img/congresos/".$fila['logo_congreso']."' class='thumb-img' alt='work-thumbnail'>
                    </a>
                    <h4 class='text-center'>".$fila['siglas']."</h4>
                    <div class='ga-border'></div>
                    <p class='text-muted text-center'><small>".$fila['nombre_congreso']."</small></p>
                </div>
            </div>";
        
    }    
echo $html;    
}
function congresos_perfil(){
    include '../clases/class_base.php';
    global $bdd;
    session_start();
    $bdd = new basedatos();
    $datos=$bdd->select("select distinct c.nombre_congreso, c.siglas, c.logo_congreso from tbl_usuario_congreso_roles a, tbl_roles_congreso b, tbl_congreso c
                         where a.id_rol_congreso_fk and b.tbl_rol_congreso_pk=a.id_rol_congreso_fk and c.id_congreso_pk=b.id_congreso_fk
                         and a.id_usuario_fk = ".$_SESSION['idusuario']."");
//    $datos = $datos->fetch_array(MYSQLI_ASSOC);
    $html="";
    foreach ($datos as $fila)
    {
    $html.='<div class="col-sm-4">
                <div class="gal-detail thumb">
                    <a href="#" class="image-popup" title="Screenshot-2">
                        <img src="./img/congresos/'.$fila["logo_congreso"].'" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4 class="text-center">'.$fila["siglas"].'</h4>
                    <div class="ga-border"></div>
                    <p class="text-muted text-center"><small>'.$fila["nombre_congreso"].'</small></p>
                </div>
            </div>';
        
    }    
echo $html;    
}

function select_idioma(){
$a=filter_input(INPUT_POST,'variable');
session_start();
//echo $a;
$_SESSION["$a"]=filter_input(INPUT_POST,'valor');

if($a == 'idioma')
{
    echo "0"; //debe cambiar hacia login
}
}


function roles_congreso(){
    include '../clases/class_base.php';
    global $bdd;
    if(isset($_POST['congreso']))
    {
        $congreso=filter_input(INPUT_POST,'congreso');
    }else{
        session_start();        
        $congreso = $_SESSION['idcongreso'];
    }
//echo "select a.nombre_rol, b.id_rol_fk from tbl_roles a, tbl_roles_congreso b, tbl_congreso c
//                        where a.id_rol_pk=b.id_rol_fk and b.id_congreso_fk=c.id_congreso_pk and c.id_estado_congreso_fk and b.id_congreso_fk=".$_POST['congreso']."";
    $bdd = new basedatos();
    $datos=$bdd->select("select a.nombre_rol,  b.tbl_rol_congreso_pk, b.id_rol_fk from tbl_roles a, tbl_roles_congreso b, tbl_congreso c
                        where a.id_rol_pk=b.id_rol_fk and b.id_congreso_fk=c.id_congreso_pk and c.id_estado_congreso_fk and b.id_congreso_fk=".$congreso."");
    $html="<option value='0'>@@seleccione@@</option>";

    foreach ($datos as $fila)
    {
        if($fila['id_rol_fk']!=1){
            $html.="<option value='".$fila['tbl_rol_congreso_pk']."'>".$fila['nombre_rol']."</option>";
        }
    }
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;    
}
