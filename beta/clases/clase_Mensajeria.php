<?php
/*
Alex Siboney Vargas Osorto
27-2-2017
alexv7142@gmail.com
Manejo y gestión de mensajería
*/

require_once 'class_base.php';



class Mensajeria {

    private $base;

    private $asunto;
    private $mensaje;
    private $idusuario;

 

    public function __construct() {
        $this->base = new basedatos();
    }
  
    public function tematica_inicializar($asunto, $mensaje, $idusuario) {
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
        $this->idusuario = $idusuario;
       
    }

     /**ALEXIS ESCOTO
      * 27-01-2023
      INSERT con metodo PDO

      */
    public function enviarmensaje() {
        /*
        $datos = $this->base->insert("insert into tbl_mensaje(asunto, contenido_mensaje, 
        fecha, hora, id_usuario_fk) values(?,?,?,?,?)", "ssssi", [$asunto, $mensaje, date("y-m-d"),
         date("H:i:s"), $usuario], TRUE);
        echo $datos;
*/
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("INSERT INTO tbl_mensaje(id_mensaje_pk ,asunto, contenido_mensaje, 
        fecha, hora, id_usuario_fk)
        VALUES (?,?,?,?,?,?)");

        $resultado=$datos->execute([NULL,$this->asunto, $this->mensaje, date("y-m-d"),
         date("H:i:s"), $_SESSION['idusuario']]);

        return $resultado;

    }
    /**ALEXIS ESCOTO
      * 27-01-2023
      INSERT con metodo PDO

      */
    public function responderenconversacion($contenido, $idconversacion, $usuario) {
       /*
        $datos_r = $this->base->insert("insert into 
        tbl_respuesta_mensaje(contenido_respuesta_mensaje, fecha, hora,
         id_mensaje_fk, id_usuario_fk) values(?,?,?,?,?)", "sssii",
          [$contenido, date("y-m-d"), date("H:i:s"), $idconversacion, $usuario], TRUE);
        echo $datos_r;*/
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("INSERT INTO tbl_respuesta_mensaje(id_respuesta_mensaje_pk,
        contenido_respuesta_mensaje,fecha,hora,id_mensaje_fk,id_usuario_fk)
        VALUES (?,?,?,?,?,?)");

        $resultado=$datos->execute([NULL,$contenido,date("y-m-d"),
         date("H:i:s"),$idconversacion, $usuario]);

        return $resultado;

    }
 /**ALEXIS ESCOTO
      * 27-01-2023
      SELECT con metodo PDO

      */
    public function gethtml($identificador) {
        $pdo = $this->base->abrir_conexion();  
        $html = "";
        if($identificador == 0){
            $mensajes = $pdo->query("SELECT nombre_usuario, id_mensaje_pk, asunto, contenido_mensaje, fecha, hora FROM tbl_usuario, tbl_mensaje WHERE id_usuario_pk = id_usuario_fk ORDER BY fecha DESC, hora DESC");
            $respuestas = $pdo->query("SELECT nombre_usuario, id_respuesta_mensaje_pk, contenido_respuesta_mensaje, fecha, hora, id_mensaje_fk FROM tbl_usuario, tbl_respuesta_mensaje WHERE id_usuario_pk = id_usuario_fk ORDER BY fecha DESC , hora ASC ");
        }else if($identificador == 1){
            $mensajes = $pdo->query("SELECT a.nombre_usuario, b.id_mensaje_pk, b.asunto, b.contenido_mensaje, b.fecha, b.hora FROM tbl_usuario a
                        join tbl_mensaje b on b.id_usuario_fk = a.id_usuario_pk
                        join tbl_usuario_congreso_roles c on c.id_usuario_fk = a.id_usuario_pk
                        join tbl_voluntario d on d.id_rol_congreso_fk = c.tbl_usuario_congreso_rol_pk 
                        ");
            $respuestas = $pdo->query("SELECT nombre_usuario, id_respuesta_mensaje_pk, contenido_respuesta_mensaje, fecha, hora, id_mensaje_fk FROM tbl_usuario, tbl_respuesta_mensaje WHERE id_usuario_pk = id_usuario_fk ORDER BY fecha DESC , hora ASC ");
        }
        
        $contador = 0;    //Este contador sirve para verificar si ya se terminó de imprimir todas las respuestas de un determinado mensaje, si esto es así, se imprime un pequeño formulario para añadir una respuesta a esa conversación.
        $id_rc = 0; //Esta variable sirve para identificar el fomulario al cual se hace referencia al momento de responder en una conversación.
        $id_msj = 0; //Esta variable sirve para identificar el mensaje al cual se hará referencia para darle respuesta.
        foreach ($mensajes as $linea => $valor) {
            $id_msj = $valor['id_mensaje_pk'];
            $html .= "<article class = 'timeline-item alt'>
                            <div class = 'timeline-desk'>
                               <div class = 'panel'>
                                   <div class = 'panel-body'>
                                       <span class = 'arrow-alt'></span>
                                       <span class = 'timeline-icon'></span>";
            if ($valor['asunto'] != '') {
                $html .= "<h4 class = 'text-success'><a href = '#usuario'>" . $valor['nombre_usuario'] . "</a> " . $valor['asunto'] . "</h4>";
                $html .= "<p class = 'timeline-date text-muted'>" . nl2br($valor['contenido_mensaje']) . "</p>";
            } 
            else {
                $html .= "<h4 class = 'text-seccess'><a href = '#usuario'>" . $valor['nombre_usuario'] . " </a></h4><br>
                          <p class = 'timeline-date text-muted'>" . nl2br($valor['contenido_mensaje']) . "</p>";
            }
            $html .= "<h4 class = 'text-warning'>" . $valor['fecha'] . "</h4>
                                       <p class = 'timeline-date text-muted'><small>" . $valor['hora'] . "</small></p>
                                    </div>
                                </div>
                            </div>
                         </article>";
            $html .= "<article class = 'timeline-item alt' >
                        <div class = 'timeline-desk'>
                           <div class = 'panel'>
                               <div class = 'panel-body' >
                                   <form enctype='multipart/form-data' method='POST' name='form_respuesta_mensaje_" . $id_msj . "'  id='form_respuesta_mensaje_" . $id_msj . "' class='form-horizontal form-bord <forered' data-parsley-validate='true'>
                                        <div class='form-group'>
                                            <div class='col-md-12'>
                                                <textarea name = 'respuesta_mensaje' id = 'respuesta_mensaje_$id_msj' class='form-control' rows='2'></textarea>
                                            </div>
                                        </div>
                                        <div class='form-group text-right m-b-0'>
                                            <button class='btn btn-primary waves-effect waves-light' type='button' id = boton_$id_msj name = boton_$id_msj onclick='responder_mensaje($id_msj);'>
                                                @@responder@@
                                            </button>
                                            <button type='reset' class='btn btn-default waves-effect waves-light m-l-5'>
                                                @@cancelar@@
                                            </button>
                                            <input type='hidden' name='caso_msj' id='caso_msj' value='responder_mensaje'/>
                                            <input type='hidden' name='id_mensaje' id='id_mensaje' value = '" . $valor['id_mensaje_pk'] . "' />
                                            <input type='hidden' name='caso_msj' id='caso_msj' value='responder_mensaje' />
                                        </div>
                                    </form>
                                </div>
                           </div>
                       </div>
                     </article><br><br>";
            foreach ($respuestas as $resp => $contenido) {
                if ($contenido['id_mensaje_fk'] == $valor['id_mensaje_pk']) {
                    $contador++;
                    $html .= " <article class = 'timeline-item' id = 'respuesta_" . $contenido['id_respuesta_mensaje_pk'] ."'>
                                    <div class = 'timeline-desk'>
                                       <div class = 'panel' style='background-color:rgb(193, 233, 250);'>
                                           <div class = 'panel-body'>
                                               <span class = 'arrow-alt'></span>
                                               <span class = 'timeline-icon'></span>
                                               <h4 class = 'text-success'><a href = '#usuario'>" . $contenido['nombre_usuario'] . "</a></h4>
                                               <p class = 'timeline-date text-muted'>" . nl2br($contenido['contenido_respuesta_mensaje']) . "</p><br>
                                               <h4 class = 'text-purple'>" . $contenido['fecha'] . "</h4>
                                               <p class = 'timeline-date text-muted'><small>" . $contenido['hora'] . "</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </article><br>";
                }
            }
            if ($contador > 0) {
                $id_rc++;
                $html .= "<article class = 'timeline-item'  >
                                <div class = 'timeline-desk'>
                                   <div class = 'panel'>
                                       <div class = 'panel-body'>
                                           <form enctype='multipart/form-data' method='POST' name='form_respuesta_conversacion_" . $id_rc . "'  id='form_respuesta_conversacion_" . $id_rc . "' class='form-horizontal form-bord <forered' data-parsley-validate='true'>
                                                <div class='form-group'>
                                                    <div class='col-md-12'>
                                                        <textarea name = 'respuesta_cv' id = 'respuesta_cv_$id_rc' class='form-control' rows='2'></textarea>
                                                    </div>
                                                </div>
                                                <div class='form-group text-right m-b-0'>
                                                    <button class='btn btn-primary waves-effect waves-light' type='button' id = boton_$id_rc name = $id_rc onclick='responder_en_conversacion($id_rc)'>
                                                        @@agregar_respuesta@@
                                                    </button>
                                                    <button type='reset' class='btn btn-default waves-effect waves-light m-l-5'>
                                                        @@cancelar@@
                                                    </button>
                                                    <input type='hidden' name='id' id='id' value='" . $id_rc . "'/>
                                                    <input type='hidden' name='id_conversacion' id='id_conversacion' value = '" . $valor['id_mensaje_pk'] . "' />
                                                    <input type='hidden' name='caso_rc' id='caso_rc' value='responder_en_conversacion' />
                                                </div>
                                            </form>
                                        </div>
                                   </div>
                               </div>
                         </article><br><br>";
                $contador = 0;
            }
        }

        return $html;
    }
    /**************************************************************************************************************************************************/
    /************************************************Mensajes para voluntarios*************************************************************************/
    /**************************************************************************************************************************************************/
     /**ALEXIS ESCOTO
      * 13-02-2023
      SELECT con metodo PDO

      */
    public function mensajesvoluntarios() {
        $html = "";
        $pdo = $this->base->abrir_conexion();  
        $mensajes = $pdo->query("select * from tbl_mensaje a 
                        join tbl_usuario_congreso_roles b on b.id_usuario_fk = a.id_usuario_fk
                        join tbl_usuario c on c.id_usuario_pk = a.id_usuario_fk
                        where b.id_rol_congreso_fk = 5  
                        ORDER BY fecha DESC, hora DESC");
        $respuestas = $pdo->query("SELECT nombre_usuario, id_respuesta_mensaje_pk, contenido_respuesta_mensaje, fecha, hora, id_mensaje_fk FROM tbl_usuario, tbl_respuesta_mensaje WHERE id_usuario_pk = id_usuario_fk ORDER BY fecha DESC , hora ASC ");
        $contador = 0;    //Este contador sirve para verificar si ya se terminó de imprimir todas las respuestas de un determinado mensaje, si esto es así, se imprime un pequeño formulario para añadir una respuesta a esa conversación.
        $id_rc = 0; //Esta variable sirve para identificar el fomulario al cual se hace referencia al momento de responder en una conversación.
        $id_msj = 0; //Esta variable sirve para identificar el mensaje al cual se hará referencia para darle respuesta.
        foreach ($mensajes as $linea => $valor) {
            $id_msj = $valor['id_mensaje_pk'];
            $html .= "<article class = 'timeline-item alt'>
                            <div class = 'timeline-desk'>
                               <div class = 'panel'>
                                   <div class = 'panel-body'>
                                       <span class = 'arrow-alt'></span>
                                       <span class = 'timeline-icon'></span>";
            if ($valor['asunto'] != '') {
                $html .= "<h4 class = 'text-success'><a href = '#usuario'>" . $valor['nombre_usuario'] . "</a> " . $valor['asunto'] . "</h4>";
                $html .= "<p class = 'timeline-date text-muted'>" . nl2br($valor['contenido_mensaje']) . "</p>";
            } 
            else {
                $html .= "<h4 class = 'text-seccess'><a href = '#usuario'>" . $valor['nombre_usuario'] . " </a></h4><br>
                          <p class = 'timeline-date text-muted'>" . nl2br($valor['contenido_mensaje']) . "</p>";
            }
            $html .= "<h4 class = 'text-warning'>" . $valor['fecha'] . "</h4>
                                       <p class = 'timeline-date text-muted'><small>" . $valor['hora'] . "</small></p>
                                    </div>
                                </div>
                            </div>
                         </article>";
            $html .= "<article class = 'timeline-item alt' >
                        <div class = 'timeline-desk'>
                           <div class = 'panel'>
                               <div class = 'panel-body' >
                                   <form enctype='multipart/form-data' method='POST' name='form_respuesta_mensaje_" . $id_msj . "'  id='form_respuesta_mensaje_" . $id_msj . "' class='form-horizontal form-bord <forered' data-parsley-validate='true'>
                                        <div class='form-group'>
                                            <div class='col-md-12'>
                                                <textarea name = 'respuesta_mensaje' id = 'respuesta_mensaje_$id_msj' class='form-control' rows='2'></textarea>
                                            </div>
                                        </div>
                                        <div class='form-group text-right m-b-0'>
                                            <button class='btn btn-primary waves-effect waves-light' type='button' id = boton_$id_msj name = boton_$id_msj onclick='responder_mensaje($id_msj);'>
                                                @@responder@@
                                            </button>
                                            <button type='reset' class='btn btn-default waves-effect waves-light m-l-5'>
                                                @@cancelar@@
                                            </button>
                                            <input type='hidden' name='caso_msj' id='caso_msj' value='responder_mensaje'/>
                                            <input type='hidden' name='id_mensaje' id='id_mensaje' value = '" . $valor['id_mensaje_pk'] . "' />
                                            <input type='hidden' name='caso_msj' id='caso_msj' value='responder_mensaje' />
                                        </div>
                                    </form>
                                </div>
                           </div>
                       </div>
                     </article><br><br>";
            foreach ($respuestas as $resp => $contenido) {
                if ($contenido['id_mensaje_fk'] == $valor['id_mensaje_pk']) {
                    $contador++;
                    $html .= " <article class = 'timeline-item' id = 'respuesta_" . $contenido['id_respuesta_mensaje_pk'] ."'>
                                    <div class = 'timeline-desk'>
                                       <div class = 'panel' style='background-color:rgb(193, 233, 250);'>
                                           <div class = 'panel-body'>
                                               <span class = 'arrow-alt'></span>
                                               <span class = 'timeline-icon'></span>
                                               <h4 class = 'text-success'><a href = '#usuario'>" . $contenido['nombre_usuario'] . "</a></h4>
                                               <p class = 'timeline-date text-muted'>" . nl2br($contenido['contenido_respuesta_mensaje']) . "</p><br>
                                               <h4 class = 'text-purple'>" . $contenido['fecha'] . "</h4>
                                               <p class = 'timeline-date text-muted'><small>" . $contenido['hora'] . "</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </article><br>";
                }
            }
            if ($contador > 0) {
                $id_rc++;
                $html .= "<article class = 'timeline-item'  >
                                <div class = 'timeline-desk'>
                                   <div class = 'panel'>
                                       <div class = 'panel-body'>
                                           <form enctype='multipart/form-data' method='POST' name='form_respuesta_conversacion_" . $id_rc . "'  id='form_respuesta_conversacion_" . $id_rc . "' class='form-horizontal form-bord <forered' data-parsley-validate='true'>
                                                <div class='form-group'>
                                                    <div class='col-md-12'>
                                                        <textarea name = 'respuesta_cv' id = 'respuesta_cv_$id_rc' class='form-control' rows='2'></textarea>
                                                    </div>
                                                </div>
                                                <div class='form-group text-right m-b-0'>
                                                    <button class='btn btn-primary waves-effect waves-light' type='button' id = boton_$id_rc name = $id_rc onclick='responder_en_conversacion($id_rc)'>
                                                        @@agregar_respuesta@@
                                                    </button>
                                                    <button type='reset' class='btn btn-default waves-effect waves-light m-l-5'>
                                                        @@cancelar@@
                                                    </button>
                                                    <input type='hidden' name='id' id='id' value='" . $id_rc . "'/>
                                                    <input type='hidden' name='id_conversacion' id='id_conversacion' value = '" . $valor['id_mensaje_pk'] . "' />
                                                    <input type='hidden' name='caso_rc' id='caso_rc' value='responder_en_conversacion' />
                                                </div>
                                            </form>
                                        </div>
                                   </div>
                               </div>
                         </article><br><br>";
                $contador = 0;
            }
        }

        return $html;
    }
}

?>
