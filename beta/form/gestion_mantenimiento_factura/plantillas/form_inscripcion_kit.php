<!--Archivo para la creacion/modificacion de tour   
Brayan Triminio
06/09/2017-->

    <div class="col-lg-6">
        <div class="card-box">
            <h4>@@gestionar_articulo@@</h4>
            <p class="text-muted font-13 m-b-30">
                @@introduce_datos_articulo@@
            </p>
            <form class="form-horizontal" method="POST"  id="form_articulo"  name = "form_articulo" role="form"  data-parsley-validate novalidate>
                <input type="hidden" id="caso" value="guardar_articulo">
                <input type="hidden" id="articulos" value="0">
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@aticulo@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "articulo" name = "articulo" class="form-control" required placeholder="@@aticulo@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@precio@@</label>
                    <div class="col-sm-7">
                        <input type="text"  id = "precio" name = "precio" maxlength="6" class="form-control" required placeholder="@@precio@@" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@descripcion@@</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" type="text" id = "descripcion" name = "descripcion" class="form-control" required  placeholder="@@descripcion@@" ></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label" >@@impuesto@@</label>
                    <div class="col-md-7" align="right">                                             
                         <select class="form-control"  id="impuesto" name="impuesto" >
                            <option value="0">@@seleccione@@</option>
                            <option value="1">@@grabado@@</option>
                            <option value="2">@@exento@@</option>
                         </select>
                     </div> 
                </div>

                <div class="row" align="center">
                    <div class="form-group">
                        <button id = "btn_guardar_articulo" value="btn_guardar_articulo" class="crear_linea btn btn-primary waves-effect waves-light">
                            @@btn_guardar@@
                        </button>
                        
                    </div>
                </div>
            </form>
            
        </div>                
    </div><br>
    <div class="col-lg-6">
        <div class="card-box table-responsive" >
            <h4>@@listado_articulos@@</h4>
            <p class="text-muted font-13 m-b-30">
                <!--@@instrucciones_lineas@@-->
                @@instrucciones_articulos@@
            </p>

            <table id="tbl_articulos" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="3%">@@num@@</th>
                        <th>@@nombre_articulos@@</th>
                        <th>@@descripcion@@</th>
                        <th>@@acciones@@</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


<script src="./js/gestion_mantenimiento_factura/mantenimiento_factura.js"></script>




