<div class="container px-4">

    <div class="row gx-5">
        <div class="col">
            <form funcion="/setData" tabla="factura" id="0" accion="Registrar">
                <div class="mb-3 text-center">
                    <h4>
                        Nueva Factura <i class="bi bi-cart-plus"></i>
                    </h4>
                </div>
                <!-- ANDADIR UN LOGO O IMAGEN -->

                <!-- FACTURA_NAME -->
                <div class="form-floating mb-3">
                    <input type="hidden" name="kf_cliente_id" id="kf_cliente_id">
                    <input required funcion="/getByLike" columna="cliente_name" idresponse="#responseC" name="kf_cliente" type="text" class="form-control" id="kf_cliente" placeholder="Ej: BigCola peq. de ">
                    <label for="kf_cliente">Cliente</label>
                    <ul style="z-index: 2000;position: absolute;" id="responseC" class="list-group response">
                                
                    </ul>   
                </div>
                <div class="form-floating mb-3">
                    <input required name="factura_fecha" type="datetime-local" class="form-control" id="factura_fecha" placeholder="Ej: BigCola peq. de ">
                    <label for="factura_fecha">Fecha</label>
                </div>
                <!-- AQUI EMPIEZAN DOBLE FILA -->
                <div class="row g-2">
                    <div class="col-md form-floating mb-3 ">
                        <input required name="factura_subtotal" readonly  type="text" class="form-control" id="factura_subtotal" funcion = "/getSubtotal" placeholder="Ej: BigCola peq. de ">
                        <label for="factura_subtotal">SubTotal</label>
                    </div>
                    <!-- EL porcentaje del iva debe de ser dinamico asi que en un futuro se tendra en forma de objeto jso, para trabajar mejor en vez de ponerl aqyui :) -->
                    <div class="col-md form-floating mb-3">
                        <select class="form-select" id="iva_porcentaje">
                            <option value="0">IVA 0%</option>
                            <option value="12">IVA 12%</option>
                            <option value="14">IVA 14%</option>
                        </select>
                        <label for="iva_porcentaje">Procentaje Iva</label>
                    </div>
                    <div class="col-md form-floating mb-3">
                        <input required name="factura_iva" readonly type="text" class="form-control" id="factura_iva" placeholder="Ej: BigCola peq. de ">
                        <label for="factura_iva">I.V.A</label>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md form-floating mb-3">
                        <input required readonly name="factura_descuento" type="text" class="form-control" id="factura_descuento" placeholder="Ej: BigCola peq. de ">
                        <label for="factura_descuento">Descuento</label>
                    </div>
                    <!-- SE USARA UNA PETICION POR JQUERY EN EUNA FUNCION QUE TRAIGA LOS DESCUENTOS QUE EXISTAN DENTRODE LOS PRODUCTOS O ALGO POR ESTILO :v -->
                    <div class="col-md form-floating mb-3">
                        <select class="form-select" id="descuento_porcentaje">
                            <option value="0">---Ninguno---</option>
                            <option value="1">1%</option>
                            <option value="2">2%</option>
                            <option value="4">4%</option>
                            <option value="5">5%</option>
                            <option value="10">10%</option>
                        </select>
                        <label for="descuento_porcentaje">Descuento</label>
                    </div>
                    <!-- FIN -->
                    <div class="col-md form-floating mb-3">
                        <input required name="factura_efectivo" type="text" class="form-control" id="factura_efectivo" placeholder="Ej: BigCola peq. de ">
                        <label for="factura_efectivo">Efectivo</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input required name="factura_cambio" readonly type="text" class="form-control" id="factura_cambio" placeholder="Ej: BigCola peq. de ">
                    <label for="factura_cambio">Cambio</label>
                </div>
                <div class="form-floating mb-3">
                    <input required name="factura_total" readonly type="text" class="form-control" id="factura_total" placeholder="Ej: BigCola peq. de ">
                    <label for="factura_total">Total A Pagar</label>
                </div>
                <!--BUTTONS-->
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="submit" id="submit" class="btn btn-outline-primary">Agregar</button>
                    <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                    <button type="button" class="btn btn-outline-indo">Bloquear</button>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="mb-3 text-center">
                <h4>
                    Registro Detalle Factura <i class="bi bi-card-list"></i>
                </h4>
            </div>
            <!--Btn para agregar el Producto en tabla temporal-->
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Agregar
                    </button>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto Factura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    
                        <form autocomplete="off" funcion="/setData" tabla="temporal" id="0" accion="Registrar">

                            <!-- 
                                INPUTS SECRETOS
                             -->
                                <input type="hidden" id="temporal_tabla_name" name="temporal_tabla_name" value="product">
                                <input type="hidden" name="kf_usuario_id" id="kf_usuario_id" value="1">
                                <input type="hidden" name="temporal_tabla_id" id="temporal_tabla_id">

                            <div class="form-floating mb-3">
                                <input required columna="product_name" funcion="/getByLike" idresponse="#responseB" name="buscar_tabla_id" type="text" class="form-control" id="buscar_tabla_id" placeholder="Ej: BigCola... ">
                                <label for="buscar_tabla_id">Producto</label>
                                <ul style="z-index: 2000;position: absolute;" id="responseB" class="list-group response">
                                
                                </ul>                                
                            </div>
                                
                            <div class="form-floating mb-3">
                                <input required name="temporal_cantidad" type="number" class="form-control" id="temporal_cantidad" placeholder="Ej: 1...10...100 ">
                                <label for="temporal_cantidad">Cantidad</label>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Tabla -->
            <div class="table-responsive">
                <table class="table" id="tbllistado" tabla="temporal" funcion="/getData">
                    <thead>
                        <th>Editar</th>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Valor Unitario</th>
                        <th>Valor Total</th>
                        <th>Eliminar</th>
                    </thead>          
                    <tbody>

                    </tbody>    
                </table>
            </div>
        
        
        </div>

    </div>

</div>


