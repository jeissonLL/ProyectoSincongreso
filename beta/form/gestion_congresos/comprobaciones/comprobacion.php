<?php

$funcion = $_POST['caso'];
require '../../../clases/class_base.php';
session_start();

switch ($funcion) {
    case 'nombre_congreso':
        nombre_congreso();
        break;
    case 'siglas':
        siglas();
        break;
    case 'abreviacion_linea':
        verificarabreviacionlinea();
        break;
    case 'abreviacion_tematica':
        verificarabreviaciontematica();
        break;
    case 'nombre_linea':
        verificarnombrelinea();
        break;
    case 'nombre_tematica':
        verificarnombretematica();
        break;
    case 'comprobar_eliminacion_linea':
        comprobar_eliminacion_linea();
        break;
    case 'comprobar_modificacion_linea':
        comprobar_modificacion_linea();
        break;
    case 'comprobar_eliminacion_tematica':
        comprobar_eliminacion_tematica();
        break;
}

function nombre_congreso() {
    require "./../../../clases/clase_Congreso.php";
    $nombre_congreso = filter_input(INPUT_POST, 'nombre_Congreso');
    $congreso = new Congreso();
    $congreso->cinicializar5($nombre_congreso);
    if ($congreso->nombre_repetido()) {
        echo "false";
    } else {
        echo "true";
    }
}

function siglas() {
    require "./../../../clases/clase_Congreso.php";
    ;
    $siglas = filter_input(INPUT_POST, 'siglas');
    $caso_congreso = filter_input(INPUT_POST, 'caso_congreso');
    $congreso = new Congreso();
    $congreso->cinicializar4($siglas);
    if ($caso_congreso == "modificar_congreso") {
        if ($congreso->siglas_repetidas()) {
            echo "true";
        }
    } else {
        if ($congreso->siglas_repetidas()) {
            echo "false";
        } else {
            echo "true";
        }
    }
}

function traducir_botones() {
    require '../../../funciones/funcion_traducir.php';
    $varianle = filter_input(INPUT_POST, "botones");
}

function verificarabreviacionlinea() {
    global $base;
    $base = new basedatos();
    $valor = strtolower(trim(filter_input(INPUT_POST, 'valor')));
    $id_linea = filter_input(INPUT_POST, 'id');
    $caso_linea = filter_input(INPUT_POST, 'caso_linea');
    if ($caso_linea == 'modificar_linea') {
        $dato = $base->select("SELECT a.abreviacion 
                                FROM tbl_linea_investigacion a, tbl_congreso_linea_investigacion b
                                WHERE a.abreviacion = '" . $valor . "' AND a.id_linea_investigacion_pk =" . $id_linea . " AND
                                      a.id_linea_investigacion_pk = b.id_linea_investigacion_pk AND
                                      b.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
        $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
        if (strtolower(trim($fila['abreviacion'])) == $valor) {
            echo "true";
        } else {
            $dato = $base->select("SELECT a.abreviacion 
                                    FROM tbl_linea_investigacion a, tbl_congreso_linea_investigacion b
                                    WHERE a.id_linea_investigacion_pk = b.id_linea_investigacion_pk AND
                                          a.abreviacion = '" . $valor . "' AND a.id_linea_investigacion_pk !=" . $id_linea . " AND
                                          b.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
            $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
            if (strtolower(trim($fila['abreviacion'])) == $valor) {
                echo "false";
            } else {
                echo "true";
            }
        }
    } else {
        $dato = $base->select("SELECT a.abreviacion 
                                FROM tbl_linea_investigacion a, tbl_congreso_linea_investigacion b
                                WHERE a.id_linea_investigacion_pk = b.id_linea_investigacion_pk AND
                                      a.abreviacion = '" . $valor . "' AND
                                      b.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
        $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
        if (strtolower(trim($fila['abreviacion'])) == $valor) {
            echo "false";
        } else {
            echo "true";
        }
    }
}

function verificarnombrelinea() {
    global $base;
    $base = new basedatos();
    $valor = strtolower(trim(filter_input(INPUT_POST, 'valor')));
    $id_linea = filter_input(INPUT_POST, 'id');
    $caso_linea = filter_input(INPUT_POST, 'caso_linea');
    if ($caso_linea == 'modificar_linea') {
        $dato = $base->select("SELECT a.nombre_linea_investigacion
                                FROM tbl_linea_investigacion a, tbl_congreso_linea_investigacion b
                                WHERE a.nombre_linea_investigacion = '" . $valor . "' AND a.id_linea_investigacion_pk =" . $id_linea . " AND
                                      a.id_linea_investigacion_pk = b.id_linea_investigacion_pk AND
                                      b.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
        $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
        if (strtolower(trim($fila['nombre_linea_investigacion'])) == $valor) {
            echo "true";
        } else {
            $dato = $base->select("SELECT a.nombre_linea_investigacion
                                    FROM tbl_linea_investigacion a, tbl_congreso_linea_investigacion b
                                    WHERE a.id_linea_investigacion_pk = b.id_linea_investigacion_pk AND
                                          a.nombre_linea_investigacionn = '" . $valor . "' AND a.id_linea_investigacion_pk !=" . $id_linea . " AND
                                          b.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
            $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
            if (strtolower(trim($fila['nombre_linea_investigacion'])) == $valor) {
                echo "false";
            } else {
                echo "true";
            }
        }
    } else {
        $dato = $base->select("SELECT a.nombre_linea_investigacion 
                                FROM tbl_linea_investigacion a, tbl_congreso_linea_investigacion b
                                WHERE a.id_linea_investigacion_pk = b.id_linea_investigacion_pk AND
                                      a.nombre_linea_investigacion = '" . $valor . "' AND
                                      b.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
        $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
        if (strtolower(trim($fila['nombre_linea_investigacion'])) == $valor) {
            echo "false";
        } else {
            echo "true";
        }
    }
}

function verificarabreviaciontematica() {
    global $base;
    $base = new basedatos();
    $valor = strtolower(trim(filter_input(INPUT_POST, 'valor')));
    $id_tematica = filter_input(INPUT_POST, 'id');
    $caso_tematica = filter_input(INPUT_POST, 'caso_tematica');
    if ($caso_tematica == 'modificar_tematica') {
        $dato = $base->select("SELECT a.abreviacion 
                                 FROM tbl_tematica a, tbl_linea_investigacion b, tbl_congreso_linea_investigacion c
                                 WHERE a.id_linea_investigacion_fk = b.id_linea_investigacion_pk AND
                                       b.id_linea_investigacion_pk = c.id_linea_investigacion_pk AND
                                       a.abreviacion = '" . $valor . "' AND a.id_tematica_pk =" . $id_tematica . " AND
                                       c.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
        $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
        if (strtolower(trim($fila['abreviacion'])) == $valor) {
            echo "true";
        } else {
            $dato = $base->select("SELECT a.abreviacion 
                                    FROM tbl_tematica a, tbl_linea_investigacion b, tbl_congreso_linea_investigacion c
                                    WHERE a.id_linea_investigacion_fk = b.id_linea_investigacion_pk AND
                                       b.id_linea_investigacion_pk = c.id_linea_investigacion_pk AND
                                       a.abreviacion = '" . $valor . "' AND a.id_tematica_pk =!" . $id_tematica . " AND
                                       c.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
            $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
            if (strtolower(trim($fila['abreviacion'])) == $valor) {
                echo "false";
            } else {
                echo "true";
            }
        }
    } else {
        $dato = $base->select("SELECT a.abreviacion 
                                 FROM tbl_tematica a, tbl_linea_investigacion b, tbl_congreso_linea_investigacion c
                                 WHERE a.id_linea_investigacion_fk = b.id_linea_investigacion_pk AND
                                       b.id_linea_investigacion_pk = c.id_linea_investigacion_pk AND
                                       a.abreviacion = '" . $valor . "' AND
                                       c.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
        $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
        if (strtolower(trim($fila['abreviacion'])) == $valor) {
            echo "false";
        } else {
            echo "true";
        }
    }
}

function verificarnombretematica() {
    global $base;
    $base = new basedatos();
    $valor = strtolower(trim(filter_input(INPUT_POST, 'valor')));
    $id_tematica = filter_input(INPUT_POST, 'id');
    $caso_tematica = filter_input(INPUT_POST, 'caso_tematica');
    if ($caso_tematica == 'modificar_tematica') {
        $dato = $base->select("SELECT a.nombre_tematica 
                                 FROM tbl_tematica a, tbl_linea_investigacion b, tbl_congreso_linea_investigacion c
                                 WHERE a.id_linea_investigacion_fk = b.id_linea_investigacion_pk AND
                                       b.id_linea_investigacion_pk = c.id_linea_investigacion_pk AND
                                       a.nombre_tematica  = '" . $valor . "' AND a.id_tematica_pk =" . $id_tematica . " AND
                                       c.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
        $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
        if (strtolower(trim($fila['nombre_tematica'])) == $valor) {
            echo "true";
        } else {
            $dato = $base->select("SELECT a.nombre_tematica 
                                    FROM tbl_tematica a, tbl_linea_investigacion b, tbl_congreso_linea_investigacion c
                                    WHERE a.id_linea_investigacion_fk = b.id_linea_investigacion_pk AND
                                       b.id_linea_investigacion_pk = c.id_linea_investigacion_pk AND
                                       a.nombre_tematica = '" . $valor . "' AND a.id_tematica_pk !=" . $id_tematica . " AND
                                       c.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
            $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
            if (strtolower(trim($fila['nombre_tematica'])) == $valor) {
                echo "false";
            } else {
                echo "true";
            }
        }
    } else {
        $dato = $base->select("SELECT a.nombre_tematica 
                                 FROM tbl_tematica a, tbl_linea_investigacion b, tbl_congreso_linea_investigacion c
                                 WHERE a.id_linea_investigacion_fk = b.id_linea_investigacion_pk AND
                                       b.id_linea_investigacion_pk = c.id_linea_investigacion_pk AND
                                       a.nombre_tematica = '" . $valor . "' AND
                                       c.id_congreso_pk =" . $_SESSION['idcongreso'] . "");
        $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
        if (strtolower(trim($fila['nombre_tematica'])) == $valor) {
            echo "false";
        } else {
            echo "true";
        }
    }
}

function comprobar_eliminacion_linea() {
    global $base;
    $base = new basedatos();
    $valor = filter_input(INPUT_POST, 'valor');
    $dato = $base->select("SELECT id_linea_investigacion_fk FROM tbl_tematica WHERE id_linea_investigacion_fk ='" . $valor . "'");
    $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
    if (count($fila) > 0) {
        echo "true";
    } else {
        echo "false";
    }
}

function comprobar_eliminacion_tematica() {
    global $base;
    $base = new basedatos();
    $valor = filter_input(INPUT_POST, 'valor');
    $dato = $base->select("SELECT id_tematica_fk FROM tbl_trabajo WHERE id_tematica_fk =" . $valor . "");
    $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
    if (count($fila) > 0) {
        echo "true";
    } else {
        echo "false";
    }
}

function comprobar_modificacion_linea() {
    global $base;
    $base = new basedatos();
    $valor = filter_input(INPUT_POST, 'valor');
    $id = filter_input(INPUT_POST, 'id');
    $dato = $base->select("SELECT abreviacion FROM tbl_linea_investigacion WHERE abreviacion ='" . $valor . "' AND id_linea_investigacion_pk =" . $id . "");
    $fila = mysqli_fetch_array($dato, MYSQLI_ASSOC);
    if (count($fila) > 0) {
        echo "true";
    } else {
        echo "false";
    }
}

?>
