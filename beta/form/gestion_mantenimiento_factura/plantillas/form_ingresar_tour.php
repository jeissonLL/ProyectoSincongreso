<!--Archivo para la creacion/modificacion de tour   
Brayan Triminio
05/09/2017-->

    <div class="col-lg-6">
        <div class="card-box">
            <h4>@@gestionar_tour@@</h4>
            <p class="text-muted font-13 m-b-30">
                @@introduce_datos_tour@@
            </p>
            <form class="form-horizontal" method="POST"  id="form_tour"  name = "form_tour" role="form"  data-parsley-validate novalidate>
                <input type="hidden" id="caso" value="guardar_tour">
                <input type="hidden" id="tour" value="0">
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@nombre_tour@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "nombretour" name = "nombretour" class="form-control" required placeholder="@@nombre_tour@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@descripcion@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "descripcion" name = "descripcion"  class="form-control" required placeholder="@@descripcion@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@comentario@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "comentario" name = "comentario" class="form-control" required  placeholder="@@comentario@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@costo@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "costo" name = "costo" class="form-control" required  placeholder="@@costo@@" />
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
                        <button id = "btn_crear_tour" value="btn_crear_tour" class="crear_linea btn btn-primary waves-effect waves-light">
                            @@btn_guardar@@
                        </button>
                        
                    </div>
                </div>
            </form>
            
        </div>                
    </div><br>
    <div class="col-lg-6">
        <div class="card-box table-responsive" >
            <h4>@@listado_tours@@</h4>
            <p class="text-muted font-13 m-b-30">
                <!--@@instrucciones_lineas@@-->
                @@instrucciones_tour@@
            </p>

            <table id="tbl_tours" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="3%">@@num@@</th>
                        <th>@@nombre_tour@@</th>
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




