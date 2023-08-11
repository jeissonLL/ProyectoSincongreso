    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>@@t_solicitud@@</b></h4>
            <!--<p class="text-muted m-b-30 font-13">-->
            
            </p> 
        <form role="form" class="form-horizontal" id="form_solicitud" name="form_solicitud" method="POST" role="form">            
            <div class="row" >
                <div class="col-sm-6">                    
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="tsolicitud">@@t_solicitud@@</label>
                                <div class="col-sm-10">
                                    <select id="tsolicitud" name="tsolicitud" class="form-control" >
                                        <option value="">@@seleccionar@@</option>
<!--                                        <option value="sol_rol">@@sol_rol@@</option>
                                        <option value="sol_certificado">@@sol_certificados@@</option>
                                        <option value="sol_traductor">@@sol_traductor@@</option>-->
                                    </select>                                
                                </div>                            
                            </div>  
                        <div id="cont_solicitud"></div>
                       
                    
                        
                </div>  
                <div class="col-sm-6" id="grand" >                    
                    <div class="form-group" id="tematica" style="display: none">
                        <label class='col-sm-2 control-label' for='fullname'>@@tematicas@@</label>
                        <div class="col-sm-10">
                            <select  style="height: 95px;" multiple='' id='origen_sol_tematica' name='origen_tematica[]' class='form-control'></select>
                        </div>                        
                    </div>                         
                </div>                  
            </div>
            <center>
                <div class="form-group m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-custom waves-effect waves-light w-md" type="submit">@@crear_solicitud@@</button>
                    </div>
                </div>  
            </center>
        </form>     
            
        </div> 
    </div>
                
    <script src="./js/dinamica.js"></script>    
    <script src="./js/fnc_select_multiple.js" type="text/javascript"></script>
    <script>
               $.getScript("./js/fnc_slc.js");  
        $("#tsolicitud").change(function (){
            var solicitud = $(this).val();
            $("#tematica").hide();
           $.post("./includes/solicitudes.php?tipo_solicitud="+solicitud, {}, function (resp) {    
               $('#cont_solicitud').html("");
               $('#cont_solicitud').html(resp);
            });    
            if(solicitud == 1)
            {
                quitar_rol();
            }

        });     
        $("#congreso").change(function(){
            var congreso=$("#congreso").val();
             $.post("./includes/funciones.php?funcion=roles_congreso",{congreso:congreso},function(resp){
             $("#tparticipacion").html("");
             $("#tparticipacion").html(resp);
             });
        }) ;    
        function quitar_rol()
        {

        $.post("./includes/funciones.php?funcion=roles_congreso_usuario",{},function(resp){
            $('#tparticipacion option').each(function() {
                var datos = JSON.parse(resp);
                
                if ( $(this).val() == datos.id_rol ) {
                    $(this).remove();
                }
            });
        });
    }
    function tematicas()
    {
        var rol = $("#tparticipacion option:selected").text();
        if(rol == 'Revisor')
        {
            $("#tematica").show();
            b_sm('origen_sol_tematica');
        }
    }
    </script>
    

