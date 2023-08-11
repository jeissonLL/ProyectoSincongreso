<!-- Begin page -->
<div id="wrapper">

  <!-- Top Bar Start -->
  <div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
      <div class="text-center">
        <a href="" class="logo"><i class="md md-equalizer"></i> <span id="congreso_nombre">CEAT</span> </a>
      </div>
    </div>

    <!-- Navbar -->
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="">
          <div class="pull-left">
            <button class="button-menu-mobile open-left waves-effect">
              <i class="md md-menu"></i>
            </button>
            <span class="clearfix"></span>
          </div>

<!--          <ul class="nav navbar-nav hidden-xs">
            <li><a href="#" class="waves-effect">Files</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle waves-effect" data-toggle="dropdown"
              role="button" aria-haspopup="true" aria-expanded="false">Projects <span
              class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Web design</a></li>
                <li><a href="#">Projects two</a></li>
                <li><a href="#">Graphic design</a></li>
                <li><a href="#">Projects four</a></li>
              </ul>-->
            </li>
          </ul>

<!--          <form role="search" class="navbar-left app-search pull-left hidden-xs">
            <input type="text" placeholder="Search..." class="form-control app-search-input">
            <a href=""><i class="fa fa-search"></i></a>
          </form>-->

          
         </div>
<!--          /.nav-collapse -->
        </div>
      </div>
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">


      <div id="sidebar-menu">
        <ul>
          <li  class="menu-title">@@menu@@</li> <!--Menu-->
          <li>
            <a href="menu_principal.php" class="waves-effect waves-primary"><i
              class="md md-dashboard"></i><span> @@inicio@@ </span></a>
            </li>
            <!-- Menú de Traducciones
             Alex Siboney Vargas Osorto
             23/3/2017
             alexv7142@gmail.com / avargas@iies-unah.org
            -->
            <!-- Menú de Congresos-->
            
<!-- Inicio del sistema, usuario decide "Mis congresos" ó "Congresos Activos-->

            <li  class="has_sub" id="menu_congresos" style="display: none">
              <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-wallet-membership"></i> <span> @@congresos@@ </span> <!--Gestión de Congresos-->
                <span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  <li><a href="javascript:;" id="congresos_activos" style="display: none"><i class="md-settings-power"></i> <span>@@congresos_activos_reg@@</span></a></li>
                  <li><a href="javascript:;" id="crear_congreso" style="display: none" ><i class=" md-perm-data-setting"></i> <span>@@creacion_gestion_congresos@@</span></a></li>
                  <li><a href="javascript:;" id="gestionar_linea_investigacion" style="display: none"><i class="ti-pencil-alt"></i> <span>@@gestionar_linea_investigacion@@</span></a></li>
                  <li><a href="javascript:;" id="gestionar_tematicas" style="display: none"><i class="ti-marker-alt"></i> <span>@@gestionar_tematicas@@</span></a></li>
  
                  <li><a href="javascript:;" id="asociar_administrador_congreso" style="display: none"><i class=" md-perm-identity"></i> <span>@@asociar_administrador_congreso@@</span></a></li>
                  
                  <li class="has_sub" id="submenu_menu_ges_facturacion" style="display: none">
                        <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-view-array"></i> <span> @@mantenimiento_congreso@@ </span> <!--Gestión de itinerario-->
                        <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="javascript:;" id="crear_tour">@@crear_tour@@</a></li> <!--Crear Tours-->
                            <li><a href="javascript:;" id="inscripcion_kit">@@inscripcion_kit@@</a></li>   
                            <!--<li><a href="javascript:;" id="cancelar_solicitud_ess">@@cancelar_solicitud@@</a></li> <!--Cancelar solicitud a revisores-->
                            <!--<li><a href="javascript:;" id="enviar_trabajos_ess">@@enviar_trabajos@@</a></li> <!--Enviar Trabajos a editor principal-->
                        </ul>
                    </li>
                  
                </ul>
              </li>
              
             <!--Manejo de menú traducciones -->
            <li   class="has_sub" id="menu_traducciones"  >
              <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-translate"></i> <span> @@menu_traducciones@@ </span> <!--Gestión de Traducciones-->
                <span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  <li><a href="javascript:;" id="mensajeria"><i class=" md-messenger"></i> <span> @@mensajería@@</span></a></li>
                  <li><a href="javascript:;" id="matriz_idiomas"><i class=" md-messenger"></i> <span> @@matriz_idiomas@@</span></a></li> 
                  <li><a href="javascript:;" id="traducciones"><i class=" md-messenger"></i> <span> @@traducciones@@</span></a></li>
                  <li><a href="javascript:;" id="gtraductores"><i class=" md-messenger"></i> <span> @@gestion_traductor@@</span></a></li>
                </ul>
              </li>

              <!-- Fin de menú traducciones por Alex Vargas -->

<!-- ______________________________________________________________________________________________________________________________________________________________________________________________________ -->
<!-- ______________________________________________________________________________________________________________________________________________________________________________________________________ -->

              <!--INICIO MENU / OBED
              Sección de Menu
              Editor: Obed Martínez
              fecha: 15/02/2017
            -->

            <li   class="has_sub" id="menu_gcertificados" style="display: none" >
                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-picture-in-picture"></i> <span> @@gcertificados@@ </span> <!--Gestión de Certificados-->
                  <span class="menu-arrow"></span></a>
                  <ul class="list-unstyled">
                    <li><a href="javascript:;" id="c_certificados" style="display: none">@@c_certificados@@</a></li>
                    <li><a href="javascript:;" id="generar_certificados" style="display: none">@@g_certificados@@</a></li>
                    <!--<li><a href="javascript:;" id="c_certificado_especial">@@c_certificado_especial@@</a></li>
                    <li><a href="javascript:;" id="c_editor_gestor">@@c_editor_gestor@@</a></li>
                    <li><a href="javascript:;" id="c_editor_principal">@@c_editor_principal@@</a></li>
                    
                    <li><a href="javascript:;" id="c_editor_principal_seccion">@@c_editor_principal_seccion@@</a></li>
                    <li><a href="javascript:;" id="c_editor_secundario_seccion">@@c_editor_secundario_seccion@@</a></li>
                    <li><a href="javascript:;" id="c_encargado_voluntario">@@c_encargado_voluntario@@</a></li>
                    <li><a href="javascript:;" id="c_encargado_programa">@@c_encargado_programa@@</a></li>
                    <li><a href="javascript:;" id="c_autor">@@c_autor@@</a></li>
                    <li><a href="javascript:;" id="c_revisor">@@c_revisor@@</a></li>
                    <li><a href="javascript:;" id="c_voluntario">@@c_voluntario@@</a></li>
                    <li><a href="javascript:;" id="c_invitado">@@c_invitado@@</a></li>
                    <li><a href="javascript:;" id="imprimir_c_invitado">@@imprimir_c_invitado@@</a></li>-->
                  </ul>
                </li>
                <li   class="has_sub" id="menu_glistas_rotulos" style="display: none" >
                  <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-view-list"></i> <span> @@glista_rotulos@@ </span> <!--Gestión de Listados y Rotulaciones-->
                    <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                      <li><a href="javascript:;" id="listados_actividad">@@listados_actividad@@</a></li>
                      <li><a href="javascript:;" id="rotulos_actividad">@@rotulos_actividad@@</a></li>
                    </ul>
                  </li>
                  <li   class="has_sub" id="menu_gestadisticas" style="display: none" >
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-functions"></i> <span> @@gestadisticas@@ </span> <!--Generar estadisticas-->
                      <span class="menu-arrow"></span></a>
                      <ul class="list-unstyled">
                        <li class="has_sub" id="submenu_gestadisticas_trabajos" style="display: none">
                          <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-my-library-books"></i> <span> @@numeros@@ </span>
                            <span class="menu-arrow"></span></a>
                        </li>
                      </ul>
                  </li>
<!--                            <ul class="list-unstyled">
                              <li><a href="javascript:;" id="por_facultad_t">@@por_facultad@@</a></li>
                              <li><a href="javascript:;" id="por_carrera_t">@@por_carrera@@</a></li>
                              <li><a href="javascript:;" id="por_grado_t">@@por_grado@@</a></li>
                              <li><a href="javascript:;" id="por_posgrado_t">@@por_posgrado@@</a></li>
                              <li><a href="javascript:;" id="por_empleado_t">@@por_empleado@@</a></li>
                            </ul>
                          </li>
                          <li   class="has_sub" id="submenu_gusuarios" style="display: none">
                            <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-my-library-books"></i> <span> @@usuarios@@ </span> Trabajos
                              <span class="menu-arrow"></span></a>
                              <ul class="list-unstyled">
                                <li><a href="javascript:;" id="por_rol_u">@@por_rol@@</a></li>
                                <li><a href="javascript:;" id="por_facultad_u">@@por_facultad@@</a></li>
                                <li><a href="javascript:;" id="por_carrera_u">@@por_carrera@@</a></li>
                                <li><a href="javascript:;" id="por_grado_u">@@por_grado@@</a></li>
                                <li><a href="javascript:;" id="por_posgrado_u">@@por_posgrado@@</a></li>
                                <li><a href="javascript:;" id="por_empleado_u">@@por_empleado@@</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>-->
                        <li   class="has_sub" id="menu_gprograma" style="display: none"  >
                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-format-align-justify"></i> <span> @@gprograma@@ </span> <!--Gestión del programa-->
                                      <span class="menu-arrow"></span></a>
                                      <ul class="list-unstyled">
                                          <li class="has_sub" id="submenu_gprograma_gespacios">
                                            <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-my-library-books"></i> <span> @@gespacios@@ </span> <!--gestión de espacios-->
                                              <span class="menu-arrow"></span></a>
                                              <ul class="list-unstyled">
                                                <li><a href="javascript:;" id="crear_espacio">@@crear_espacio@@</a></li>
                                                <!--<li><a href="javascript:;" id="modificar_espacio">@@modificar_espacio@@</a></li>
                                                <li><a href="javascript:;" id="eliminar_espacio">@@eliminar_espacio@@</a></li>-->
                                              </ul>
                                            </li>
                                            <li   class="has_sub" id="submenu_gprograma_gactividades">
                                              <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-my-library-books"></i> <span> @@gactividades@@ </span> <!--Gestión de actividades-->
                                                <span class="menu-arrow"></span></a>
                                                <ul class="list-unstyled">
                                                  <li><a href="javascript:;" id="crear_actividad">@@admon_actividades@@</a></li>

                                                </ul>
                                              </li>
                                              <li><a href="javascript:;" id="distribucion_trabajos_sp">@@distribuir_trabajos_sp@@</a></li><!--mover trabajos en sesiones paralelas-->
                                              <li><a href="javascript:;" id="mover_trabajos_sp">@@mover_trabajos_sp@@</a></li><!--mover trabajos en sesiones paralelas-->
                                              <li><a href="javascript:;" id="emitir_programa">@@emitir_programa@@</a></li> <!--Emitir programa de sesiones paralelas-->                                              
                                              <!--<li><a href="javascript:;" id="cerrar_programa">@@cerrar_programa@@</a></li>-->
                                            </ul>
                              </li>
                              <li   class="has_sub" id="menu_gvoluntarios" style="display: none" >
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-account-child"></i> <span> @@gvoluntarios@@ </span> <!--Gestión de voluntarios-->
                                  <span class="menu-arrow"></span></a>
                                  <ul class="list-unstyled">
                                    <li><a href="javascript:;" id="solicitudes">@@solicitudes@@</a></li>   <!--Aceptar / rechazar solicitudes de voluntarios-->
                                    <li><a href="javascript:;" id="inscribir_voluntario">@@inscribir_voluntario@@</a></li>   <!--Inscribir voluntario-->
                                    <li class="has_sub" id="submenu_gvoluntarios_gactividades_vol">
                                      <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-my-library-books"></i> <span> @@gactividades_vol@@ </span> <!--Gestión de actividades de Voluntario-->
                                        <span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">
                                          <li><a href="javascript:;" id="crear_actividad_vol">@@crear_actividad@@</a></li>
                                          <li><a style="display: none" href="javascript:;" id="modificar_actividad_vol">@@modificar_actividad@@</a></li>
                                          <li><a style="display: none" href="javascript:;" id="eliminar_actividad_vol">@@eliminar_actividad@@</a></li>
                                        </ul>
                                      </li>
                                      <li><a href="javascript:;" id="validar_voluntariado">@@validar_voluntariado@@</a></li>   <!--validar voluntariado-->
                                      <li><a href="javascript:;" id="mensajes_voluntarios">@@mensajes_voluntarios@@</a></li>   <!--Ver / responder mensajes de voluntarios-->
                                    </ul>
                                </li>
                                 
                              <li   class="has_sub" id="menu_voluntarios" style="display: none" >
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-account-child"></i> <span> @@voluntarios@@ </span> <!--Voluntarios-->
                                  <span class="menu-arrow"></span></a>
                                  <ul class="list-unstyled">
                                    <li><a href="javascript:;" id="actividades_voluntario" style="display: none">@@actividades_asignadas@@</a></li>   <!--Visualizar actividades asignadas-->
                                    <li><a href="javascript:;" id="mensajes_voluntario" style="display: none">@@mensajería@@</a></li>   <!--Mensajería -->
                                    <li class="has_sub" id="submenu_gvoluntarios_gactividades_vol">
                                      <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-my-library-books"></i> <span> @@validaciones@@ </span> <!--Gestión de actividades de Voluntario-->
                                        <span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">
                                          <li><a href="javascript:;" id="asistencia_voluntario" style="display: none">@@asistencia_personas@@</a></li>
                                          <li><a href="javascript:;" id="validar_pres_autores" style="display: none">@@asistencia_autores@@</a></li>
                                          <li><a href="javascript:;" id="pagos_voluntarios" style="display: none">@@pagos@@</a></li>
                                        </ul>
                                      </li>
                                     
                                    </ul>
                                </li>  
                                
                                
                              <li  class="has_sub" id="menu_gtrabajos" style="display: none">
                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="  md-markunread-mailbox"></i> <span> @@gtrabajos_autor@@ </span> <!--Gestión de trabajos de autor-->
                                      <span class="menu-arrow"></span></a>
                                      <ul class="list-unstyled">
                                          <li><a href="javascript:;" id="subir_trabajo" name="subir_trabajo">@@subir_trabajo@@</a></li> <!--Subir trabajo-->
                                        <li><a href="javascript:;" id="trabajos_subidos">@@trabajos_subidos@@</a></li>   <!--trabajos subidos-->
                                        <li><a href="javascript:;" id="aceptar_autorias">@@aceptar_autorias@@</a></li>   <!--Aceptar / rechazar autorias--> 
                                        
                                      </ul>
                                    </li>
                                    <li   class="has_sub" id="menu_geditor_gestor" style="display: none" >
                                      <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-verified-user"></i> <span>@@geditor_gestor@@</span> <!--Gestión de editor gestor-->
                                        <span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">                                          
                                          <li><a href="javascript:;" id="enviar_rechazar_trabajo_eg">@@enviar_rechazar_trabajo@@</a></li>   <!--Enviar o rechazar trabajo-->
                                        </ul>
                                      </li>
                                        <li   class="has_sub" id="menu_edicion"  style="display: none">
                                            <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="md-view-week"></i> <span>@@edicion@@</span> <!--Gestión de asistente-->
                                            <span class="menu-arrow"></span></a>
                                            <ul class="list-unstyled">
                                                <li class="has_sub" id="submenu_menu_geditor_principal" style="display: none">
                                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-view-agenda"></i> <span> @@geditor_principal@@ </span> <!--Gestión de itinerario-->
                                                    <span class="menu-arrow"></span></a>
                                                    <ul class="list-unstyled">
                                                         <li><a href="javascript:;" id="gtrabajos_ep">@@gtrabajos@@</a></li> <!--Gestion de trabajos-->
                                                        <!--<li><a href="javascript:;" id="asignar_revisores_ep">@@asignar_revisores@@</a></li>   asignar revisores-->
                                                        <!--<li><a href="javascript:;" id="cancelar_solicitud_ep">@@cancelar_solicitud@@</a></li>   <!--Cancelar solicitud a revisores-->
                                                        <li><a href="javascript:;" id="dictaminar_resultado_trabajos">@@dictaminar_resultado@@</a></li> <!--Dictaminar resultado de las revisiones-->
                                                        <li><a href="javascript:;" id="gpremios_ep">@@gpremios@@</a></li> <!--Gestion de trabajos-->
                                                    </ul>
                                                </li>
                                                <li class="has_sub" id="submenu_menu_geditor_p_seccion" style="display: none">
                                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-view-day"></i> <span> @@geditor_p_seccion@@ </span> <!--Gestión de itinerario-->
                                                    <span class="menu-arrow"></span></a>
                                                    <ul class="list-unstyled">
                                                        <li><a href="javascript:;" id="gtrabajos_eps">@@gtrabajos@@</a></li> <!--Gestion de Trabajos-->
                                                       <!-- <li><a href="javascript:;" id="asig_trabajos_eps">@@asig_trabajos@@</a></li>   Asignar Trabajo a editor secundario de seccion-->
                                                        <!-- <li><a href="javascript:;" id="asignar_revisores_eps">@@asignar_revisores@@</a></li>   <!--Asignar Revisores-->
                                                        <!--<li><a href="javascript:;" id="cancelar_solicitud_eps">@@cancelar_solicitud@@</a></li> <!--Cancelar solicitud a revisores-->
                                                        <li><a href="javascript:;" id="dictaminar_resultado_eps">@@dictaminar_resultado@@</a></li> <!--Dictaminar resultado de las revisiones-->
                                                    </ul>
                                                </li>
                                                <li class="has_sub" id="submenu_menu_geditor_s_seccion" style="display: none">
                                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-view-array"></i> <span> @@geditor_s_seccion@@ </span> <!--Gestión de itinerario-->
                                                    <span class="menu-arrow"></span></a>
                                                    <ul class="list-unstyled">
                                                        <li><a href="javascript:;" id="gtrabajos_ess">@@gtrabajos@@</a></li> <!--Gestion de Trabajos-->
                                                        <!--<li><a href="javascript:;" id="asignar_revisores_ess">@@asignar_revisores@@</a></li>   <!--Asignar Revisores-->
                                                        <!--<li><a href="javascript:;" id="cancelar_solicitud_ess">@@cancelar_solicitud@@</a></li> <!--Cancelar solicitud a revisores-->
                                                        <!--<li><a href="javascript:;" id="enviar_trabajos_ess">@@enviar_trabajos@@</a></li> <!--Enviar Trabajos a editor principal-->
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                                <li   class="has_sub" id="menu_grevisor" style="display: none" >
                                                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-spellcheck"></i> <span>@@grevisor@@</span> <!--Gestión de revisor-->
                                                    <span class="menu-arrow"></span></a>
                                                    <ul class="list-unstyled">
                                                    <li><a href="javascript:;" id="solicitud_revisiones_pendientes_r">@@revisiones_pendientes@@</a></li> <!--Solicitud Revisiones pendientes-->
                                                    <!--<li><a href="javascript:;" id="revisar_trabajos_asignados">@@revisiones_pendientes@@</a></li> Revisiones pendientes-->
                                                    <!--<li><a href="javascript:;" id="modificar_perfil_r">@@modificar_perfil@@</a></li> Modificar Perfil de Revisor-->
                                                    </ul>
                                                </li>
                                              <li   class="has_sub" id="menu_gasistente"  style="display: none">
                                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-work"></i> <span>@@gasistente@@</span> <!--Gestión de asistente-->
                                                  <span class="menu-arrow"></span></a>
                                                  <ul class="list-unstyled">
                                                    <li><a href="javascript:;" id="consultar_programa_congreso">@@consultar_programa_congreso@@</a></li>   <!--Consultar Programa de Congreso Activo-->
                                                    <li class="has_sub" id="submenu_gasistente_gitinerario">
                                                      <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-my-library-books"></i> <span> @@gitinerario@@ </span> <!--Gestión de itinerario-->
                                                        <span class="menu-arrow"></span></a>
                                                        <ul class="list-unstyled">
                                                          <li><a href="javascript:;" id="crear_itinerario">@@crear_itinerario@@</a></li>
                                                          <li><a href="javascript:;" id="modificar_itinerario">@@modificar_itinerario@@</a></li>
                                                          <!--<li><a href="javascript:;" id="eliminar_itinerario">@@eliminar_itinerario@@</a></li>-->
                                                          <!--<li><a href="javascript:;" id="imprimir_itinerario">@@imprimir_itinerario@@</a></li>-->
                                                        </ul>
                                                      </li>
                                                      <li><a href="javascript:;" id="ver_noticias">@@ver_noticias@@</a></li> <!--ver noticias-->
                                                    </ul>
                                                  </li>
                                                  
                                                  <!--FINAL MENU / OBED-->
<!-- ******************************************************************************************************************************************-->                                                  
                                                  <!-- Inicio MENU BRAYAN -->
                                                   <input type="hidden" id="rol" value="">
                                            <li  class="has_sub" id="menu_gformulario" style="display: none">
                                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="  md-markunread-mailbox"></i> <span> @@gforrevision@@ </span> <!--Gestión de formularios de revisión -->
                                                  <span class="menu-arrow"></span></a>
                                                  <ul class="list-unstyled">
                                                    <li><a href="javascript:;" id="crear_formulario" name="crear_formulario">@@crear_forrevision@@</a></li> <!--Crear Formulario de revisión -->
                                                    <li><a href="javascript:;" id="asociar_formulario">@@asociar_fortematica@@</a></li>   <!--Asociar formulario a temática -->
                                                    <li><a href="javascript:;" id="modificar_formulario">@@modificar_form_revision@@</a></li>   <!--Modificar formulario a temática -->
                                                  </ul>
                                            </li>
                                                  
                                                  
                                                  
                                                  
                                                  
                                                  
                                                  <!-- FINAL MENU BRAYAN -->
                                                  
                                        <li  class="has_sub" id="menu_groles" style="display: none">
                                          <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" md-wallet-membership"></i> <span> @@groles@@ </span> <!--Gestión de Congresos-->
                                            <span class="menu-arrow"></span></a>
                                            <ul class="list-unstyled">
                                              <li><a href="javascript:;" id="sol_revision" ><i class="md-settings-power"></i> <span>@@groles@@</span></a></li>
<!--                                              <li><a href="javascript:;" id="irevisores" ><i class="ti-pencil-alt"></i> <span>@@irevisores@@</span></a></li>
                                              <li><a href="javascript:;" id="ieditores_gestores" s><i class="ti-marker-alt"></i> <span>@@ieditores_gestores@@</span></a></li>
                                              <li><a href="javascript:;" id="ieditores_principales" ><i class=" md-perm-data-setting"></i> <span>@@ieditores_principales@@</span></a></li>
                                              <li><a href="javascript:;" id="ieditores_pseccion" ><i class=" md-perm-identity"></i> <span>@@ieditores_pseccion@@</span></a></li>
                                              <li><a href="javascript:;" id="ieditores_sseccion" ><i class=" md-perm-identity"></i> <span>@@ieditores_sseccion@@</span></a></li>
                                              <li><a href="javascript:;" id="iencargado_programa" ><i class=" md-perm-identity"></i> <span>@@iencargado_programa@@</span></a></li>
                                              <li><a href="javascript:;" id="iencargado_vol" ><i class=" md-perm-identity"></i> <span>@@iencargado_vol@@</span></a></li>
                                              <li><a href="javascript:;" id="invitado" ><i class=" md-perm-identity"></i> <span>@@invitado@@</span></a></li>-->
                                            </ul>
                                          </li>                                                  
        </ul>
        <div class="clearfix"></div>
      </div>

      <div class="clearfix"></div>
    </div>

    <div class="user-detail">
      <div class="dropup">
        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
            <img  src="assets/images/users/avatar-2.jpg" id="img_users" alt="user-img" class="img-circle">
          <span class="user-info-span">
            <h5 class="m-t-0 m-b-0" id="user"><?php echo $_SESSION['npersona']; ?></h5>
            <p class="text-muted m-b-0">
              <small><i class="fa fa-circle text-success"></i> <span>Online</span></small>
            </p>
          </span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="javascript:;" id="perfil"><i class="md md-face-unlock"></i>@@perfil@@</a></li>
<!--          <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
          --><li><a href="javascript:;" id="solicitud"><i class="md md-lock"></i>@@solicitudes@@</a></li>
          <li><a href="./logout.php"><i class="md md-settings-power"></i> @@cerrar_sesion@@</a></li>
        </ul>

      </div>
    </div>
  </div>
  <!-- Left Sidebar End -->



  <!-- ============================================================== -->
  <!-- Start right Content here -->
  <!-- ============================================================== -->
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
      <div class="container">
