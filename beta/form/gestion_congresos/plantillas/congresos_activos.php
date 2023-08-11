<div class="row">
    <div class="col-md-11 col-lg-12">
            <div class="">
                <div class="">
                    <ul class="nav nav-tabs navtab-custom">
    <!--                    <li class="">
                            <a href="#home" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                <span class="hidden-xs">@@sobre_mi@@</span>
                            </a>
                        </li>-->
                        <li class="active">
                            <a href="#profile" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-photo"></i></span>
                                <span class="hidden-xs">@@congresos_activos_actualmente@@</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <div class="row" id="congresos">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
</div>  
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">@@informacion_congreso@@</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">@@nombre_congreso@@</label>
                                        <input type="text" class="form-control" id="nombre_congreso" placeholder="Nombre del Congreso">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">@@siglas@@</label>
                                        <input type="text" class="form-control" id="siglas" placeholder="Siglas">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-3" class="control-label">@@lugar@@</label>
                                        <input type="text" class="form-control" id="lugar" placeholder="Lugar">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">@@pais@@</label>
                                        <input type="text" class="form-control" id="pais" placeholder="Ejemplo: Honduras">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">@@fecha_realización@@</label>
                                        <input type="date" class="form-control" id="fecha" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-6" class="control-label">@@status_ac@@</label>
                                        <input type="text" class="form-control" id="nombre_estado" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">@@descripcion_congreso@@</label>
                                        <textarea class="form-control autogrow" id="descripcion_congreso" placeholder="Descripción del Congreso" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                                        <input type="hidden" id="idcongreso" />
                                        <input type="hidden" id="idusuario" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@cerrar@@</button>
                            <button type="button" id="inscribirse" class="btn btn-info waves-effect waves-light">@@incribirse@@</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal -->
    
            
<script>
    $("#inscribirse").click(function(){
        var idcongreso = $("#idcongreso").val();
        var idusuario = $("#idusuario").val()
        $.post("./includes/funciones.php?funcion=inscribirse_congreso",{idcongreso:idcongreso,idusuario:idusuario}, function (resp){
  
            if(resp > 0)
            {
                alert("Inscripción realizada con exito!")
                $("#con-close-modal .close").click()
            }
        });
    })            
</script>