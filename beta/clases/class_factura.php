<?php

/*
  Brayan Triminio
  05-9-2017
  
 */

require_once 'class_base.php';

class factura{
    /********************Datos para guardar tour********************************/
    private $id_tour_pk;
    private $nombre_tour;
    private $descripcion;
    private $comentario;
    private $costo;
    private $Impuesto;
    private $creado_por;
    private $fecha_creacion;
    private $modificado_por;
    private $fecha_modificacion;
    
    /********************Datos para guardar articulo (tbl_costo)****************/
    private $id_costo_pk ;
    private $producto ;
    private $precio_unitario;
    private $grabado_exento;
    private $id_congreso_fk;
    
    /****************Datos para guardar detalle factura (tbl_factura_detalle)***/
    private $id_factura_detalle_pk;
    private $id_factura_fk;
    private $cantidad_adquirida;
    private $fecha;
    private $total_pagar;
    
    /****************Dato para guardar costo_x_usuario (tbl_costo_x_usuario) y tour por usuario (tbl_tour_usuario)***/
    private $idusuario;
    private $id_tour_usuario_pk;




    public function __construct() {
        $this->base = new basedatos();
       
    }



    public function inicia_tour($id_tour_pk,$nombre_tour,$descripcion,$comentario,$costo, $Impuesto,$creado_por,$fecha_creacion,$modificado_por,$fecha_modificacion){
        $this->id_tour_pk       = $id_tour_pk;
        $this->nombre_tour      = $nombre_tour;
        $this->descripcion      = $descripcion;
        $this->comentario       = $comentario;
        $this->costo            = $costo;
        $this->Impuesto         = $Impuesto;
        $this->creado_por       = $creado_por;
        $this->fecha_creacion   = $fecha_creacion;
        $this->modificado_por   = $modificado_por;
        $this->fecha_modificacion=$fecha_modificacion;

        
    }
    

        //PDO crear registro de Tour
    public function crear_tour(){
        $pdo = $this->base->abrir_conexion(); 
        $datos   =   $pdo->prepare("INSERT INTO tbl_tour(id_tour_pk, nombre_tour, descripcion, comentario, costo,Impuesto,creado_por, fecha_creacion, modificado_por, fecha_modificacion) VALUE (?,?,?,?,?,?,?,?,?,?)");
        
        $resultado=$datos->execute([$this->id_tour_pk,  $this->nombre_tour,  $this->descripcion, $this->comentario , 
        $this->costo, $this->Impuesto,$this->creado_por, $this->fecha_creacion,  
        $this->modificado_por,  $this->fecha_modificacion]);
  
	
       
    }
    
    public function inf_tour($id){
       $pdo = $this->base->abrir_conexion(); 
      //  $bdd = new basedatos();	
        return $bdd= $pdo->query("select * from tbl_tour where id_tour_pk ='".$id."' ");
    }
    
    public function inicia_modificar_tour($id_tour_pk,$nombre_tour,$descripcion,$comentario,$costo,$modificado_por,$fecha_modificacion){
        $this->id_tour_pk       = $id_tour_pk;
        $this->nombre_tour      = $nombre_tour;
        $this->descripcion      = $descripcion;
        $this->comentario       = $comentario;
        $this->costo            = $costo;
        $this->modificado_por   = $modificado_por;
        $this->fecha_modificacion=$fecha_modificacion;
    }

    public function modificar_tour(){
        /*
        $bdd = new basedatos();	
        return $bdd->update("update tbl_tour set nombre_tour=?, 
        descripcion=?, comentario=?, costo=?, modificado_por=?, fecha_modificacion=? 
        where id_tour_pk=?" ,'sssiisi',[$this->nombre_tour,  $this->descripcion, $this->comentario, 
        $this->costo,  $this->modificado_por, $this->fecha_modificacion, $this->id_tour_pk]);
*/
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("UPDATE tbl_tour set nombre_tour=?, 
        descripcion=?, comentario=?, costo=?, modificado_por=?, fecha_modificacion=? 
        where id_tour_pk=?");
      $resultado=$datos->execute([$this->nombre_tour,  $this->descripcion, $this->comentario, 
      $this->costo,  $this->modificado_por, date("y-m-d"), $this->id_tour_pk]);
    }
 /*Alexis Escoto 17/12/2022
    Cuenta:20161000817
    Creacion de SELECT mostrarfacturas
    SELECT con metodo PDO
    */
    function mostrarfacturas(){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("SELECT * From tbl_tour 
        ");
        return $datos;
     
    }
  
    
    public function inicia_guardar_articulo($id_costo_pk,$producto,$precio_unitario,$grabado_exento,$descripcion,$id_congreso_fk){
        $this->id_costo_pk      = $id_costo_pk;
        $this->producto         = $producto;
        $this->precio_unitario  = $precio_unitario;
        $this->grabado_exento   = $grabado_exento;
        $this->descripcion      = $descripcion;
        $this->id_congreso_fk   = $id_congreso_fk;
    }
    

    /*ALEXIS ESCOTO 11-01-2023
    Creacion de INSERT INTO en funcion guardar_articulo
    utilizando metodo PDO
    */
    public function guardar_articulo(){
        $pdo = $this->base->abrir_conexion();  
        $datos   = $pdo->prepare("INSERT INTO tbl_costo(id_costo_pk, producto, 
        precio_unitario, grabado_exento, descripcion,  id_congreso_fk) VALUE (?,?,?,?,?,?)");
        $resultado=$datos->execute([NULL, $this->producto,  $this->precio_unitario, 
        $this->grabado_exento , $this->descripcion, $this->id_congreso_fk]);
       

    }
    /*Alexis Escoto 17/12/2022
    Cuenta:20161000817
    Creacion de SELECT mostrararticulos
    SELECT con metodo PDO
    */
    function mostrararticulos(){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("SELECT * From tbl_costo 
        ");
        return $datos;
     
    } 
    public function inf_articulo($id){
        $pdo = $this->base->abrir_conexion();  
        //$bdd = new basedatos();	
         $datos= $pdo->query("select * from tbl_costo where id_costo_pk ='".$id."' ");
       
         return $datos;
    }
    /*17/12/ */
    public function modificar_articulo(){
        /*
        $bdd = new basedatos();	
        $array_old =$bdd->select("select * from tbl_costo where id_costo_pk ='$this->id_costo_pk' ") ;
        $set = 'set ' ;
        foreach ($array_old as $data){
            $producto = $data['producto'];
            $precio_unitario = $data['precio_unitario'];
            $grabado_exento = $data['grabado_exento'];
            $descripcion = $data['descripcion'];
            
            if($producto != $this->producto){
            $set .="producto =".$this->producto." ,"; 
            }

            if($precio_unitario != $this->precio_unitario){
                $set .="precio_unitario =".$this->precio_unitario.", ";
                $bdd->update("update tbl_costo set valor_antes=".$precio_unitario.", valor_despues = 
                ".$this->precio_unitario."  where id_costo_pk ='$this->id_costo_pk' ");
            }

            if($grabado_exento != $this->grabado_exento){
                $set .="grabado_exento =".$this->grabado_exento." ,";
            }

            if($descripcion != $this->descripcion){
                $set .="descripcion =".$this->descripcion." ,";
            }
        }
        
        $set=substr($set, 0, -2);
        
        if($set == "se"){
            return 1;
        }else{
            return $bdd->update("update tbl_costo $set where id_costo_pk ='$this->id_costo_pk' ");
        }
        */
        /*
        $pdo = $this->base->abrir_conexion(); 
        $array_old =$pdo->query("select * from tbl_costo where id_costo_pk ='".$this->id_costo_pk."' ") ;
        $set = 'set ' ;
        foreach ($array_old as $data){
            $producto = $data['producto'];
            $precio_unitario = $data['precio_unitario'];
            $grabado_exento = $data['grabado_exento'];
            $descripcion = $data['descripcion'];
            
            if($producto != $this->producto){
            $set .="producto =".$this->producto." ,"; 
            }

            if($precio_unitario != $this->precio_unitario){
                $set .="precio_unitario =".$this->precio_unitario.", ";
                $pdo = $this->base->abrir_conexion(); 
                $datos =  $pdo->prepare("update tbl_costo set valor_antes=?,valor_despues = ?  
                where id_costo_pk =?");
              $resultados=$datos->execute([$precio_unitario, $precio_unitario,$this->id_costo_pk]);


    
            }

            if($grabado_exento != $this->grabado_exento){
                $set .="grabado_exento =".$this->grabado_exento." ,";
            }

            if($descripcion != $this->descripcion){
                $set .="descripcion =".$this->descripcion." ,";
            }
        }
        
        $set=substr($set, 0, -2);
        
        if($set == "se"){
            return 1;
        }else{
            $pdo = $this->base->abrir_conexion(); 
            $datos =  $pdo->prepare("update tbl_costo where id_costo_pk =?");
            $resultados=$datos->execute([$set, $this->id_costo_pk]);
            return $resultados;
            */
            $pdo = $this->base->abrir_conexion();    
            $datos =  $pdo->prepare("UPDATE tbl_costo set producto=?, 
            precio_unitario=?, grabado_exento=?, descripcion=?
            where id_costo_pk=?");
          $resultado=$datos->execute([$this->producto,  $this->precio_unitario, 
          $this->grabado_exento , $this->descripcion, $this->id_congreso_fk]);
    
}
    public function inicia_guardar_detalle_factura($id_factura_detalle_pk,$id_factura_fk,$cantidad_adquirida,$fecha,$total_pagar){
        $this->id_factura_detalle_pk = $id_factura_detalle_pk;
        $this->id_factura_fk = $id_factura_fk;
        $this->cantidad_adquirida = $cantidad_adquirida;
        $this->fecha = $fecha;
        $this->total_pagar = $total_pagar;
    }
  /*ALEXIS ESCOTO 18-01-2023
    Creacion de INSERT tbl_factura_detalle en funcion guardar_detalle_factura
    utilizando metodo PDO
    */   
    public function guardar_detalle_factura(){
       /*
        $bdd = new basedatos();		
        return $bdd->insert("insert into tbl_factura_detalle(id_factura_detalle_pk, id_factura_fk,
         cantidad_adquirida, fecha, total_pagar) values (?,?,?,?,?)","iiisi",[$this->id_factura_detalle_pk, 
          $this->id_factura_fk,  $this->cantidad_adquirida, $this->fecha , $this->total_pagar],True);
          */
          $pdo = $this->base->abrir_conexion();      
          $datos   = $pdo->prepare("INSERT INTO tbl_factura_detalle(id_factura_detalle_pk, id_factura_fk,
          cantidad_adquirida, fecha, total_pagar) VALUE (?,?,?,?,?)");
          $resultado=$datos->execute([NULL, $this->id_factura_fk,  $this->cantidad_adquirida, date("y-m-d") , $this->total_pagar]);
          return $resultado;
         
    }
     /*ALEXIS ESCOTO 18-01-2023
    Creacion de SELECT tbl_factura_detalle en funcion ultimo_detalle_fact
    utilizando metodo PDO
    */
    public function ultimo_detalle_fact() {
    /*   $bdd = new basedatos();
     return $bdd->select("SELECT MAX(id_factura_detalle_pk) AS id_factura_detalle_pk FROM tbl_factura_detalle");  */
     $pdo = $this->base->abrir_conexion();  
     return $datos= $pdo->query("SELECT MAX(id_factura_detalle_pk) AS id_factura_detalle_pk FROM tbl_factura_detalle"); 
    }
    
    public function inicia_guardar_costo_x_usuario($id_costo_fk,$id_usuario_fk,$id_factura_detalle_fk){
        $this->id_costo_pk = $id_costo_fk;
        $this->idusuario = $id_usuario_fk;
        $this->id_factura_detalle_pk = $id_factura_detalle_fk;
    }
     /*ALEXIS ESCOTO 18-01-2023
    Creacion de INSERT tbl_costo_x_usuario en funcion gauardar_costo_usuario
    utilizando metodo PDO
    */
    public function gauardar_costo_usuario(){
        /*
        $bdd = new basedatos();		
        return $bdd->insert("insert into tbl_costo_x_usuario(id_costo_fk, id_usuario_fk, id_factura_detalle_fk) values (?,?,?)","iii",[$this->id_costo_pk,  $this->idusuario,  $this->id_factura_detalle_pk],True);
  */
        $pdo = $this->base->abrir_conexion();      
        $datos   = $pdo->prepare("INSERT INTO tbl_costo_x_usuario(id_costo_fk, id_usuario_fk, id_factura_detalle_fk) VALUE (?,?,?)");
        $resultado=$datos->execute([$this->id_costo_pk,$this->idusuario,  $this->id_factura_detalle_pk]);
        return $resultado;
    }
    
    public function inicia_guardar_tour_x_usuario($id_tour_usuario_pk,$id_tour_fk,$id_usuario_fk,$id_factura_detalle_fk){
        $this->id_tour_usuario_pk =$id_tour_usuario_pk;
        $this->id_tour_pk = $id_tour_fk;
        $this->idusuario = $id_usuario_fk;
        $this->id_factura_detalle_fk = $id_factura_detalle_fk;
    }
     /*ALEXIS ESCOTO 18-01-2023
    Creacion de INSERT tbl_tour_usuario en funcion gauardar_tour_usuario
    utilizando metodo PDO
    */
    public function gauardar_tour_usuario(){
       /* $bdd = new basedatos();		
        return $bdd->insert("insert into tbl_tour_usuario(id_tour_usuario_pk, id_tour_fk, id_usuario_fk, id_factura_detalle_fk) values (?,?,?,?)"
        ,"iiii",[$this->id_tour_usuario_pk,$this->id_tour_pk,  $this->idusuario,  $this->id_factura_detalle_pk],True);*/
        $pdo = $this->base->abrir_conexion();  
      $datos   = $pdo->prepare("INSERT INTO tbl_tour_usuario(id_tour_usuario_pk, id_tour_fk, id_usuario_fk, id_factura_detalle_fk)
         VALUE (?,?,?,?)");
        $resultado=$datos->execute([NULL,$this->id_tour_pk,  $this->idusuario,  $this->id_factura_detalle_pk]);
        return $resultado;
    }
    /*ALEXIS ESCOTO 13-02-2023
    Creacion de SELECT tbl_usuario_trabajo en funcion enviar_correo_usuario
    Creacion de SELECT tbl_congreso en funcion enviar_correo_usuario
    Creacion de SELECT tbl_usuario_trabajo en funcion enviar_correo_usuario
    utilizando metodo PDO
    */
    public function enviar_correo_usuario($idusuario, $idcongeso){
        /*
        $bdd = new basedatos();
        $resp = $bdd->select("Select id_trabajo_fk from tbl_usuario_trabajo where id_usuario_fk = ".$idusuario." ");
        $congre = $bdd->select("Select * from tbl_congreso where id_congreso_pk = ".$idcongeso." ");
        */
        $pdo = $this->base->abrir_conexion();  
        $resp = $pdo->query("Select id_trabajo_fk from tbl_usuario_trabajo where id_usuario_fk = ".$idusuario." ");
        $congre = $pdo->query("Select * from tbl_congreso where id_congreso_pk = ".$idcongeso." ");
        foreach ($resp as $valor){
            $idtabajo= $valor['id_trabajo_fk'];
        }
        
        foreach ($congre as $data){
            $congreso_act= $data['nombre_congreso'];
        }
        
        $trabajo = $pdo->query("Select * from tbl_usuario_trabajo a 
        join tbl_usuario b on b.id_usuario_pk = a.id_usuario_fk
        join tbl_persona c on c.id_persona_pk = b.id_persona_fk
        join tbl_correo d on d.id_persona_fk = c.id_persona_pk 
        join tbl_trabajo e on e.id_trabajo_pk = a.id_trabajo_fk
        where a.id_trabajo_fk = ".$idtabajo." ");
        
        foreach ($trabajo as $correo_coautores){
            $correo_enviar = $correo_coautores['correo'];
            $titulo_trabajo =  $correo_coautores['titulo_trabajo'];
                $titulo="FACTURA DIGITAL";  
                $mensaje="<html>"; 
                $mensaje.="<p>";
                $mensaje.="UNIVERSIDAD NACIONAL AUTÓNOMA DE HONDURAS (UNAH).";
                $mensaje.="</p><BR>";
                $mensaje.="<p>";
                $mensaje.="INSTITUTO DE INVESTIGACIONES ECONÓMICAS Y SOCIALES (IIES).";
                $mensaje.="</p>";
                //$mensaje.="<title></title";
                $mensaje.="<body>";
                $mensaje.="<p>";
                $mensaje.="Estimado(a)";
                $mensaje.="</p><BR>";
                $mensaje.="<p>";
                foreach ($congreso as $key) {
                $mensaje.="EL CONGRESO ".strtoupper($congreso_act)."<br>Le Comunica a usted lo siguiente:<br><br>";                                               
                }
                $mensaje.="Se ha registrado el pago de inscripción para el trabajo ".$titulo_trabajo." " 
                        . "<br>"
                        . "<br>Le invitamos a que ingrese nuestro Sitio WEB :<br> <a href='http://ceat-unah.org/' target='_blank'><b>INGRESAR AL SITIO</b></a>"
                        . "<br><br>";
                $mensaje.="</p>";
                $mensaje.="<p>";     
                $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
                $mensaje.="</p>";
                $mensaje.="</body>";
                $mensaje.="</html>";      
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                if( mail($correo_enviar, $titulo, $mensaje, $cabeceras)){
                    $enviomj = 1;
                }

            }
        
    }
     /*ALEXIS ESCOTO 13-02-2023

    Creacion de SELECT tbl_congreso en funcion enviar_detalle_factura
    Creacion de SELECT tbl_correo en funcion enviar_detalle_factura
    utilizando metodo PDO
    */
    public function enviar_detalle_factura($detalle, $persona, $cantidad, $total_a_pagar, $idcongeso){
        $a=0;
        $piezas = explode(',', $detalle);
        $html="";
        
        for($i=0; $i<count($piezas);$i++){
            if($piezas[$i]==" "){
            }else{
                if($a>0){
                    $html .="<td>".$piezas[$i]."</td>";
                }
                $val = intval($piezas[$i]);
                if(is_numeric($val) ){
                   if ($val == 0){
                   }else{
                       $re=$val/$val;
                        if (is_nan($re)){
                       }else{
                           if(($val<10)){
                               if($a==0){
                                   $html .= "<tr><td>". $piezas[$i];
                               }else{
                                   $html .= "</tr><tr><td>". $piezas[$i];
                               }
                               $a++;
                           }
                       }  
                   }
                    
               }
            }
        }
        $pdo = $this->base->abrir_conexion();  
        $congreso = $pdo->query("Select * from tbl_congreso where id_congreso_pk = ".$idcongeso." ");
        //echo $html;//detalle de la factura
      
        $correo_persona = $pdo->query("Select * from tbl_correo WHERE principal = 1  and id_persona_fk =".$persona." " );
        foreach ($correo_persona as $coreo){
            $mail_persona = $coreo['correo'];
        }
        $titulo="FACTURA DIGITAL";  
        $mensaje="<html>"; 
        $mensaje.="<p>";
        $mensaje.="UNIVERSIDAD NACIONAL AUTÓNOMA DE HONDURAS (UNAH).";
        $mensaje.="</p><BR>";
        $mensaje.="<p>";
        $mensaje.="INSTITUTO DE INVESTIGACIONES ECONÓMICAS Y SOCIALES (IIES).";
        $mensaje.="</p>";
        //$mensaje.="<title></title";
        $mensaje.="<body>";
        $mensaje.="<p>";
        $mensaje.="Estimado(a)";
        $mensaje.="</p><BR>";
        $mensaje.="<p>";
        foreach ($congreso as $key) {
        $mensaje.="EL CONGRESO ".strtoupper($key['nombre_congreso'])."<br>Le Comunica a usted lo siguiente:<br><br>";                                               
        }
        $mensaje.="Se ha registrado una compra con los siguientes artículos  ".strtoupper($html)." " 
                . "<br>Total a pagar ".$total_a_pagar." "
                . "<br>Cantidad de artículos ".$cantidad." "
                . "<br>Le invitamos a que ingrese nuestro Sitio WEB :<br> <a href='http://ceat-unah.org/' target='_blank'><b>INGRESAR AL SITIO</b></a>"
                . "<br><br>";
        $mensaje.="</p>";
        $mensaje.="<p>";     
        $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
        $mensaje.="</p>";
        $mensaje.="</body>";
        $mensaje.="</html>";      
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        if( mail($mail_persona, $titulo, $mensaje, $cabeceras)){
            $enviomj = 1;
        }
        
    }
    /*Alexis Escoto 17/01/2023
    Cuenta:20161000817
    Creacion de SELECT tbl_factura, dentro de la tbl_factura
    SELECT con metodo PDO

   
    */
    function tbl_factura(){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query("Select impuesto from tbl_factura
        ");
        return $datos;

    }
    /*Alexis Escoto 17/01/2023
    Cuenta:20161000817
    Creacion de SELECT tbl_costo, dentro de la tbl_costo
    SELECT con metodo PDO

   
    */
    function tbl_costo($id){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query("Select * from tbl_costo where id_costo_pk = '".$id."'
        ");
        return $datos;

    }
 /*Alexis Escoto 17/01/2023
    Cuenta:20161000817
    Creacion de SELECT tbl_tour, dentro de la tbl_tour
    SELECT con metodo PDO

   
    */
    function tbl_tour($idtour){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query("select * from tbl_tour where id_tour_pk = '".$idtour."'");
        return $datos;

    }
}

