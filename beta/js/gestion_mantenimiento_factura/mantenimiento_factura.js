/* 
 * Brayan Triminio
 * Archivo del mantenimiento de la facturacion del congreso
 * 05/09/2017
 */

function retorno(resp){ 
    $('#contenedor').html(resp);
}

$('#crear_tour').click(function (){
     $.post("./form/gestion_mantenimiento_factura/form_ingresar_tour.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
        b_func('tbl_tours');
    });   
});
/*****************************************************************************************************************/
/***********************************Crear Tour********************************************************************/
/*****************************************************************************************************************/
$('#btn_crear_tour').click(function(){
    var caso = $("#caso").val() ;
    var vacio = 1;
    var numero = 0 ;
    $("#form_tour :input").each( function(){
        var valor = ($(this).val()) ;
        var id = $(this).attr("id");
        if(valor == ""){
            vacio = 0;
        }
        if(id=='costo'){
            if(isNaN(valor)){
                numero = 0;
            }else{
                numero = 1; 
            }
        }
        
    });
    
    if (vacio == 0){
        alert("Debe ingresar los datos requeridos")
    }else if(numero == 0){
        alert("Debe ingresar datos validos")
    }else{
        if (caso == "guardar_tour"){
            var formData = new FormData($("#form_tour")[0]);
            var ruta = "./form/gestion_mantenimiento_factura/plantillas/funciones.php?caso="+caso;
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                 //alert(datos);

                 if(datos){
                    swal("¡Agregado con Exito!", ":D" , "success");
                     $('#form_tour').trigger("reset");//limpiar formulario    
                     b_func('tbl_tours');
                 }else{
                    swal("¡Error!", ":(" , "error");
                 }
                }
            });
            
        }else if(caso=="modificar_tour"){
            var id = $("#tour").val();
            var nombretour =  $("#nombretour").val();
            var descripcion= $("#descripcion").val();
            var comentario= $("#comentario").val();
            var costo= $("#costo").val();
            
            $.post("./form/gestion_mantenimiento_factura/plantillas/funciones.php?caso="+caso,{idtour:id,nombretour:nombretour,descripcion:descripcion,comentario:comentario,costo:costo},function(resp){
             //alert(resp)
                if(resp){
                    swal("Datos Actualizados Exitosamente!", ":D" , "success");
                     $('#form_tour').trigger("reset");//limpiar formulario  
                     b_func('tbl_tours');
                 }else{
                     alert('Ha ocurrido un error y no se pudo realizar su petición, por favor inténtelo nuevamente!');
                 }
            
            });
            
        }
        
    }
    return false;
});

function llenar_tour(id){
    $.post("./form/gestion_mantenimiento_factura/plantillas/funciones.php?caso=llenar_form",{idtour:id},function(resp){llenar_tours(resp);});
   
}
function llenar_tours(resp){
    console.log(resp);
    var dataJson= JSON.parse(resp);
    $('#nombretour').val(dataJson.nombre_tour);
    $('#descripcion').val(dataJson.descripcion);
    $('#comentario').val(dataJson.comentario);
    $('#costo').val(dataJson.costo);
    $('#tour').val(dataJson.id_tour_pk);
    $('#impuesto').val(dataJson.Impuesto);
    $('#caso').val('modificar_tour');
}

/*****************************************************************************************************************/
/***********************************Inscripcion kit***************************************************************/
/*****************************************************************************************************************/

$('#inscripcion_kit').click(function (){
    $.post("./form/gestion_mantenimiento_factura/form_inscripcion_kit.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
        b_func('tbl_articulos');
    });   
});

$("#btn_guardar_articulo").click(function(){
    var error = 0 ;
    var error1 = 0 ;
    var error2 = 0 ;
    var caso = $("#caso").val() ;
    $("#form_articulo :input").each( function(){
        var valor = ($(this).val()) ;
        var id = $(this).attr("id");
        if (valor == ""){
            error1 = 1 ;
        }
        
        if(id == 'impuesto'){
            if(valor == 0){
                error = 1 ;
            }
        }
        
        if(id == 'precio'){
            if(isNaN(valor)){
                error2 = 1 ;
            }
        }
        
    });
    if (error1 == 1){
        alert("Debe llenar los datos requeridos")
    }else if(error == 1){
        alert("Debe seleccionar un tipo de impuesto")
    }else if(error2 == 1){
        alert("Debe ingresar un valor válido")
    }else{
        if (caso == 'guardar_articulo'){
            var formData = new FormData($("#form_articulo")[0]);
            var ruta = "./form/gestion_mantenimiento_factura/plantillas/funciones.php?caso="+caso;
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                // alert(datos);
                 if(datos){
                    swal("¡Agregado con Exito!", ":D" , "success");
                    // alert('Datos guardados exitosamente.');
                     $('#form_articulo').trigger("reset");//limpiar formulario    
                     b_func('tbl_articulos');
                 }else{
                     alert('Ha ocurrido un error y no se pudo realizar su petición, por favor inténtelo nuevamente!');
                 }
                }
            });
        }else if(caso == 'modificar_articulo'){
            var id = $("#articulos").val();
            var nombre =  $("#articulo").val();
            var descripcion= $("#descripcion").val();
            var precio= $("#precio").val();
            var impuesto= $("#impuesto").val();
            
            $.post("./form/gestion_mantenimiento_factura/plantillas/funciones.php?caso="+caso,{id:id,nombre:nombre,descripcion:descripcion,precio:precio,impuesto:impuesto},function(resp){
                console.log(resp);
                if(resp){
                   
                 
                     alert('Datos modificados exitosamente.');
                     $('#form_articulo').trigger("reset");//limpiar formulario  
                     b_func('tbl_articulos');
                 }else{
                     alert('Ha ocurrido un error y no se pudo realizar su petición, por favor inténtelo nuevamente!');
                 }
            
            });
        }
       
    }
    
    return false;
});

function llenar_articulo_costo(id){
   $.post("./form/gestion_mantenimiento_factura/plantillas/funciones.php?caso=llenar_articulos",{idarticulo:id},function(resp){llenar_articulo(resp);});
}

function llenar_articulo(resp){
    console.log(resp);
    var dataJson= JSON.parse(resp);
    $('#articulo').val(dataJson.producto);
    $('#precio').val(dataJson.precio_unitario);
    $('#impuesto').val(dataJson.grabado_exento);
    $('#descripcion').val(dataJson.descripcion);
    $('#articulos').val(dataJson.id_costo_pk);
    $('#caso').val('modificar_articulo');
}