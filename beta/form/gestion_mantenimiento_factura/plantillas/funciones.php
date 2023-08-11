<?php

/*
Funciones propias de la gestion de mantenimineto de facturas
 
*/
session_start();
switch ($_GET['caso']) {
    
    case 'guardar_tour':  
        guardar_tour();
        break; 
    
    case 'llenar_form':
        llenar_form();
        break;
    
    case 'modificar_tour':
        modificar_tour();
        break;
    
    case 'guardar_articulo':
        guardar_articulo();
        break;
    
    case 'llenar_articulos':
        llenar_articulos();
        break;
    
    case 'modificar_articulo':
        modificar_articulo();
        break;
}

function guardar_tour(){
    include '../../../clases/class_factura.php';
    $factura = new factura() ;
    $nombre_tour = filter_input(INPUT_POST, 'nombretour');
    $descripcion = filter_input(INPUT_POST, 'descripcion');
    $comentario = filter_input(INPUT_POST, 'comentario');
    $costo = filter_input(INPUT_POST, 'costo');
    $creado_por = $_SESSION['idusuario'];
    $fecha_creacion = date('Y-m-d');
    $Impuesto= filter_input(INPUT_POST, 'impuesto');
    $factura->inicia_tour(null, $nombre_tour, $descripcion, $comentario, $costo,$Impuesto ,$creado_por, $fecha_creacion, null, null);
    $respuesta =$factura->crear_tour() ;
    
    if($respuesta !=0){
        echo 1;
    }else{
        echo 0 ;
    }
}

function llenar_form(){
    include '../../../clases/class_factura.php';
    
    $idtour=$_POST['idtour'];
    
    $inftour= new factura();
    $datos = $inftour->inf_tour($idtour);
    
    $arreglo = array();
    
    foreach ($datos as $valor){
        $arreglo['id_tour_pk']=$valor['id_tour_pk'];
        $arreglo['nombre_tour']=$valor['nombre_tour'];
        $arreglo['descripcion']=$valor['descripcion'];
        $arreglo['comentario']=$valor['comentario'];
        $arreglo['costo']=$valor['costo'];
        $arreglo['Impuesto']=$valor['Impuesto'];
    }
    echo json_encode($arreglo);
}

function modificar_tour(){
    include '../../../clases/class_factura.php';
    $modificar_tour = new factura();
    
    $id_tour_pk = filter_input(INPUT_POST, 'idtour');
    $nombre_tour = filter_input(INPUT_POST, 'nombretour');
    $descripcion = filter_input(INPUT_POST, 'descripcion');
    $comentario = filter_input(INPUT_POST, 'comentario');
    $costo = filter_input(INPUT_POST, 'costo');
    $modificado_por = $_SESSION['idusuario'];
    $fecha_modificacion = date('Y-m-d');
    
    $modificar_tour->inicia_modificar_tour($id_tour_pk, $nombre_tour, $descripcion, $comentario, $costo, $modificado_por, $fecha_modificacion);
    $respuesta = $modificar_tour->modificar_tour();
    if($respuesta !=0){
        echo 1;
    }else{
        echo 0;
    }
    
}
 
  
function guardar_articulo(){
    include '../../../clases/class_factura.php';
    
    $guardar_articulo= new factura();
    
    $producto=filter_input(INPUT_POST, 'articulo');
    $precio_unitario=filter_input(INPUT_POST, 'precio');
    $grabado_exento=filter_input(INPUT_POST, 'impuesto');
    $descripcion=filter_input(INPUT_POST, 'descripcion');
    $id_congreso_fk=$_SESSION['idcongreso'];
   /*
  print_r($producto);
  print_r($precio_unitario);
  print_r($grabado_exento);
  print_r($descripcion);
  print_r($id_congreso_fk);*/
    $guardar_articulo->inicia_guardar_articulo(null, $producto, $precio_unitario, $grabado_exento, $descripcion, $id_congreso_fk);
    $respuesta =$guardar_articulo->guardar_articulo() ; 
    
    if($respuesta != 0){
        echo 1;
    }else{
        echo 0;
    }
}

function llenar_articulos(){
    include '../../../clases/class_factura.php';
    
    $idarticulo=$_POST['idarticulo'];
    
    $infarticulo= new factura();
    $datos = $infarticulo->inf_articulo($idarticulo);
    
    $arreglo = array();
    
    foreach ($datos as $valor){
       
        $arreglo['id_costo_pk']=$valor['id_costo_pk'];
        $arreglo['producto']=$valor['producto'];
        $arreglo['precio_unitario']=$valor['precio_unitario'];
        $arreglo['grabado_exento']=$valor['grabado_exento'];
        $arreglo['descripcion']=$valor['descripcion'];
    }
    echo json_encode($arreglo);
}

function modificar_articulo(){
    include '../../../clases/class_factura.php';
    
    $modificar_articulo= new factura();
    
    $id_costo_pk =filter_input(INPUT_POST, 'id');
    $producto=filter_input(INPUT_POST, 'nombre');
    $precio_unitario=filter_input(INPUT_POST, 'precio');
    $grabado_exento=filter_input(INPUT_POST, 'impuesto');
    $descripcion=filter_input(INPUT_POST, 'descripcion');
    $id_congreso_fk=$_SESSION['idcongreso'];
    
 print_r($id_costo_pk);
 print_r($producto);
 print_r($precio_unitario);
 print_r($grabado_exento);
 print_r($descripcion);
 print_r($id_congreso_fk);
    $modificar_articulo->inicia_guardar_articulo($id_costo_pk, $producto, $precio_unitario, $grabado_exento, $descripcion, $id_congreso_fk);
    $respuesta =$modificar_articulo->modificar_articulo() ; 

    if($respuesta != 0){
        echo 1;
    }else{
        echo 0;
    }
}