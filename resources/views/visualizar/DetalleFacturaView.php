<div class="container px-4">
            <!-- Tabla -->
            <div class="table-responsive">
                <table class="table" id="tbllistado" tabla="factura" funcion="Data">
                    <thead>
                        <th>Detalle</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Opcion</th>
                    </thead>          
                    <tbody>

                    </tbody>    
                </table>
            </div>
        
</div>


<div id="tabladetalle" class="modal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalle Factura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <table id="tabladetallemodal">
              <thead>
                <th>Opcion</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Valor Unitario</th>
                <th>Valor Conjunto</th>  
              </thead>
              <tbody>

              </tbody>
          </table>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    
        </div>
    </div>
  </div>
</div>