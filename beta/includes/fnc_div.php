<?php

/* @var $_POST type */
//print_r($_POST);
session_start();
//print_r($_SESSION);
header("Content-Type: text/html;charset=utf-8");
require '../clases/class_base.php';
require '../funciones/funcion_traducir.php';
switch ($_POST['funcion']) {
      case 'bandeja_mensajes':
          llenar_bandeja();
          break;
      case 'divcautorias': //OBED
          divcautorias();
          break;
      case 'ver_noticia':/*Brayan*/
          ver_noticias();
          break;
      
      case 'congreso_noticia':
          congreso_noticia();
          break;
      
      case 'bandeja_mensajes_voluntario';
          bandeja_mensajes_voluntario();
          break;
      
      case'tabajos_tematica';
          tabajos_tematica();
          break;
      case 'premios_tematica_auto';
          premios_tematica_auto();
          break;
  }
  
  function divcautorias(){
     $idusuario = $_SESSION['idusuario'];  
//    $nusuario = $_SESSION['nusuario'];   
//    $idpersona = $_SESSION['idpersona']; 
//    $idioma = $_SESSION['idioma']; 
   // $idcongreso = $_SESSION['idcongreso'];
    global $bdd;
    $bdd = new basedatos();   
    $datos=$bdd->select('select * from tbl_usuario_trabajo a, tbl_trabajo b, tbl_tipo_trabajo c where a.id_trabajo_fk=b.id_trabajo_pk and b.id_tipo_trabajo_fk=c.id_tipo_trabajo_pk and a.autoria="0" and a.id_usuario_fk="'.$idusuario.'"'); 
    $html = "";
    foreach ($datos as $fila) {    
    $html.="<div class='col-lg-12' id='divautoria_".$fila['id_usuario_trabajo_pk']."' align='justify' style='text-indent: 5em' >
                <div class='portlet'>
                    <div class='portlet-heading bg-primary'>
                        <h3 class='portlet-title'>".$fila['titulo_trabajo']."</h3>
                        <div class='clearfix'></div>                                      
                    </div>
                    <div> 
                      <h4 class='portlet-title'>@@resumenprograma@@</h4>
                      <div class='portlet-body'><li type='circle'>".$fila['resumenprograma']."</li></div>
                      <h4 class='portlet-title'>@@palabrasclave@@</h4>
                      <div class='portlet-body'><li type='circle'>".$fila['palabrasclave']."</li></div>
                      <h4 class='portlet-title'>@@tipotrabajo@@</h4>
                      <div class='portlet-body'><li type='circle'>".$fila['nombre_tipo_trabajo']."</li></div>
                      <h4 class='portlet-title'>@@idioma@@</h4>
                      <div class='portlet-body'><li type='circle'>".$fila['id_idioma_fk']."</li></div>";
                      $dt = $bdd->select("select * from tbl_trabajo_tematica a, tbl_tematica b where a.id_trabajo_fk=".$fila['id_trabajo_pk']." and a.id_tematica_fk=b.id_tematica_pk");
                      foreach ($dt as $k) {
                          if($k['principal']==1){
                              $html.="<h4 class='portlet-title'>@@tprincipal@@</h4>
                                       <div class='portlet-body'><li type='circle'>".$k['nombre_tematica']."</li></div>";
                          }
//                          else{
//                              $html.="<h4 class='portlet-title'>@@topcional@@</h4>
//                                       <div class='portlet-body'><li type='circle'>".$k['nombre_tematica']."</li></div>";
//                          }
                      }
                $html.="<div align='center'>                                        
                            <button class='btn btn-icon waves-effect waves-light btn-success m-b-5' onclick='aceptara(".$fila['id_usuario_trabajo_pk'].");' title='@@aceptar_autoria@@'> <i class='fa fa-thumbs-o-up'></i> </button>
                            <button class='btn btn-icon waves-effect waves-light btn-danger m-b-5' onclick='rechazara(".$fila['id_usuario_trabajo_pk'].");' title='@@rechazar_autoria@@'> <i class='fa fa-remove'></i> </button>
                        </div>
                    </div>
                </div>
            </div>";
    }
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
  }






  function llenar_bandeja() {
      require '../clases/clase_Mensajeria.php';     
      $bandeja = new Mensajeria();
      $html = $bandeja->gethtml(0);
      $html = traducirstring($html, '../'.$_SESSION['idm']);
      echo $html;
  }
  
  
  
  function ver_noticias(){
      $html = " ";
      $a = 1 ;
      include '../clases/class_noticias.php';
      $noticia = new noticias();
      $datos = $noticia->ver_noticias() ;
      
      foreach ($datos as $valor){
        $imagen         = $valor['imagen'];
        $descripcion    = $valor['descripcion'];
        $titulo         = $valor['titulo'];
        $fecha          = $valor['fecha'];
        
              
        $html .= "<div class='col-lg-6'>
                            <div class='card-box widget-user'>
                                <div>
                                    <img  style='width: 30% ; height: 20%; margin-top: 25px; margin-right: 15px; margin-left:15px; border-radius: 10px;' src='img/congresos/$imagen' class='img-responsive img-scuare' alt='user'>
                                    <div class='panel panel-border panel-info'>
                                        <div class='panel-heading'>
                                            <h3 class='panel-title'>$titulo</h3>
                                            <p class='text-muted m-b-30 font-13' style='text-align: justify'>$fecha</p> 
                                        </div>
                                        <div class='panel-body'>
                                            <p class='text-custom' style='text-align: justify ; font-size: larger;' >$descripcion</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
              " ;
        $a++;
      }
      
      
      echo $html;
  }

function congreso_noticia(){
    $html = " ";
    $idocongreso = $_SESSION['idcongreso'];
    
    $html .=  "<div class='row' align='center' >     
                                <h1 style='text-transform: uppercase;  text-shadow:2px 2px 5px grey;' class='text-primary'><b>@@c_noticias@@</b></h1><br><br>
                                <img src='img/congresos/ceat_$idocongreso.png' style='width: 45%;'> 
                            </div>
            ";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

function bandeja_mensajes_voluntario() {
      require '../clases/clase_Mensajeria.php';     
      $bandeja = new Mensajeria();
      $html = $bandeja->gethtml(1);
      $html = traducirstring($html, '../'.$_SESSION['idm']);
      echo $html;
  }

  
  function tabajos_tematica(){
    global $bdd;
    $bdd = new basedatos();
    
    $idtematica = filter_input(INPUT_POST, 'idtematica');
    $html = "<label class='control-label' for='fullname'>@@titulotrab@@</label>
            <div class='card-box widget-user'>";
    
    $datos=$bdd->select('select * from tbl_trabajo where id_tematica_fk = "'.$idtematica.'" and id_estado_fk = 7 ');
    
    foreach ($datos as $fila) {
        $idpremio = $fila['id_trabajo_pk'] ;
        $nombre_premio = $fila['titulo_trabajo'];
        
        $html.="<div class='radio radio-success'>
                <input id='$idpremio' name='activiadad' value='$idpremio' type='radio'>
                    <label for='radios'>
                        $nombre_premio
                    </label>
                </div>
                    ";
    }
    $html.="</div>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
  }
  
  function premios_tematica_auto(){
    global $bdd;
    $bdd = new basedatos();
    
    $idtematica = filter_input(INPUT_POST, 'idtematica');
    $premioyaasignado = explode("," , filter_input(INPUT_POST, 'idpremios')); 
    
    $html = "<label class='control-label' for='fullname'>@@premio@@</label>
            <div class='card-box widget-user'>";
    
    $datos=$bdd->select('select * from tbl_premio where id_tematica_fk = "'.$idtematica.'" ');
    
    foreach ($datos as $fila) {
        $idpremio = $fila['id_premio_pk'] ;
        $nombre_premio = $fila['nombre_premio'];
        
        if (in_array($idpremio, $premioyaasignado)) {
        }else{
            $html.="<div class='checkbox checkbox-info'>
                <input id='checkbox4' type='checkbox' id='$idpremio' value='$idpremio'>
                    <label for='checkbox4'>
                        $nombre_premio
                    </label>
                </div>
                    ";
            
        }
    }
 
    $html.="</div>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
      
        
  }
?>
