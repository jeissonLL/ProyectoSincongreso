<?php

/* * ----Archivo con formulario para la gestión de roles----
 *
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */


?>
<HTML>
    <HEADER>
      <!-- Plugins css-->
        <link href="../plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />

        <!--FILE UPLOADS MULTIPLE-->
        <!-- Google Fonts -->
	<!--<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">-->

	<!-- Styles -->
	<link href="../plugins/multiupload-om/css/jquery.filer.css" rel="stylesheet"/>
	<link href="../plugins/multiupload-om/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet"/>

	<!-- Jvascript -->
	<!--<script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script>-->
	<script src="../plugins/multiupload-om/js/jquery.filer.min.js" type="text/javascript"></script>
        <script src="../plugins/multiupload-om/js/custom.js" type="text/javascript"></script>

    </HEADER>
    <BODY>
 <div class="row">
    <div class="col-lg-7">
        <div class="tabs-vertical-env nav-tab-left navtab-custom">
            <ul class="nav tabs-vertical">
                <li class="active">
                    <a href="#s_revision" data-toggle="tab" aria-expanded="false">@@sol_revision@@</a>
                </li>
                <li class="">
                    <a href="#irevisores" data-toggle="tab" aria-expanded="false">@@irevisores@@</a>
                </li>
                <li class="">
                    <a href="#ieditores_gestores" data-toggle="tab" aria-expanded="false">@@ieditores_gestores@@</a>
                </li>
                <li class="">
                    <a href="#ieditores_principales" data-toggle="tab" aria-expanded="false">@@ieditores_principales@@</a>
                </li>
                <li class="">
                    <a href="#ieditores_pseccion" data-toggle="tab" aria-expanded="false">@@ieditores_pseccion@@</a>
                </li>
                <li class="">
                    <a href="#ieditores_sseccion" data-toggle="tab" aria-expanded="false">@@ieditores_sseccion@@</a>
                </li>
                <li class="">
                    <a href="#iencargado_programa" data-toggle="tab" aria-expanded="false">@@iencargado_programa@@</a>
                </li>           
                <li class="">
                    <a href="#iencargado_vol" data-toggle="tab" aria-expanded="false">@@iencargado_vol@@</a>
                </li>   
                 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="s_revision">
                    <table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack" id="tbl_s_revision">
                                    <thead align="center">
                                    <tr>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;">@@nusuario@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3" style="font-size: 12px; text-align:center;">@@nombres@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" style="font-size: 12px; text-align:center;">@@motivo@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" style="font-size: 12px; text-align:center;">@@fecha_sol@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" colspan="3" style="font-size: 12px; text-align:center;">@@accion@@</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                    </table> 
                    
<!--                                <a href="javascript:;" id="clickar" onclick="$.Notification.notify('success','right middle','@@notificacion@@', '@@proceso_exitoso@@')"></a>                    -->
                    
                    
                </div>
                <div class="tab-pane" id="irevisores">
                    <table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack" id="tbl_irevisores">
                                    <thead align="center">
                                    <tr>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;">@@nusuario@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3" style="font-size: 12px; text-align:center;">@@nombres@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" colspan="3" style="font-size: 12px; text-align:center;">@@accion@@</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                    </table>                     
                </div>
                <div class="tab-pane" id="ieditores_gestores">
                    <table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack" id="tbl_ieditores_gestores">
                                    <thead align="center">
                                    <tr>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;">@@nusuario@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3" style="font-size: 12px; text-align:center;">@@nombres@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" colspan="3" style="font-size: 12px; text-align:center;">@@accion@@</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                    </table> 
                </div>
                <div class="tab-pane" id="ieditores_principales">
                    <table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack" id="tbl_ieditores_principales">
                                    <thead align="center">
                                    <tr>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;">@@nusuario@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3" style="font-size: 12px; text-align:center;">@@nombres@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" colspan="3" style="font-size: 12px; text-align:center;">@@accion@@</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                    </table> 
                </div>
                <div class="tab-pane" id="ieditores_pseccion">
                    <table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack" id="tbl_ieditores_pseccion">
                                    <thead align="center">
                                    <tr>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;">@@nusuario@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3" style="font-size: 12px; text-align:center;">@@nombres@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" colspan="3" style="font-size: 12px; text-align:center;">@@accion@@</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                    </table> 
                </div>
                <div class="tab-pane" id="ieditores_sseccion">
                    <table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack" id="tbl_ieditores_sseccion">
                                    <thead align="center">
                                    <tr>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;">@@nusuario@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3" style="font-size: 12px; text-align:center;">@@nombres@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" colspan="3" style="font-size: 12px; text-align:center;">@@accion@@</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                    </table> 
                </div>
                <div class="tab-pane" id="iencargado_programa">
                    <table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack" id="tbl_iencargado_programa">
                                    <thead align="center">
                                    <tr>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;">@@nusuario@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3" style="font-size: 12px; text-align:center;">@@nombres@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" colspan="3" style="font-size: 12px; text-align:center;">@@accion@@</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                    </table> 
                </div>
                <div class="tab-pane" id="iencargado_vol">
                    <table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack" id="tbl_iencargado_vol">
                                    <thead align="center">
                                    <tr>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;">@@nusuario@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3" style="font-size: 12px; text-align:center;">@@nombres@@</th>
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" colspan="3" style="font-size: 12px; text-align:center;">@@accion@@</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                    </table> 
                </div>                
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="tabs-vertical-env nav-tab-right navtab-custom">
            <div class="tab-content">
                <div class="tab-pane" id="intereses_revisor">
                    
                    <table class="tablesaw m-t-20 table m-b-0" data-tablesaw-mode="stack" id="tbl_intereses" style="display: none">
                        <thead>
                        <tr>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;">@@ntematica@@</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist" style="font-size: 12px; text-align:center;display: none;" id="rowinscri">@@inscribir@@</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <input type="hidden" id="idrevisor" name="idrevisor" value="">
                    <input type="hidden" id="esrevisor" name="esrevisor" value="0">
                </div> 
            </div>
            <ul class="nav tabs-vertical">
                <li class="active">
                    <a href="#intereses_revisor" data-toggle="tab">@@intereses_revisor@@</a>
                </li>
<!--                <li>
                    <a href="#v2-profile" data-toggle="tab">Profile</a>
                </li>
                <li>
                    <a href="#v2-messages" data-toggle="tab">Messages</a>
                </li>
                <li>
                    <a href="#v2-settings" data-toggle="tab">Settings</a>
                </li>-->
            </ul>
        </div>
    </div>
</div>  <!-- end row -->       
        
    </BODY>

<script src="./js/fnc_slc.js" type="text/javascript"></script>
<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="./assets/css/jquery-ui.css">
<script src="./assets/js/jquery-ui.js"></script>
<script src="./assets/js/angular.min.js"></script>
<script src="./js/gestion_roles/gestion_roles.js"></script>


<script>
$(document).ready(function (){
    mostrar_tabs('#s_revision');
});

</script>
</HTML>
