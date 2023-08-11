<div class="row">
    <div class="col-lg-3 col-md-4">
        <div class="text-center card-box">
            <div class="member-card">
                <a href="#" class="right-bar-toggle waves-effect waves-light" onclick=img(); ><i class="md md-camera-alt" align="left"></i></a>
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <img id="img_user" src="assets/images/users/avatar-1.jpg" style="width: 30%; height: auto;" class="thumb-img"  alt="profile-image">
                </div>

                <div class="">
                    <h4 class="m-b-5" id="nombre_usuario" name="nombre_usuario">@@nombre_usuario@@</h4>
                </div>

                <div class="text-left m-t-40">
                    <p class="text-muted font-13"><strong>@@nombre_completo@@ :</strong> <span class="m-l-15" id="nombre_completo" id="nombre_completo">@@nombre_completo@@</span></p>

                    <p class="text-muted font-13"><strong>@@telefono_principal@@:</strong><span class="m-l-15" id="telefono_principal" name="telefono_principal">@@telefono_principal@@</span></p>

                    <p class="text-muted font-13"><strong>@@correo_electronico@@ :</strong> <span class="m-l-15" id="correo_electronico" name="correo_electronico">@@correo_electronico@@</span></p>

                    <p class="text-muted font-13"><strong>@@pais@@ :</strong> <span class="m-l-15" id="nombre_pais" name="nombre_pais">@@pais@@</span></p> 
                </div>
            </div>

        </div> <!-- end card-box -->

    </div> <!-- end col -->


    <div class="col-md-8 col-lg-9">
        <div>
            <div class="">
                <ul class="nav nav-tabs navtab-custom">
                    <li class="active">
                        <a href="#profile" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-photo"></i></span>
                            <span class="hidden-xs">@@mis_congresos@@</span>
                        </a>
                    </li>
                    <li class="" >
                        <a href="#settings" data-toggle="tab" aria-expanded="false" id="m_perfil">
                            <span class="visible-xs"><i class="fa fa-cog"></i></span>
                            <span class="hidden-xs" >@@mi_informacion@@</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <div class="row" id="congresos"></div>
                    </div>
                    
                    <div class="tab-pane" id="settings">
                        <form role="form" class="form-inline" id="form_perfil" name="form_perfil" method="POST">
                            <div class="form-group m-r-15">
                                <label for="FullName">@@nombres@@</label>
                                <input type="text" placeholder="John" id="nombres" name="nombres" class="form-control">
                            </div>
                            <div class="form-group m-r-15">
                                <label for="FullName">@@apellidos@@</label>
                                <input type="text" placeholder="Doe" id="apellidos" name="apellidos" class="form-control">
                            </div>                            
                            <div class="form-group m-r-15">
                                <label for="Telefono">@@telefono_principal@@</label>
                                <input type="text" placeholder="6 - 15 Characters" id="tprincipal" name="tprincipal" class="form-control">
                            </div>                                 
                            <div class="form-group m-r-15">
                                <label for="Email">@@correo_principal@@</label>
                                <input type="email" placeholder="first.last@example.com" id="cprincipal" name="cprincipal" class="form-control">
                            </div>
                            <div class="form-group m-r-15">
                                <label for="Email">@@correo_alterno@@</label>
                            </div>                            
                            <div class="form-group m-r-15">
                                <a href="#" class="right-bar-toggle waves-effect waves-light" onclick=agregar_correo(); ><i class="glyphicon glyphicon-plus-sign"></i></a>
                            </div>
                            <div class="form-group m-r-15">
                                <label for="Username">@@nombre_usuario@@</label>
                                <input type="text" placeholder="jdoe" id="nombre_user" name="nombre_user" class="form-control">
                            </div>
                            <div class="form-group m-r-15">
                                <label for="Password">@@contrase@@</label>
                                <input type="password" placeholder="6 - 15 Characters" id="contrase" name="contrase" class="form-control">
                            </div>

                            <div class="form-group m-r-15">
                                <label for="Paisprocedencia">@@pais_procedencia@@</label>
                                    <select id="pais" name="pais" class="form-control input-sm" style="width:120px">
                                        <option value="">@@pais_procedencia@@</option>
                                     </select>
                                <input type="hidden" id="hpais" name="hpais" value="-1">   
                            </div>  
                            <div class="form-group m-r-15">
                                <label for="Idioma">@@idioma@@</label>
                                    <select id="idioma" name="idioma" class="form-control input-sm" style="width:120px">
                                        <option value="">@@idioma@@</option>
                                     </select>
                                <input type="hidden" id="hidioma" name="hidioma" value="-1"> 
                            </div>                              
                            <div class="form-group m-r-15">
                                <label for="RePassword">@@tipo_identificacion@@</label>
                                    <select id="tidentificacion" name="tidentificacion" class="form-control input-sm" >
                                        <option value="">@@tipo_identificacion@@</option>
                                     </select>
                                <input type="hidden" id="htidentificacion" name="htidentificacion" value="-1"> 
                            </div>                            
                            <div class="form-group m-r-15">
                                <label for="Identificacion">@@identificacion@@</label>
                                <input type="text" placeholder="Identificación" id="identificacion" name="identificacion" class="form-control">
                            </div>
                            <div class="form-group m-r-15">
                                <label for="RePassword">@@tipo_alimentacion@@</label>
                                    <select id="talimentacion" name="talimentacion" class="form-control input-sm" >
                                        <option value="">@@tipo_alimentacion@@</option>
                                     </select>
                            </div>
                            
                            <input type="hidden" id="htalimentacion" name="htalimentacion" value="-1"> 
<!--                            <button type="button" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light">Mas correos</button>-->
                            <button class="btn btn-primary waves-effect waves-light w-md" type="submit">@@btn_guardar@@</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      
            <!-- #modal-dialog -->   
            <form enctype="multipart/form-data" method='POST' name='form_img'  id='form_img' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
                <div class='modal fade' id='modal-dialog' style='display:none;' >                                    
                        <div class='modal-dialog' >
                            <div class='modal-content'>
                                <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                        <h4 class='modal-title'>@@Seleccione Imagen@@</h4>
                                </div>

                                <div class='modal-body'>
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="form-group no-margin">
                                                <label class='col-md-5 control-label' for='fullname'>@@img_adjunta@@ <p class="text-danger">@@leyenda_img@@</p></label>                                           
                                                <div class="col-md-4">
                                                    <input type="file" id="img_usuario" name="img_usuario" class="btn-default btn-rounded" accept=".jpg, .jpeg, .png"/><br>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                        <a href='javascript:;'  class='btn btn-secondary btn-warning' data-dismiss='modal'>@@btn_cancelar@@</a>
                                        <a type='button' onclick='cargarimg();' class='btn btn-primary btn-success'>@@btn_guardar@@</a>
                                </div>
                            </div>
                        </div>                                    
                </div>
            </form>
               <!-- /modal-dialog -->
               
               
            <!-- #modal-dialog -->   
            <form method='POST' name='form_correo'  id='form_correo' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
                <div class='modal fade' id='modal-dialog2' style='display:none;' >                                    
                        <div class='modal-dialog' >
                            <div class='modal-content'>
                                <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                        <h4 class='modal-title'>@@nuevo_correo_alterno@@</h4>
                                </div>
                                <div class='modal-body'>
                                    <div class="row">
                                        <div class="form-group m-r-12">
                                            <div >
                                                <label class='col-md-5 control-label' for="Email">@@correo_alterno@@</label>
                                                <div id="nuevos_correos" class="col-md-4">
                                                    <input type="email" placeholder="first2.last@example.com" id="nuevo_correo" name="nuevo_correo[]" class="form-control">    
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="#" class="right-bar-toggle waves-effect waves-light" onclick=clonar(); ><i class="glyphicon glyphicon-plus-sign"></i></a>
                                                </div>                                            
                                            </div>      
                                        </div>                                                                                        
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                        <a href='javascript:;'  class='btn btn-secondary btn-warning' data-dismiss='modal'>@@btn_cancelar@@</a>
                                        <a type='button' onclick='nuevo_correo();' class='btn btn-primary btn-success' id="btn_guardarc">@@btn_guardar@@</a>
                                </div>
                            </div>
                        </div>                                    
                </div>
            </form>
               <!-- /modal-dialog -->               
    </div> <!-- end col -->
</div>
<script>
    
function img(){

    if (confirm('@@pcambiaimg@@')) {                                            
            $('#modal-dialog').removeAttr('style');
            $('#modal-dialog').modal({
                 show: 'true'
            });             
    }
}
function agregar_correo(){
    if (confirm('@@pnuevo_correo@@')) {                                            
            $('#modal-dialog2').removeAttr('style');
            $('#modal-dialog2').modal({
                 show: 'true'
            });             
    }    
}
function cargarimg(){ 

     var formData = new FormData($("#form_img")[0]);
           var ruta = "./includes/conductor_persona.php?formulario=form_img";
           $.ajax({
               url: ruta,
               type: "POST",
               data: formData,
               contentType: false,
               processData: false,
               success: function(datos)
               {
                   
                var resp = JSON.parse(datos);                          
                if(resp.respuesta == 1){
                    alert('Datos guardados exitosamente.');
                    $('#modal-dialog').modal('hide');     //oculta el modal
                    $('body').removeClass('modal-open');  //quita la clase que mantiene activo el modal
                    $('.modal-backdrop').remove();        //habilita en formulario contenedor  
                    $("#img_user").attr("src",resp.img_user);                              
                    $("#img_users").attr("src",resp.img_user); 
                        //funcion para actualizar tabla donde se visualizan los campos ingresados
                     $.post("./includes/conductor_persona.php", {}, function (resp) {                                       

                     });   
                }else{
                    alert('Ha ocurrido un error y no se pudo subir imagen, por favor intentelo nuevamente!');

                }
               }
           });  
}

function clonar(){
$( "#nuevo_correo" ).clone().appendTo("#nuevos_correos" );
}
function nuevo_correo(){ 
        $("#btn_guardarc").prop('disabled', true);
           var ruta = "./includes/conductor_persona.php?formulario=form_correo";
           $.ajax({
               url: ruta,
               type: "POST",
               data: $('#form_correo').serialize(),
               success: function(datos)
               {
                   console.log(datos);
                 if(datos == 1){
                    alert('Datos guardados exitosamente.');
                    $('#modal-dialog2').modal('hide');  
                }else{
                    alert('Ha ocurrido un error, por favor intentelo nuevamente!');

                }
               }
           });  
}

$("#m_perfil").click(function (){
    
     $("#talimentacion").val($("#htalimentacion").val());
     $("#idioma").val($("#hidioma").val());     
     $("#tidentificacion").val($("#htidentificacion").val());   
     $("#pais").val($("#hpais").val());        
});

</script>

