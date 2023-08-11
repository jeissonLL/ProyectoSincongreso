<?php
require 'class_base.php';
/*FORMAS DE USO DE LA CLASE BD
-LOS PARAMETROS ESTAN REPRESENTADOS POR ? EN LAS CONSULTAS
-LA PARAMETRIZACION SE PUEDE O NO  UTILIZAR DEPENDIENDO DEL PROGRAMADOR AÑADIENDO EL SEGUNDO PARAMETRO (CADENA DE TIPOS)Y TERCER PARAMETRO (ARREGLO DE VARIABLES) A LA FUNCION
-SELECT DEVUELVE UN ARREGLO CON LOS ELEMENTOS DE LA BD  ASOCIADO POR NOMBRE DE COLUMNA
-UPDATE,DELETE, INSERT DEVUELVE EL NUMERO DE FILAS AFECTADAS. -1 EN CASO DE ERROR.
--SI SE AGREGA UN CUARTO PARAMETRO BOOLEANO TRUE AL METODO INSERT DEVUELVE EL LAST_INSERT_ID()
-LAS FUNCIONES ABREN Y CIERRAN LA CONEXION AUTOMATICAMENTE*/
/*
Tipos de datos bind_param()
i: entero
d: double
s: string
b: blob
*/

/*EJEMPLOS*/
$bdd = new basedatos();

$datos=$bdd->select('select * from prueba2');
foreach ($datos as $fila) {
	echo $fila['id'].$fila['fecha'];
	echo '<br><br><br>';
}

$bdd->update('update prueba2 set fecha=? where fecha="2017-02-19"','s',['2017-02-22']);

$bdd->delete('delete from prueba2 where fecha=?','s',['2017-02-22']);

$bdd->insert("insert into prueba2(fecha) values (?),(?),(?),(?)","ssss",['2017-02-22','2017-02-22','2017-02-22','2017-02-22'],True);

 ?>