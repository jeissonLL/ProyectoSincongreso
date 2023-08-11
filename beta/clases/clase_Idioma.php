<?php

/*
  Alex Siboney Vargas Osorto
  18-4-2017
  alexv7142@gmail.com
  Manejo y gestión de congresos
 */

require_once 'class_base.php';


class Idioma {

    //Listado de Propiedades de la Clase Idioma
    private $base;
    private $idioma_raiz;
    private $id_idioma_pk;
    private $nombre_idioma;
    private $bandera;
    private $creado_por;
    private $fecha_creacion;
    private $modificado_por;
    private $fecha_modificacion;
    private $id_estado_idioma_fk;
    private $id_usuario_pk;
    
    //Métodos Públicos

    public function __construct() {
        $this->base = new basedatos();
    }

    public function iinicializar($id_idioma_pk) {
        $this->id_idioma_pk   =   $id_idioma_pk;
    }
    public function iinicializar2($id_usuario_pk) {
        $this->id_usuario_pk = $id_usuario_pk;
    }

    //habilitar_idioma(), habilita un idioma para que sea puesto en proceso de traducción y las personas puedan inscribirse para realizar traducciones
    // y las que ya están inscritas puedan realizarlas.
    public function habilitar_idioma() {
        $carpeta                           =   '../idiomas/' . $this->id_idioma_pk;
        $nuevo_idioma                      =   '../idiomas/' . $this->id_idioma_pk . '/' . $this->id_idioma_pk . '.php';
        $idioma_raiz                       =   "../idiomas/es/es.php";
        $arreglo                           =   "";
        require             $idioma_raiz;
        $arreglo                           =   "<?php\r\n"
                                             . "@@@@!!!***leng = array(  \r\n";
        $size                              =   count($leng);
        $c = 0;
        foreach (   $leng   as   $clave   =>   $valor   )   { //Por cada arreglo llamado leng que es el que contiene las etiquetas y su respectiva traducción...
            $c++;
            if(   $c   <   $size   ) {
                $arreglo                 .=   "    '$clave' => '$valor',\r\n";
            }
            else {
                $arreglo                 .=   "    '$clave' => '$valor',";
            }
            
        }
        $arreglo                         .=   "); \r\n ?>";
        $arreglo                          =   str_replace("@@@@!!!***", "$", $arreglo);
        $arreglo                          =   str_replace("',);", "');", $arreglo);
        if (   !file_exists($carpeta)   ) {
            mkdir($carpeta, 0777, true);
            $nuevo_idioma_c               =   fopen($nuevo_idioma, "w+");
            fwrite($nuevo_idioma_c,   $arreglo);
            fclose($nuevo_idioma_c);
        } else {
            if (   !file_exists($nuevo_idioma)   ) {
                $nuevo_idioma_c           =   fopen($nuevo_idioma, "w+");
                fwrite($nuevo_idioma_c,   $arreglo);
                fclose($nuevo_idioma_c);
            } else {
                $nuevo_idioma_c           =   fopen($nuevo_idioma, "w");
                fwrite($nuevo_idioma_c,   $arreglo);
                fclose($nuevo_idioma_c);
            }
        }
        $habilitar_traduccion             =   $this->base->update("UPDATE `tbl_idioma` SET `id_estado_idioma_fk`= 4  WHERE `id_idioma_pk`='" . $this->id_idioma_pk . "'");
        if (   $habilitar_traduccion   >   0   ) {
            $asunto = "Nuevo idioma habilitado";
            $mensaje = "Se ha habilitado el idioma ".self::nombreidioma($this->id_idioma_pk)." para su proceso de traducción en el Sistema de Gestión de Congresos IIES-UNAH";
            self::enviarcorreosuperusuarios($asunto, $mensaje, $this->id_idioma_pk);
            return true;
        } else {
            return false;
        }
    }
    
    //activar_idioma(), Marca un idioma como activo, ahora este podrá estar disponible como elección para el usuario y poder visualizar la plataforma en el idioma de su selección.
    public function activar_idioma() {
        $activar_idioma = $this->base->update("UPDATE `tbl_idioma` SET `id_estado_idioma_fk`= 1  WHERE `id_idioma_pk`='" . $this->id_idioma_pk . "'");
        if ($activar_idioma > 0) {
            $asunto = "Nuevo idioma activado";
            $mensaje = "Se ha activado el idioma ".$nombre_idioma." para su uso total en el Sistema de Gestión de Congresos IIES-UNAH";
            self::enviarcorreosuperusuarios($asunto, $mensaje, $this->id_idioma_pk);
            return true;
        } else {
            return false;
        }
    }

    //inactivar_idioma(), marca como inactivo un idioma y este ya no puede ser elegido por el usuario para visualizar plataforma
    public function inactivar_idioma() {
        $inactivar_idioma   =   $this->base->update("UPDATE `tbl_idioma` SET `id_estado_idioma_fk`= 3  WHERE `id_idioma_pk`='" . $this->id_idioma_pk . "'");
        if (  $inactivar_idioma > 0  ) {
            $asunto = "Idioma inactivado";
            $mensaje = "Se ha inactivado el idioma ".self::nombreidioma($this->id_idioma_pk)." para su uso en el Sistema de Gestión de Congresos IIES-UNAH";
            self::enviarcorreosuperusuarios($asunto, $mensaje, $this->id_idioma_pk);
            return true;
        } else {
            return false;
        }
    }
    
    public function crear_respaldo($id_idioma_pk) {
        $repositorio = '../idiomas/'.$id_idioma_pk.'/repositorio/';
        $contenido = file_get_contents('../idiomas/'.$id_idioma_pk.'/'.$id_idioma_pk.'.php');
        $archivo_respaldo = "../idiomas/".$id_idioma_pk."/repositorio/".$id_idioma_pk."_";
        $identificador = 0;
        if(   !file_exists(   $repositorio   )   ) {
            mkdir($repositorio, 0777, true);
            $archivo_respaldo .= "1.txt";
            $respaldo               =   fopen($archivo_respaldo, "w+");
            fwrite($respaldo,   $contenido);
            fclose($respaldo);
            $identificador = 1;
        }
        else {
            $archivos = scandir("../idiomas/".$id_idioma_pk."/repositorio/");
            unset($archivos[0], $archivos[1]);
            $cantidad = count($archivos);
            switch ($cantidad) {
                case 1:
                    $archivo_respaldo .= "2.txt";
                    $identificador = 2;
                    break;
                case 2:
                    $archivo_respaldo .= "3.txt";
                    $identificador = 3;
                    break;
                case 3:
                    $archivo_respaldo .= "4.txt";
                    $identificador = 4;
                    break;
                case 4:
                    $archivo_respaldo .= "5.txt";
                    $identificador = 5;
                    break;
                case 5:
                    $archivo_respaldo .= "5.txt";
                    $identificador  = 5;
                    break;
            }
            if($identificador == 5) {
                unlink($archivo_respaldo);
                $respaldo = fopen($archivo_respaldo, "w+");
                fwrite($respaldo, $contenido);
                fclose($respaldo);
            }
            else {
                $respaldo = fopen($archivo_respaldo, "w+");
                fwrite($respaldo, $contenido);
                fclose($respaldo);
            }
        }
        $asunto = "Creación de respaldo para idioma";
        $mensaje = "Se ha creado el respaldo #" . $identificador . " para el idioma ".self::nombreidioma($id_idioma_pk)." dentro del Sistema de Gestión de Congresos IIES-UNAH";
        self::enviarcorreosuperusuarios(utf8_decode($asunto), $mensaje, $this->id_idioma_pk);
        return $identificador;
    }
    
    public function s_cargar_respaldo_idioma($id_idioma_pk, $archivo) {
        $repositorio = '../idiomas/'.$id_idioma_pk.'/repositorio/';
        $contenido = file_get_contents('../idiomas/'.$id_idioma_pk.'/'.$id_idioma_pk.'.php');
        $archivo_respaldo = "../idiomas/".$id_idioma_pk."/repositorio/".$id_idioma_pk."_";
        $identificador = 0;
        if(   !file_exists(   $repositorio   )   ) {
            mkdir($repositorio, 0777, true);
            $archivo_respaldo .= "1.txt";
            $tmp             =   $archivo['archivo_respaldo_idioma']['tmp_name'];
            move_uploaded_file($tmp, $archivo_respaldo);
            $contenido_respaldo = file_get_contents($archivo_respaldo);
            $idioma = fopen("../idiomas/" . $id_idioma_pk . "/" . $id_idioma_pk . ".php", "w");
            fwrite($idioma, $contenido_respaldo);
            fclose($idioma);
            $identificador = 1;
        }
        else {
            $archivos = scandir("../idiomas/".$id_idioma_pk."/repositorio/");
            unset($archivos[0], $archivos[1]);
            $cantidad = count($archivos);
            switch ($cantidad) {
                case 1:
                    $archivo_respaldo .= "2.txt";
                    $identificador = 2;
                    break;
                case 2:
                    $archivo_respaldo .= "3.txt";
                    $identificador = 3;
                    break;
                case 3:
                    $archivo_respaldo .= "4.txt";
                    $identificador = 4;
                    break;
                case 4:
                    $archivo_respaldo .= "5.txt";
                    $identificador = 4;
                    break;
                case 5:
                    $archivo_respaldo .= "5.txt";
                    $identificador  = 5;
                    break;
            }
            if ($identificador == 5) {
                unlink($archivo_respaldo);
                $tmp = $archivo['archivo_respaldo_idioma']['tmp_name'];
                move_uploaded_file($tmp, $archivo_respaldo);
                $contenido_respaldo = file_get_contents($archivo_respaldo);
                $idioma = fopen("../idiomas/" . $id_idioma_pk . "/" . $id_idioma_pk . ".php", "w");
                fwrite($idioma, $contenido_respaldo);
                fclose($idioma);
                ;
            } else {
                $tmp = $archivo['archivo_respaldo_idioma']['tmp_name'];
                move_uploaded_file($tmp, $archivo_respaldo);
                $contenido_respaldo = file_get_contents($archivo_respaldo);
                $idioma = fopen("../idiomas/" . $id_idioma_pk . "/" . $id_idioma_pk . ".php", "w");
                fwrite($idioma, $contenido_respaldo);
                fclose($idioma);
            }
        }
        $a_archivo = explode("/", $archivo_respaldo);
        $n_archivo = $a_archivo[4];
        $asunto = "Carga de respaldo para idioma";
        $mensaje = "Se ha cargado el respaldo #" . $identificador . " para el idioma ".self::nombreidioma($id_idioma_pk).", el contenido del mismo ahora ha sido actualizado al contenido"
                . " en el archivo ".$n_archivo." dentro del Sistema de Gestión de Congresos IIES-UNAH";
        self::enviarcorreosuperusuarios($asunto, $mensaje, $id_idioma_pk);
        return $identificador;
    }
    
    public function cargar_respaldo_idioma($archivo) {
        $temp_array           =   explode("_", $archivo);
        $id                   =   $temp_array[0];
        $contenido_respaldo   =   file_get_contents("../idiomas/".$id."/repositorio/".$archivo);
        $idioma               =   fopen("../idiomas/".$id."/".$id.".php", "w");
        if(fwrite($idioma, $contenido_respaldo)) {
             fclose($idioma);
             $asunto = "Carga de respaldo para idioma";
             $mensaje = "Se ha cargado un nuevo respaldo para el idioma " . self::nombreidioma($id). ", el contenido del mismo ahora ha sido actualizado al contenido"
                    . " en el archivo " . $archivo . " dentro del Sistema de Gestión de Congresos IIES-UNAH";
            self::enviarcorreosuperusuarios($asunto, $mensaje, $this->id_idioma_pk);
            return true;
        }
        else {
            return false;
        }
       
    }

    //json_idiomas(), retorna un json con la información requerida para cada uno de los idiomas.

    /**
     * ALEXIS ESCOTO 
     * 08-02-2023
     * SELECT CON METODO PDO
     */
    public function json_idiomas() {
        if (!(require '../funciones/funcion_traducir.php')) {
            require '../funciones/funcion_traducir.php';
        }
        if (   (   strlen(   session_id()   )   <   1   )   ) {
            session_start();
        }
        $pdo = $this->base->abrir_conexion();   
        $idiomas                          =    $pdo->query("SELECT DISTINCT(id_idioma_pk), nombre_idioma, id_estado_idioma_pk, nombre_estado FROM tbl_pais a, tbl_idioma b, tbl_pais_idioma c, tbl_estado_idioma d
                                               WHERE a.id_pais_pk = c.id_pais_fk AND b.id_idioma_pk = c.id_idioma_fk AND b.id_estado_idioma_fk = d.id_estado_idioma_pk");
        $arreglo                          =    array();

        foreach (   $idiomas   as   $valor   ) {
            $estado                       =    $valor['id_estado_idioma_pk'];
            $porcentaje_traduccion        =    "";
            if (   $estado   ==   5   ) {
                $porcentaje_traduccion    =    "0%";
            } 
            else {
                $porcentaje_traduccion    =    self::porcentaje_traduccion($valor['id_idioma_pk']);
            }
            $arreglo_ni                   =    explode(";", $valor['nombre_idioma']);
            $nombre_idioma                =    "";
            if (   $_SESSION['idioma']    ==   'es'  ) {
                $nombre_idioma            =    $arreglo_ni[0];
            } else {
                $nombre_idioma            =    $arreglo_ni[1];
            }
            $botones                      =     "";
            switch (   $estado   ) {
                case 1:
                    $botones              =    "<button type='button' class='incativaridioma btn btn-icon waves-effect waves-light btn-danger m-b-5' title='@@inactivar@@'><i class=' md-visibility-off'></i></button><button type='button' class='crearrespaldo btn btn-icon waves-effect waves-light btn-purple m-b-5' title = '@@crear_respaldo@@' ><i class='glyphicon glyphicon-folder-open'></i></button><button type='button'  class='cargarrespaldo btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@cargar_respaldo@@'><i class='glyphicon glyphicon-open'></i></button>";
                    break;
                case 2:
                    $botones              =    "<button type='button' class='finalizartraduccion btn btn-inverse waves-effect waves-light m-b-5' title='@@finalizar_traduccion@@'><i class='md md-trending-down'></i></button><button type='button' class='incativaridioma btn btn-icon waves-effect waves-light btn-danger m-b-5' title='@@inactivar@@'><i class=' md-visibility-off'></i></button><button type='button' class='crearrespaldo btn btn-icon waves-effect waves-light btn-purple m-b-5' title = '@@crear_respaldo@@' ><i class='glyphicon glyphicon-folder-open'></i></button><button type='button'  class='cargarrespaldo btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@cargar_respaldo@@'><i class='glyphicon glyphicon-open'></i></button>";
                    break;
                case 3:
                    $botones              =    "<button type='button' class='activaridioma btn btn-icon waves-effect waves-light btn-success m-b-5' title = '@@activar@@'><i class=' md-settings-power' ></i></button><button type='button' class='crearrespaldo btn btn-icon waves-effect waves-light btn-purple m-b-5' title = '@@crear_respaldo@@' ><i class='glyphicon glyphicon-folder-open'></i></button><button type='button'  class='cargarrespaldo btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@cargar_respaldo@@'><i class='glyphicon glyphicon-open'></i></button>";
                    break;
                case 4:
                    $botones              =    "<button type='button' class='activaridioma btn btn-icon waves-effect waves-light btn-success m-b-5' title = '@@activar@@'><i class=' md-settings-power' ></i></button><button type='button' class='crearrespaldo btn btn-icon waves-effect waves-light btn-purple m-b-5' title = '@@crear_respaldo@@' ><i class='glyphicon glyphicon-folder-open'></i></button><button type='button'  class='cargarrespaldo btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@cargar_respaldo@@'><i class='glyphicon glyphicon-open'></i></button>";
                    break;
                case 5:
                    $botones              =    "<button type='button' class='habilitartraduccion btn btn-icon waves-effect waves-light btn-warning m-b-5' title = '@@habilitar@@'><i class='ion-arrow-graph-up-right'></i></button>";
                    break;
            }
            $botones                      =    traducirstring($botones, "../idiomas/" . $_SESSION['idioma'] . "/" . $_SESSION['idioma'] . ".php");
            $arreglo["data"][]            =    array(
                "id_idioma_pk"            =>   $valor['id_idioma_pk'],
                "nombre_idioma"           =>   $nombre_idioma,
                "id_estado_idioma_pk"     =>   $valor['id_estado_idioma_pk'],
                "nombre_estado"           =>   $valor['nombre_estado'],
                "porcentaje_traduccion"   =>   $porcentaje_traduccion,
                "bandera"                 =>   "<a href='#'><img src = './img/banderas/" . $valor['id_idioma_pk'] . ".ico' /></a>",
                "botones"                 =>   $botones
            );
        }
        if (   sizeof($arreglo)           ==   0   ) {
            return '{
               "sEcho": 1,
               "iTotalRecords": "0",
               "iTotalDisplayRecords": "0",
               "aaData": []
             }';
        } else {
            return json_encode($arreglo);
        }
    }

    //json_idiomas_traducciones(), retorna un json con los idiomas disponibles o habilitados para traducciones
    /**
     * ALEXIS ESCOTO 
     * 08-02-2023
     * SELECT CON METODO PDO
     */
    public function json_idiomas_traducciones() {
        if (!(require '../funciones/funcion_traducir.php')) {
            echo "hola";
            require '../funciones/funcion_traducir.php';
        }
        if ((strlen(session_id()) < 1)) {
            session_start();
        }
        $pdo = $this->base->abrir_conexion();   
        $super_usuario = $pdo->query("SELECT id_tipo_usuario_fk FROM tbl_usuario_tipo_usuario WHERE id_usuario_fk = ".$this->id_usuario_pk." AND id_tipo_usuario_fk = 2 OR id_tipo_usuario_fk = 3");
        if($super_usuario->fetch(PDO::FETCH_ASSOC) > 0) {
            $idiomas                            =     $pdo->query("SELECT DISTINCT(id_idioma_pk), nombre_idioma, id_estado_idioma_pk, nombre_estado FROM tbl_pais a, tbl_idioma b, tbl_pais_idioma c, tbl_estado_idioma d
                                                                       WHERE a.id_pais_pk = c.id_pais_fk AND b.id_idioma_pk = c.id_idioma_fk AND b.id_estado_idioma_fk = d.id_estado_idioma_pk AND (b.id_estado_idioma_fk = 2 OR b.id_estado_idioma_fk = 4)");
        }
        else {
            $idiomas                            =     $pdo->query("SELECT DISTINCT(e.id_idioma_pk), e.nombre_idioma, g.id_estado_idioma_pk, g.nombre_estado 
                                                                            FROM tbl_usuario a, tbl_persona b, tbl_idiomas_personas c, tbl_idioma e, tbl_pais_idioma f, tbl_estado_idioma g
                                                                            WHERE a.id_persona_fk = b.id_persona_pk AND b.id_persona_pk = c.id_persona_pk AND c.id_idioma_fk = e.id_idioma_pk AND
                                                                            e.id_idioma_pk = f.id_idioma_fk AND e.id_estado_idioma_fk = g.id_estado_idioma_pk AND (e.id_estado_idioma_fk = 2 OR e.id_estado_idioma_fk = 4)
                                                                            AND a.id_usuario_pk = ".$this->id_usuario_pk."");
        }
        $arreglo                            =     array();

        foreach ($idiomas as $valor) {
            $estado                         =     $valor['id_estado_idioma_pk'];
            $porcentaje_traduccion          =     self::porcentaje_traduccion($valor['id_idioma_pk']);
            $arreglo_ni                     =     explode(";", $valor['nombre_idioma']);
            $nombre_idioma                  =     "";
            if ($_SESSION['idioma']         ==    'es'   ) {
                $nombre_idioma              =     $arreglo_ni[0];
            } else {
                $nombre_idioma              =     $arreglo_ni[1];
            }
            $botones = "<button type='button' class='acceder_traduccion btn btn-primary waves-effect w-md waves-light m-b-5'>@@acceder@@</button>";
            $botones = traducirstring($botones, "../idiomas/" . $_SESSION['idioma'] . "/" . $_SESSION['idioma'] . ".php");
            $arreglo["data"][]              =      array  (
                "id_idioma_pk"              =>     $valor['id_idioma_pk'],
                "nombre_idioma"             =>     $nombre_idioma,
                "id_estado_idioma_pk"       =>     $valor['id_estado_idioma_pk'],
                "nombre_estado"             =>     $valor['nombre_estado'],
                "porcentaje_traduccion"     =>     $porcentaje_traduccion,
                "bandera"                   =>     "<a href='#'><img src = './img/banderas/" . $valor['id_idioma_pk'] . ".ico' /></a>",
                "botones"                   =>     $botones
            );
        }
        if (   sizeof($arreglo)             ==     0   ) {
            return '{
               "sEcho": 1,
               "iTotalRecords": "0",
               "iTotalDisplayRecords": "0",
               "aaData": []
             }';
        } else {
            return json_encode($arreglo);
        }
    }
  /**
     * ALEXIS ESCOTO 
     * 13-02-2023
     * SELECT CON METODO PDO
     */
    //json_idioma(), retorna un objeto json que contiene toda la información del idioma requerido.
    public function json_idioma($id_idioma_pk) {
        if (!(require '../funciones/funcion_traducir.php')) {
            require '../funciones/funcion_traducir.php';
        }
        if (   (   strlen(session_id()   )    <   1  )  ) {
            session_start();
        }
        $pdo = $this->base->abrir_conexion();  
        $idiomas                          =   $pdo->query("SELECT DISTINCT(id_idioma_pk), nombre_idioma, id_estado_idioma_pk, nombre_estado FROM tbl_pais a, tbl_idioma b, tbl_pais_idioma c, tbl_estado_idioma d
                                                               WHERE a.id_pais_pk = c.id_pais_fk AND b.id_idioma_pk = c.id_idioma_fk AND b.id_estado_idioma_fk = d.id_estado_idioma_pk AND b.id_idioma_pk='" . $id_idioma_pk . "'");
        $arreglo                          =   array();

        foreach ($idiomas as $valor) {
            $estado                       =   $valor['id_estado_idioma_pk'];
            $porcentaje_traduccion        =   self::porcentaje_traduccion($valor['id_idioma_pk']);
            $arreglo_ni                   =   explode(";", $valor['nombre_idioma']);
            $nombre_idioma                =   "";
            if (   $_SESSION['idioma']    ==  'es'  ) {
                $nombre_idioma            =   $arreglo_ni[0];
            } else {
                $nombre_idioma            =   $arreglo_ni[1];
            }
            $botones = "";
            switch (   $estado   ) {
                case 1:
                    $botones              =    "<button type='button' class='incativaridioma btn btn-icon waves-effect waves-light btn-danger m-b-5' title='@@inactivar@@'><i class=' md-visibility-off'></i></button><button type='button' class='crearrespaldo btn btn-icon waves-effect waves-light btn-purple m-b-5' title = '@@crear_respaldo@@' ><i class='glyphicon glyphicon-folder-open'></i></button><button type='button'  class='cargarrespaldo btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@cargar_respaldo@@'><i class='glyphicon glyphicon-open'></i></button>";
                    break;
                case 2:
                    $botones              =    "<button type='button' class='finalizartraduccion btn btn-inverse waves-effect waves-light m-b-5' title='@@finalizar_traduccion@@'><i class='md md-trending-down'></i></button><button type='button' class='incativaridioma btn btn-icon waves-effect waves-light btn-danger m-b-5' title='@@inactivar@@'><i class=' md-visibility-off'></i></button><button type='button' class='crearrespaldo btn btn-icon waves-effect waves-light btn-purple m-b-5' title = '@@crear_respaldo@@' ><i class='glyphicon glyphicon-folder-open'></i></button><button type='button'  class='cargarrespaldo btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@cargar_respaldo@@'><i class='glyphicon glyphicon-open'></i></button>";
                    break;
                case 3:
                    $botones              =    "<button type='button' class='activaridioma btn btn-icon waves-effect waves-light btn-success m-b-5' title = '@@activar@@'><i class=' md-settings-power' ></i></button><button type='button' class='crearrespaldo btn btn-icon waves-effect waves-light btn-purple m-b-5' title = '@@crear_respaldo@@' ><i class='glyphicon glyphicon-folder-open'></i></button><button type='button'  class='cargarrespaldo btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@cargar_respaldo@@'><i class='glyphicon glyphicon-open'></i></button>";
                    break;
                case 4:
                    $botones              =    "<button type='button' class='activaridioma btn btn-icon waves-effect waves-light btn-success m-b-5' title = '@@activar@@'><i class=' md-settings-power' ></i></button><button type='button' class='crearrespaldo btn btn-icon waves-effect waves-light btn-purple m-b-5' title = '@@crear_respaldo@@' ><i class='glyphicon glyphicon-folder-open'></i></button><button type='button'  class='cargarrespaldo btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@cargar_respaldo@@'><i class='glyphicon glyphicon-open'></i></button>";
                    break;
                case 5:
                    $botones              =    "<button type='button' class='habilitartraduccion btn btn-icon waves-effect waves-light btn-warning m-b-5' title = '@@habilitar@@'><i class='ion-arrow-graph-up-right'></i></button>";
                    break;
            }
            $botones = traducirstring($botones, "../idiomas/" . $_SESSION['idioma'] . "/" . $_SESSION['idioma'] . ".php");
            $arreglo["data"][]            =    array(
                "id_idioma_pk"            =>   $valor['id_idioma_pk'],
                "nombre_idioma"           =>   $nombre_idioma,
                "id_estado_idioma_pk"     =>   $valor['id_estado_idioma_pk'],
                "nombre_estado"           =>   $valor['nombre_estado'],
                "porcentaje_traduccion"   =>   $porcentaje_traduccion,
                "bandera"                 =>   "<a href='#'><img src = './img/banderas/" . $valor['id_idioma_pk'] . ".ico' /></a>",
                "botones"                 =>   $botones
            );
        }
        if (   sizeof($arreglo)           ==   0  ) {
            return '{
               "sEcho": 1,
               "iTotalRecords": "0",
               "iTotalDisplayRecords": "0",
               "aaData": []
             }';
        } else {
            return json_encode($arreglo);
        }
    }
    
    //arreglo_traducciones(), retorna un arreglo que se puede leer diferenciando entre las etiquetas traducidas y las no traducidas de un idioma
    public function arreglo_traducciones($id_idioma_pk) {
        $id                                                            =    $id_idioma_pk; 
        $array_raiz                                                    =    self::llenar_arreglo_idioma("es");
        $array_traduccion                                              =    self::llenar_arreglo_idioma($id);
        $etiquetas_traducidas                                          =    array();
        $etiquetas_sin_traducir                                        =    array();
        $arreglo_traducciones                                          =    array();
        $indice1                                                       =    0;
        $indico2                                                       =    0;
        $valores_igual_cualquier_idioma                                =    ["Excel", "PDF"];
        foreach (       $array_raiz         as   $key                  =>   $value    ) {
            foreach (   $array_traduccion   as   $key2                 =>   $value2   ) {
                if ( (($array_raiz[$key]["clave"]                      ==   $array_traduccion[$key2]["clave"]) 
                    && ( $array_raiz[$key]["valor"]                    !=   $array_traduccion[$key2]["valor"]))
                    || ( $array_raiz[$key]["valor"]                    ==   $array_traduccion[$key2]["valor"]
                        && in_array($array_traduccion[$key2]["valor"], $valores_igual_cualquier_idioma))) {
                    $etiquetas_traducidas[$key2]["clave"]              =    $array_traduccion[$key2]["clave"];
                    $etiquetas_traducidas[$key2]["valor"]              =    $array_traduccion[$key2]["valor"];
                    $etiquetas_traducidas[$key2]["v_original"]         =    $array_raiz[$key]["valor"];
                    break;
                } else {
                    if (   $array_raiz[$key]["clave"]                  ==   $array_traduccion[$key2]["clave"] 
                       &&  $array_raiz[$key]["valor"]                  ==   $array_traduccion[$key2]["valor"]  ) {
                        $etiquetas_sin_traducir[$key2]["clave"]        =    $array_traduccion[$key2]["clave"];
                        $etiquetas_sin_traducir[$key2]["valor"]        =    $array_traduccion[$key2]["valor"];
                        $etiquetas_sin_traducir[$key2]["v_original"]   =    $array_raiz[$key]["valor"];
                        break;
                    }
                }
            }
        }

        $id = 0;
        foreach (   $etiquetas_sin_traducir   as    $key         =>    $value  ) {
            $arreglo_traducciones[$id]["clave"]                  =     $etiquetas_sin_traducir[$key]["clave"];
            $arreglo_traducciones[$id]["valor"]                  =     $etiquetas_sin_traducir[$key]["valor"];
            $arreglo_traducciones[$id]["v_original"]             =     $etiquetas_sin_traducir[$key]["v_original"];
            $arreglo_traducciones[$id]["peso"]                   =     0;
            $arreglo_traducciones[$id]["id"]                     =     $id;
            $id++;
        }
        
        foreach ($etiquetas_traducidas as $key2                  =>    $value2) {
            $arreglo_traducciones[$id]["clave"]                  =     $etiquetas_traducidas[$key2]["clave"];
            $arreglo_traducciones[$id]["valor"]                  =     $etiquetas_traducidas[$key2]["valor"];
            $arreglo_traducciones[$id]["v_original"]             =     $etiquetas_traducidas[$key2]["v_original"];
            $arreglo_traducciones[$id]["peso"]                   =     1;
            $arreglo_traducciones[$id]["id"]                     =     $id;
            $id++;
        }
        return $arreglo_traducciones;
    }
    
    public function arreglo_respaldos_idioma($id_idioma) {
//        if (!(require '../funciones/funcion_traducir.php')) {
//            echo "hola";
//            require '../funciones/funcion_traducir.php';
//        }
        $arreglo = scandir("../idiomas/".$id_idioma."/repositorio/");
        $arreglo1 = array();
        
        unset($arreglo[0], $arreglo[1]);
        foreach ($arreglo as $key => $value) {
            $valor = explode(".", $value);
            $valor2 = $valor[0];
            $botones = traducirstring("<button type='button' onclick=cargar_respaldo_existente_idioma('".$value."'); class='btn btn-primary waves-effect w-md waves-light m-b-5'>@@cargar@@</button><a href='./idiomas/".$id_idioma."/repositorio/".$value." ' download><button type='button' class='btn btn-success waves-effect w-md waves-light m-b-5' >@@descargar@@</button></a>", "../idiomas/" . $_SESSION['idioma'] . "/" . $_SESSION['idioma'] . ".php");
            $arreglo1[$key]["nombre_archivo"] = $value;
            $arreglo1[$key]["fecha"] = date("d/m/y", filectime("../idiomas/".$id_idioma."/repositorio/".$value));
            $arreglo1[$key]["acciones"] = $botones;
            
        }
        return $arreglo1;
    }
    
    //traducir(), ejecuta la acción llevada a cabo por el voluntario de traducción de traducir una etiqueta.
    public function traduciridioma($idioma, $clave, $valor, $traducido) {
        $ruta                                           =    "../idiomas/".$idioma."/".$idioma.".php"; //echo $ruta."<br>";
        $contenido_idioma                               =    file_get_contents($ruta);
        $traduccion                                     =    str_replace("'".$clave."' => '".$valor."'", "'".$clave."' => '".$traducido."'", $contenido_idioma);
        $idioma_traduccion                              =    fopen($ruta, "w");
        //echo "clave: ".$clave."\n valor: ".$valor." \n  traducción:".$traducido."<br>";
        if(   fwrite($idioma_traduccion, $traduccion)   ==   false   ) {
            return false;
        }
        else {
            return true;
        }
        fclose($idioma_traduccion);
    }
    
    //Métodos privados 

    //llenar_arreglo, llena una matriz que contiene clave y valor para las etiquetas de un idioma dado
    private function llenar_arreglo($id_idioma_pk) { 
        $idioma                           = '../idiomas/' . $id_idioma_pk . '/' . $id_idioma_pk . '.php';
        require $idioma;
        $array                            =   array();
        $indice                           =   0;
        foreach (   $leng   as   $clave   =>  $valor) { //Por cada arreglo llamado leng que es el que contiene las etiquetas y su respectiva traducción...
            $array[$indice]["clave"]      =   $clave;
            $array[$indice]["valor"]      =   $valor;
            $indice++;
        }
        return $array;
    }
    
    //llenar_arreglo_idioma, luego de llenar el arreglo con el idioma, de ser distinto a el idioma raíz, verifica
    //si hay nuevas etiquetas no almacenadas en el ficehero correspondiente, de ser así, las escribe en el fichero
    //y vuelve a llenar el arreglo con las nuevas etiquetas almacenadas.
    private function llenar_arreglo_idioma($id_idioma_pk) {     
        $idioma_en_traduccion                                        =    "../idiomas/" . $id_idioma_pk . "/" . $id_idioma_pk . ".php";
        $idioma_raiz                                                 =    "../idiomas/es/es.php";
        $array_raiz                                                  =    array();
        $array_traduccion                                            =    array();
        $contenido_idioma_raiz                                       =    file_get_contents($idioma_raiz);
        $contenido_idioma_traduccion                                 =    file_get_contents($idioma_en_traduccion);
        if (   $idioma_raiz                                          ==   $idioma_en_traduccion) {
            $array_raiz                                              =    self::llenar_arreglo("es");
            return $array_raiz;
        } 
        else {
            if (file_exists($idioma_en_traduccion)) {
                $array_raiz                                          =   self::llenar_arreglo("es"); // Llenando el arreglo que contiene los valores del Iidoma raíz del sistema
                $array_traduccion                                    =   self::llenar_arreglo($id_idioma_pk); // Llenando el arreglo que contiene los valores del Iidoma en traducción del sistema
                //Verificar si existen nuevas etiquetas
                if (count($array_raiz) >= count($array_traduccion)) {
                    $nuevas_etiquetas                                =    "";
                    $contador2 = 0;
                    $indice                                          =    0;
                    foreach (   $array_raiz             as   $key    =>   $value   ) {
                        $contador                                    =    0;
                        foreach (   $array_traduccion   as   $key2   =>   $value2   ) {
                            if (   $array_raiz[$key]["clave"]        ==   $array_traduccion[$key2]["clave"]) {
                                $contador++; //echo $key;
                            }
                        }
                        if (   $contador                             ==   0   ) {
                            $contador2++;
                            $nuevas_etiquetas                        .=   "    '" . $array_raiz[$key]["clave"] . "' => '" . $array_raiz[$key]["valor"] . "',\r\n";
                        }
                    }
                    if (   $contador2    >    0  ) {
                        $nueva_pagina                                =   str_replace(");", ",\r\n" . $nuevas_etiquetas .");", $contenido_idioma_traduccion);
                        $nueva_pagina                                =   str_replace("',\r\n);", "');", $nueva_pagina);
                        $idioma_traduccion                           =   fopen($idioma_en_traduccion, "w");
                        fwrite($idioma_traduccion, $nueva_pagina);
                        fclose($idioma_traduccion);
                        $array_traduccion                            = self::llenar_arreglo($id_idioma_pk);
                    }
                    return $array_traduccion;
                }
                else {
                    return $array_traduccion;
                }
            }
        }
    }
    
    //porcentaje_traduccion, calcula el porcentaje de traducción que lleva un determinado idioma en proceso.
    private function porcentaje_traduccion($id_idioma_pk) {
        $idioma_raiz = "../idiomas/es/es.php";
        $idioma_en_traduccion                                      =    "../idiomas/" . $id_idioma_pk . "/" . $id_idioma_pk . ".php";
        if (   $idioma_raiz                                        ==   $idioma_en_traduccion) {
            return "100%";
        } else {
            if (file_exists($idioma_en_traduccion)) {
                $array_raiz                                        =    self::llenar_arreglo_idioma("es");
                $array_traduccion                                  =    self::llenar_arreglo_idioma($id_idioma_pk);
                $etiquetas_sin_traducir                            =    count($array_raiz);
                $etiquetas_traducidas                              =    0;
                foreach (       $array_raiz         as   $clave    =>   $valor) {
                    foreach (   $array_traduccion   as   $clave2   =>   $valor2   ) {
                        if ($array_raiz[$clave]["clave"]           ==   $array_traduccion[$clave2]["clave"] && $array_raiz[$clave]["valor"] != $array_traduccion[$clave2]["valor"]) {
                            $etiquetas_traducidas++;
                        }
                    }
                }
                return (round($etiquetas_traducidas / $etiquetas_sin_traducir * 100, 1, PHP_ROUND_HALF_ODD)) . "%";
            } else {
                return "0%";
            }
        }
    }
     /**
     * ALEXIS ESCOTO 
     * 13-02-2023
     * SELECT CON METODO PDO
     */
    
    private function enviarcorreosuperusuarios($asunto, $mensaje, $idioma) {
        $pdo = $this->base->abrir_conexion();  
        $arreglo = $pdo->query("SELECT e.correo FROM tbl_usuario a, tbl_persona b,  tbl_tipo_usuario c, tbl_usuario_tipo_usuario d, tbl_correo e
                                WHERE a.id_persona_fk = b.id_persona_pk AND a.id_usuario_pk = d.id_usuario_fk AND c.id_tipo_usuario_pk = d.id_tipo_usuario_fk AND b.id_persona_pk = e.id_persona_fk
                                AND d.id_tipo_usuario_fk = 2");
        $str = "";
        foreach ($arreglo as $value) {
            $str .= $value['correo'] . ", ";
        }
        $correos = substr($str, 0, strlen($str) - 2);
        $time = time();
        $fecha = date("Y-m-d", $time);
        $remite_nombre = "SISTEMA DE GESTIÓN DE CONGRESOS IIES-UNAH";
        $remite_email = "admin@ceat-unah.org"; 
        $cabeceras = "From: " . $remite_nombre . " <" . $remite_email . ">\r\n";
        $cabeceras .= "Mime-Version: 1.0\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $enviar_email = mail($correos, $asunto, $mensaje, $cabeceras);
    }
      /**
     * ALEXIS ESCOTO 
     * 13-02-2023
     * SELECT CON METODO PDO
     */
    private function nombreidioma($id_idioma_pk) {
        $pdo = $this->base->abrir_conexion();  
        $cn_idioma = $pdo->query("SELECT nombre_idioma FROM tbl_idioma WHERE id_idioma_pk = '".$id_idioma_pk."'");
        $nombre_idioma = "";
        foreach ($cn_idioma as $valor) {
            $temp = $valor['nombre_idioma'];
            $temp2 = explode(";", $temp);
            $nombre_idioma .= $temp2[0];
            break;
        }
        return $nombre_idioma;
    }

}

