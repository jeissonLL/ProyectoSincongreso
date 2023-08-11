<?php
/*
Clase Certificados
creado por:  OM
fecha: 24/02/17

*/
require_once 'class_base.php';
class certificados{

        private $id_certificado_pk;
	private $nombre_certificado;
	private $encabezado_certificado;
	private $motivo_certificado;
        private $pie_certificado;
        private $url_arte;
        private $certificado_especial;
        private $nombre_persona;
        private $rolvadirigido;
		
		

		/*Alexis Escoto 21/11/2022
    Funcion Contruct.
    Insert con metodo PDO
	
    */
		public function __construct() {
			$this->base = new basedatos();
			
		}
        public function cinicializar($id,$nombre,$encabezado,$motivo,$pie,$url,$certificado_especial,$nombre_persona,$rolvadirigido){
		$this->id_certificado_pk=$id;
		$this->nombre_certificado=$nombre;
                $this->encabezado_certificado=$encabezado;
		$this->motivo_certificado=$motivo;
                $this->pie_certificado=$pie;
                $this->url_arte=$url;
                $this->certificado_especial=$certificado_especial;
                $this->nombre_persona=$nombre_persona;
                $this->rolvadirigido = $rolvadirigido;
			
			
			
                
	}
        public function get_id(){
		return $this->id_certificado_pk;
	}
	/*Alexis Escoto 21/11/2022
    Creacion de Formulario  INSERT Tabla certficados.
    Insert con metodo PDO
	
    */
	public function insertar(){
		/*
		$bdd = new basedatos();		
		return $bdd->insert("insert into tbl_certificados(id_certificado_pk,nombre_certificado,
		encabezado_certificado,
		motivo_certificado,pie_certificado,url_arte,certificado_especial,nombre_persona,idrol_congreso) 
		values (?,?,?,?,?,?,?,?,?)",'sssssisi',[$this->nombre_certificado,$this->encabezado_certificado,
		$this->motivo_certificado, $this->pie_certificado, $this->url_arte, $this->certificado_especial, 
		$this->nombre_persona, $this->rolvadirigido],True);
*/
		$pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("INSERT INTO tbl_certificados(id_certificado_pk,nombre_certificado,
		encabezado_certificado,
		motivo_certificado,pie_certificado,url_arte,certificado_especial,nombre_persona,idrol_congreso)
        VALUES (?,?,?,?,?,?,?,?,?)");

        $resultado=$datos->execute([NULL,$this->nombre_certificado, $this->encabezado_certificado,  
        $this->motivo_certificado,$this->pie_certificado,  $this->url_arte,
        $this->certificado_especial, $this->nombre_persona,  $this->rolvadirigido]);

		$datos =  $pdo->prepare("INSERT INTO tbl_log(id_log_pk,id_usuario_fk, fecha, hora, ip,
		informacion_extra,  id_tipo_log_fk) VALUES (?,?,?,?,?,?,?)");
		$resultado=$datos->execute([NULL,$_SESSION['idusuario'], date("y-m-d"), date('H:i:s'),
		$_SERVER['REMOTE_ADDR'], "Ingreso de un certificado información básica del Congreso" ,2]);
	}

	public function mostrarCertificado() {
		$datos = $this->base->select("SELECT * FROM tbl_certificados"); 
		return $datos;
	}
	
	public function modificar(){	
		/*Alexis Escoto 23/11/2022
    Creacion de Formulario  UPDATE Tabla certficados.
    Insert con metodo PDO
	
    */
		/*	
		$bdd = new basedatos();

		return $bdd->update("UPDATE tbl_certificados set nombre_certificado=?,
		encabezado_certificado=?,motivo_certificado=?,pie_certificado=?,url_arte=?,
		 certificado_especial=?, nombre_persona=?, idrol_congreso=?  where id_certificado_pk=?",
		 'sssssisii',[$this->nombre_certificado,$this->encabezado_certificado,$this->motivo_certificado, 
		 $this->pie_certificado, $this->url_arte,  $this->certificado_especial, $this->nombre_persona,
		  $this->rolvadirigido,  $this->id_certificado_pk]);
*/
		  $pdo = $this->base->abrir_conexion();    
		  $datos =  $pdo->prepare("UPDATE tbl_certificados set nombre_certificado=?,
		encabezado_certificado=?,motivo_certificado=?,pie_certificado=?,url_arte=?,
		 certificado_especial=?, nombre_persona=?, idrol_congreso=?  where id_certificado_pk=?");
		$resultado=$datos->execute([$this->nombre_certificado,$this->encabezado_certificado,
		$this->motivo_certificado, 
		$this->pie_certificado, $this->url_arte,  $this->certificado_especial, $this->nombre_persona,
		 $this->rolvadirigido,  $this->id_certificado_pk]);

    


        }
				/*Alexis Escoto 02/01/2023
    Creacion de Formulario  DELETE Tabla certficados.
    DELETE con metodo PDO 
	
    */
	public function eliminar(){		
		/*
		$bdd = new basedatos();
		return $bdd->delete("delete from tbl_certificados where id_certificado_pk=?",'i',[$this->id_certificado_pk]);
		*/
	
		$pdo = $this->base->abrir_conexion(); 
		$datos =  $pdo->prepare("DELETE FROM tbl_certificados WHERE id_certificado_pk=?");
		$datos->execute([$this->id_certificado_pk]); 
	}


				/*Alexis Escoto 02/01/2023
    Creacion de Formulario  DELETE Tabla tbl_usuario_firma_certificado.
    DELETE con metodo PDO 
	
    */
        public function eusuariofirman(){
              /*
			$bdd = new basedatos();
		return $bdd->delete('delete from tbl_usuario_firma_certificado where id_certificado_pk=?','i',[$this->id_certificado_pk]);
		$pdo->prepare("DELETE FROM users WHERE id=?")->execute([$id]);*/
		$pdo = $this->base->abrir_conexion(); 
		$datos =  $pdo->prepare("DELETE FROM tbl_usuario_firma_certificado WHERE id_certificado_pk=?");
		$datos->execute([$this->id_certificado_pk]); 
        }


	
		    /*Alexis Escoto 05/12/2022
    Cuenta:20161000817
    Creacion de select_origen_certificados
    SELECT con metodo PDO
    */
    function select_origen_certificados(){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("SELECT * FROM tbl_persona");
        return $datos;
     
    }
				    /*Alexis Escoto 02/01/2023
    Cuenta:20161000817
    Creacion de select  tbl_certificados
    SELECT con metodo PDO
    */
    function tbl_certificados($idcertificado){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("SELECT * FROM tbl_certificados where id_certificado_pk='".$idcertificado."'");
        return $datos;
     
	}

				    /*Alexis Escoto 02/01/2023
    Cuenta:20161000817 Creaci
    Creacion de select  tbl_usuario_firma_certificado
    SELECT con metodo PDO
    */
    function tbl_usuario_firma_certificado($idcertificado){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("SELECT * FROM tbl_usuario_firma_certificado where id_certificado_pk='".$idcertificado."'");
        return $datos;
		
	}
		
}