/* 
 * Crear formularios .
 * autor: brayan Triminio
 * 30/05/2017.
 */

//CONTRUCCION DEL FORMULARIO
function retorno(resp){ 
    $('#contenedor').html(resp);
}
//FUNCION PARA CARGAR EL FORMULARIO DE CERTIFICADOS EN EL MENU PRINCIPAL (PAGINA DE INICIO)
$("#crear_formulario").click(function (){
   $.post("./form/gestion_formulario_revisiones/form_crear_formulario.php", {}, function (resp) {     
       //console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
    });   
});

function agregar1(){
    var $div = $('div[id^="hijo"]:last');
     // Read the Number from that DIV's ID (i.e: 3 from "klon3")
     // And increment that number by 1
     var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
     // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
     var $klon = $div.clone().prop('id', 'hijo'+num );
     $klon.find("input:text").val("").end();                       
     $('#preguntas').append($klon);
     var numero = $("#numero").val();
     var sumar = parseInt(numero)+ 1; 
     $("#numero").val(sumar); 
    $("#eliminar1").removeAttr("style") ;
}

function eliminar1(){
    var numero = $("#numero").val();
    
    var sumar = parseInt(numero)-1; 
    $("#numero").val(sumar);
    var valor =$("#numero").val();
    if (numero>1){
        try{
         var item = document.getElementById("preguntas").lastChild;
         item.parentNode.removeChild(item);
         if (valor == 1){
         $("#eliminar1").attr("style","display:none") ;
        }
        }catch(err){

          $('#preguntas').append(err);
          
        }
    }
        
}

function gyc(){
    var caso = $("#caso1").val();
    var nombre = $("#nombre").val();
    var des = $("#desc").val();
    if (nombre== "") {
        //alert("no puede estar vacio") no puede mover al otro formulario 
        
    }else{
    $.post("./includes/querys.php?caso="+caso,{nombre:nombre,des:des},function(resp){
    
    if(isNaN(resp)){  
    }else{
       gyc1(resp);   
       $("#create_form").val(resp);
    }
    
    }); 
    }
}

function gyc1(id){
  var numero = $("#numero").val();
  var idform= id;
  var i=1;
  
  while(i <= numero){
      var valor = "";
   var $div = $("#hijo"+i);
   var texto = $div.find('input[type=text]')
  
    if (texto.val() == ""){
        alert("esta vacio")
    }else{
        var caso = $("#caso").val();
        valor = texto.val();
        $.post("./includes/querys.php?caso="+caso,{id:idform,valor:valor},function(resp){
        //alert(resp)
     }); 
    }
   i++
  }
}

function ponderacion(id){
    $("#agregar2").removeAttr("style");
    var numerocuanti = $("#numerocuanti").val();
    $('#ponderaciones'+numerocuanti).html("");
    var i = 0 ;
    for(i; i<id; i++){
        var $div = $('div[id^="opciones"]:last');
        var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
        var $klon = $div.clone().prop('id', 'opciones'+num );
        
        
        $klon.find("input:text").val("").end(); 
        $klon.removeAttr("style");
        $('#ponderaciones'+numerocuanti).append($klon);
        
    }
}


function agregar2(){
   var numero = $("#numerocuanti").val();
   var nuevo = parseInt(numero)+1; 
    $("#numerocuanti").val(nuevo);
    var $div = $('div[id^="preguntacuanti"]:last');
     var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
     var $klon = $div.clone().prop('id', 'preguntacuanti'+num );
     $klon.find("input:text").val("").end();
     
     var $pon = $('div[id^="ponderaciones"]:last');
     var sumar = parseInt( $pon.prop("id").match(/\d+/g), 10 ) +1;
     var $clon = $pon.clone().prop('id', 'ponderaciones'+sumar );
     $clon.html("");   
     
     
     $('#append').append($klon);
     $('#append').append($clon);
     
    
}

function gyc2(){
    $("#guardar2").attr("style","display:none");
    $("#final").removeAttr("style");
    $("#cuanti").attr("style","display:none");
        
    var caso = $("#caso2").val();
    var idform = $("#create_form").val();
    var repeticiones =$("#numerocuanti").val();
    var i =0 ;
    var a =0 ;
    var j =1 ;
    var e =1 ;
    var o = 1 ;
       
    var preguntas = new Array();
    
    var opcion=[];
    var peso =[];
    var seleccion = [];
    
    //alert(repeticiones)
   
    //Optenemos todas las preguntas creadas 
    while(i <= repeticiones){
        
        var $div = $("#preguntacuanti"+i);
        var texto = $div.find('input[type=text]') //Optenemos las preguntas 
        preguntas.push(texto.val());       
    i++
    }
   //alert(preguntas)
    //obtenemos todos los valores de las cajas de texto llenas para proceder a compararlos   
    $.each($('input[type=text]'),function(){
    var variable =($(this).val());
    if(variable == ""){       
    }else{
     var texto = ($(this).val());
     if(preguntas[j] == texto){
         a++;
         j++;
     }
    if (isNaN(texto)) { // Si no es un numero para determinar las preguntas y las opciones de esas preguntas 
            opcion[a]= opcion[a] + "<>"+ texto;
           
        } else { //Son los pesos de las opciones 
            peso[a]= peso[a] + "<>"+ texto;
           
        }
    }
    });
    
    $('select').each(function() {
    var selectedOption = $(this).find('option:selected');
    
    //alert('Value: ' + selectedOption.val() + ' Text: ' + selectedOption.text());
     seleccion[o] = selectedOption.val();
     o++
    });
    //alert(seleccion)
    
    for (var p = 1; p <= repeticiones; p++){  
        //alert(seleccion[p])
    $.post("./includes/querys.php?caso="+caso,{id:idform, pregunta:preguntas[e] ,opcion:opcion[p], peso:peso[p], tipo:seleccion[p]},function(resp){
     //alert(resp)
     e++ ;
     });
    }
    var funct = 'insert_pre_revista_premio';
    var tipo = 2;
    var ponde ='<>50<>50';
    var opc ='<>SI<>NO';
    $.post("form/gestion_formulario_revisiones/plantillas/funciones.php", {caso:funct,id:idform, tipo:tipo, ponde:ponde, opc:opc});  
}