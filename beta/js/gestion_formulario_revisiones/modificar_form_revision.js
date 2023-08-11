/* 
 * Modificar los formularios de revision 
 * Brayan Triminio
 * 12/07/2017
 */
$("#modificar_formulario").click(function () {
     $.post("./form/gestion_formulario_revisiones/modificar_form_revision.php", {}, function (resp) {     
        alert(resp);
       $('#contenedor').html("");
       retorno(resp);
        b_func('tbl_editar_form');
    });   
});

function modal_editar_pcualitativas(idformulario){
    $("#agregar_pregunta").removeClass(" class='btn btn-primary disabled m-b-5'");
    $("#agregar_pregunta").addClass(" class='btn btn-primary waves-effect waves-teal m-b-5'");
    
    $("#agregar_pregunta_cualitativa").removeClass("class='btn btn-primary disabled m-b-5'");
    $("#agregar_pregunta_cualitativa").addClass(" class='btn btn-primary waves-effect waves-teal m-b-5'");
    
    $("#guardar_pregunta").attr("style" , "display:none");
    
    $("#idform").val(idformulario);
    $("#nuevas_pcuantis").html("");
    $("#nuevas_pcualis").html("");
    var caso = 'preguntas_cualitativas' ;
    $.post("form/gestion_formulario_revisiones/plantillas/funciones.php", {caso:caso,idformulario:idformulario}, function (resp) { 
        alert(resp);
        console.log(resp);
    
    $("#datos").html("");
    $("#preg_cuanti").html("");
    var dataJson = JSON.parse(resp);
    $("#nform").text("  " + dataJson.nombre_formulario.toUpperCase() + "  ");
    var tabla = 1;
        for (var i=0; i<dataJson.numero; i++){
           $("#datos").append("<tr><td style='font-weight:bold; text-align:jutify; font-size:11px;'  >"+dataJson['nombre_tipo_pregunta'+i].toUpperCase()+" </td><td id="+dataJson['id_pregunta_cualitativa_pk'+i]+" tabindex='1' style='font-weight:bold; text-align:jutify; font-size:11px;'>"+dataJson['nombre_pregunta_cualitativa'+i].toUpperCase()+"</td></tr><td><span><a href='#' class='btn btn-default waves-effect waves-red m-b-5' title='Eliminar Pregunta' onclick=eliminar_opcion('"+dataJson['id_pregunta_cualitativa_pk'+i]+"','"+idformulario+"','"+tabla+"');> <i class='ion ion-close-round'></i> Eliminar Pregunta</a> </span></td>");
        }
        
        for (var j=0; j<dataJson.numerocuanti; j++){
            tabla = 0;
            var opciones = dataJson['opciones'+j];
            var pesos = dataJson['ponderacion'+j];
         
            var myarropciones = opciones.split("<>");
            var myarrpesos = pesos.split("<>");
   
            var opcionpeso = "" ; 
            for(var a = 1; a < myarropciones.length; a++){
                opcionpeso = opcionpeso +"<tr><td id='opciones' style='font-weight:bold; text-align:jutify; font-size:11px;' tabindex='1'  width='10%'>"+myarropciones[a].toUpperCase()+"</td><td id='pesos' style='font-weight:bold; text-align:jutify; font-size:11px;' tabindex='1' width='10%' >"+myarrpesos[a]+"</td></tr>" ;
            }
            
           var totalrow = myarropciones.length ;
           $("#preg_cuanti").append("<tr><td  id='pregunta' rowspan="+totalrow+" style='font-weight:bold; text-align:jutify; font-size:11px;' tabindex='1'  >"+dataJson['nombre_pregunta_cuantitativa'+j].toUpperCase()+" </td></tr>"+opcionpeso+"<td><span><a href='#' class='btn btn-default waves-effect waves-red m-b-5' title='Eliminar Pregunta' onclick=eliminar_opcion('"+dataJson['id_pregunta_cuantitativa_pk'+j]+"','"+idformulario+"','"+tabla+"');> <i class='ion ion-close-round'></i> Eliminar Pregunta</a> </span></td><td id="+dataJson['id_pregunta_cuantitativa_pk'+j]+"></td>");
        }
        
    });
    
    $('#preguntas_cualitativas').modal({
        show: 'true'         
    });
}

/*Funcion en la cual se capturan los datos de las preguntas modificadas */
$("#btn_modificar_form").click(function (){
    var idformulario = $("#idform").val();
    
    
    var opciones = "";
    var ponderacion = "";
    var pregunta = "";
    var a = 0 ;
    var e = 0 ;
    var array_pcuanti  = {};/*Declaramos el objeto que contendra todas las preguntas cuantitativas con sus respectivas opciones y ponderaciones*/
    var array_pcuali  = {};/*Declaramos el objeto que contendra todas las preguntas Cualitativas con sus respectivas respuestas*/
    
    $('#tblpregunrascualitativas td').each(function() {
        
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined") {
        }else{
            if(!isNaN(id)){
                var texto = $(this).text();
                array_pcuali['idpregunta'+e] =  $(this).attr("id");
                array_pcuali['pregunta'+e] =  texto ;
             e++;
            }
            
        }
    });
    
    var arraycali = JSON.stringify(array_pcuali) ; /*Preparamos el objeto para ser enviado*/
    
    $('#tblpreguntascuantitativas td').each(function(){
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){
        }else{
            if(!isNaN(id)){/*Llenamos el objeto con la informacion requeriada para su actulizacion */
                array_pcuanti['idpregunta'+a] =  $(this).attr("id");
                array_pcuanti['pregunta'+a] =  pregunta ;
                array_pcuanti['opciones'+a] = opciones ;
                array_pcuanti['ponderacion'+a] = ponderacion ;
             a++;   
             opciones = "";
             ponderacion = "";
             pregunta = "";
            }
            if(id == 'pregunta'){
                pregunta = $(this).text();
            }
            if(id == 'opciones'){
                var texto = $(this).text();
                opciones = opciones +  "<>"+texto ;
            }
            if(id == 'pesos'){
                 var text = $(this).text();
                  ponderacion = ponderacion +"<>"+text;
            }
        }
    });
   
    var arraycanti = JSON.stringify(array_pcuanti) ; /*Preparamos el objeto para ser enviado*/
     
    var caso = 'guardar_preguntas_modificadas' ;
    $.post("form/gestion_formulario_revisiones/plantillas/funciones.php", {caso:caso,arraycuanti:arraycanti, numerocuanti:a, arraycuali:arraycali, numerocuali:e}, function (resp) { 
        if(!isNaN(resp)){
            alert("Las preguntas se han modificado con éxito")
            modal_editar_pcualitativas(idformulario);
        }else{
            alert("Contacte al administrador al administrador del sistema")
        }

    });
    
});

/*Funcion para eliminar a pregunta de fomrulario*/
function eliminar_opcion(idpregunta, idfromulario, tabla){
    var caso = 'eliminar_pregunta';
    
    var respuesta = confirm("Desea realmente eliminar esta pregunta")
    if(respuesta== true){
        $.post("form/gestion_formulario_revisiones/plantillas/funciones.php", {caso:caso,idpregunta:idpregunta,idfromulario:idfromulario,tabla:tabla}, function (resp) { 
        if (resp == 1 ){
            alert("La pregunta se ha eliminado con éxito ")
            modal_editar_pcualitativas(idfromulario)
        }

        });
    }else{
       
    }
}

/*Funciones para agregar nuevas preguntas cuantitativas al formulario en el menu de editar formularios*/
$("#agregar_pregunta").click(function (){
    $("#agregar_pregunta").removeClass(" class='btn btn-primary waves-effect waves-teal m-b-5'");
    $("#agregar_pregunta").addClass("class='btn btn-primary disabled m-b-5'");
    /*Se clona el div que contiene los inputs nombre de la pregunta y tipo de pregunta */   
    var $div = $('div[id^="p_cuanti"]:last');
        var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
        var $klon = $div.clone().prop('id', 'p_cuanti'+num );
        $klon.find("input:text").val("").end();
        $klon.find('select').attr("onchange", "opciones_pond( this.value, "+ num+")");
        $klon.removeAttr("style");
     
    /*Se clona un div para almacenar las opciones de la pregunta respectiva */   
     var $pon = $('div[id^="opciones_ponderaciones"]:last');
     var sumar = parseInt( $pon.prop("id").match(/\d+/g), 10 ) +1;
     var $clon = $pon.clone().prop('id', 'opciones_ponderaciones'+sumar );
     $clon.html("");   
     $clon.removeAttr("style");
     $("#idnumero").val(sumar);
        
        $('#nuevas_pcuantis').append($klon);
        $('#nuevas_pcuantis').append($clon);

});

/*Funcion para crear las opciones deacuerdo al tipo de pregunta. ejemplo si se selecciona dicotomica se creara dos opciones con sus ponderaciones correspondientes*/
function opciones_pond(tipopregunta, iddiv){
    $("#tipo").val(tipopregunta)
    $("#guardar_pregunta").removeAttr("style");
    
    $('#opciones_ponderaciones'+iddiv).html("");
    var i = 0 ;
    for(i; i<tipopregunta; i++){
        var $div = $('div[id^="opcionespeso"]:last');
        var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
        var $klon = $div.clone().prop('id', 'opcionespeso'+num );
        
        $klon.find("input:text").val("").end(); 
        $klon.removeAttr("style");
        $('#opciones_ponderaciones'+iddiv).append($klon);
    }
}

/*Funcion para guardar las nuevas preguntas al formulario*/
$("#guardar_pregunta").click( function (){
    var caso = 'agregar_preguntas_form_edicion' ;
    var opciones = " ";
    var ponderaciones = " ";
    var pregunta = " " ;
    var idform = $("#idform").val(); 
    var repeticiones = $("#idnumero").val(); 
    var tipo = $("#tipo").val(); 
    for(var i=2; i<=repeticiones; i++){
        
        $('#p_cuanti'+i+' input[type=text]').each(function() {
        var nombrepregunta = $(this).val();
        pregunta =  nombrepregunta ;
        });
        
        $('#opciones_ponderaciones'+i+' input[type=text]').each(function() {
        var texto = $(this).val();
        if(texto == ""){
            
        }else{
            if(isNaN(texto)){
               opciones = opciones + "<>" +texto ;  
            }else{
                ponderaciones = ponderaciones + "<>" +texto ;  
            }
        }    
    });
    }
    
    if ((pregunta != "") && (opciones.length > 8) && (ponderaciones.length > 8)){
            $.post("form/gestion_formulario_revisiones/plantillas/funciones.php", {caso:caso,idformulario:idform, nombrepregunta:pregunta,opciones:opciones,ponderaciones:ponderaciones, tipo:tipo }, function (resp) {  
                if(resp == 1){
                    alert("Se ha agregado su pregunta con éxito")
                    modal_editar_pcualitativas(idform)
                }else{

                }
            });
    }else{
        alert("Debe llenar todos los campos")
    }
    
});

$("#agregar_pregunta_cualitativa").click(function(){
   $("#agregar_pregunta_cualitativa").removeClass(" class='btn btn-primary waves-effect waves-teal m-b-5'");
   $("#agregar_pregunta_cualitativa").addClass(" class='btn btn-primary disabled m-b-5'");
   $("#agregar_pregunta_cualitativa").attr("style" , "display:none");
   $("#guardar_pregunta_cualitativa").removeAttr(" style");
    var $div = $('div[id^="hijo"]:last');
     var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
     var $klon = $div.clone().prop('id', 'hijo'+num );
     $klon.find("input:text").val("").end();
     $klon.find("input:text").attr("id" ,"pregunta_cuali");
     $klon.removeAttr("style");
     $('#nuevas_pcualis').append($klon);
});

$("#guardar_pregunta_cualitativa").click(function(){
    var pregunta = $("#pregunta_cuali").val();
    var caso = "agregar_pregunta_cuali_form_edicion";
    var idform = $("#idform").val();
   
    if((pregunta.trim().length == 0) || ($("#pregunta_cuali").val()=="")){
       alert("No puede estar vacio")
    }else{
        $.post("form/gestion_formulario_revisiones/plantillas/funciones.php", {caso:caso,idformulario:idform, nombrepregunta:pregunta}, function (resp) {  
            
            if(resp == 1){
                alert("Se ha agregado su pregunta con éxito")
                modal_editar_pcualitativas(idform);
            }else{
              alert("Comuníquese con el administrador ")
            }
        });
   }
});


 /*
  /*Funcion en la cual se capturan los datos de las preguntas modificadas 
$("#btn_modificar_form").click(function (){
    var valorescualitativos = "";
    
    var opciones = "";
    var ponderacion = "";
    var pregunta = "";
    var a = 0 ;
    
    var array_pcuanti = [];
     /*var array_pcuanti = {};
    $('#tblpregunrascualitativas td').each(function() {
        
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined") {
        }else{
            var texto = $(this).text();
            valorescualitativos = valorescualitativos + id + "," +texto + "," ;
        }
    });
    var fin = valorescualitativos.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
    valorescualitativos = valorescualitativos.substr(0, fin); // elimino la coma final
    /*alert(valorescualitativos)
    
    $('#tblpreguntascuantitativas td').each(function(){
        i++;
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){
        }else{
            if(!isNaN(id)){
              /* array_pcuanti={pregunta:($(this).attr("id"))}
                array_pcuanti.push($(this).attr("id"));
                array_pcuanti.push(pregunta) ;
                array_pcuanti.push(opciones)  ;
                array_pcuanti.push(ponderacion)  ;
             
                
             a++;   
             opciones = "";
             ponderacion = "";
             pregunta = "";
            }
            
            if(id == 'pregunta'){
                pregunta = $(this).text();
            }
            
            if(id == 'opciones'){
                var texto = $(this).text();
                opciones = opciones +  "<>"+texto ;
            }
            if(id == 'pesos'){
                 var text = $(this).text();
                  ponderacion = ponderacion +"<>"+text;
            }
        }
    });
   console.log(array_pcuanti)
   
    var arr = JSON.stringify(array_pcuanti) ; /*Preparamos el objeto para ser enviado
     
    var caso = 'guardar_preguntas_modificadas' ;
    $.post("form/gestion_formulario_revisiones/plantillas/funciones.php", {caso:caso,arr:arr, repeticiones:a}, function (resp) { 
        alert(resp)

        });
    
    
});
  */
