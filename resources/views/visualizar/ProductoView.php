<div class="container px-4">

    <div class="row gx-5">
        <div class="col">
            <form funcion="producto/setData" tabla="product" id="0" accion="Registrar">
                <div class="mb-3 text-center">
                    <h4>
                        Nuevo Producto <i class="bi bi-cart-plus"></i>
                    </h4>
                </div>
                
                <!-- ANDADIR UN LOGO O IMAGEN -->

                <!-- PRPDRUCT_NAME -->
                <div class="form-floating mb-3">
                <input required name="product_name" type="text" class="form-control" id="product_name" placeholder="Ej: BigCola peq. de ">
                <label for="product_name">Producto</label>
                </div>
                <!-- PRODUCT_PRICE -->
                <div class="form-floating mb-3">
                <input required name="product_price" type="text" class="form-control" id="product_price" placeholder="Ej: BigCola peq. de ">
                <label for="product_price">Precio</label>
                </div>
                <!-- PRODUCT_DATE_SHOP -->
                <div class="form-floating mb-3">
                <input required name="product_date_shop" type="date" class="form-control" id="product_date_shop" placeholder="Ej: BigCola peq. de ">
                <label for="product_date_shop">Fecha de Compra</label>
                </div>
                <!-- PRODUCT_DATE_EXPIRATION -->
                <div class="form-floating mb-3">
                <input required name="product_date_expiration" type="date" class="form-control" id="product_date_expiration" placeholder="Ej: BigCola peq. de ">
                <label for="product_date_expiration">Fecha de Caducidad</label>
                </div>
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
                    Registro de Productos <i class="bi bi-card-list"></i>
                </h4>
            </div>
            <div id="response">
                
            </div>  
            <!-- Tabla -->
            <div class="table-responsive">
                <table class="table" id="tbllistado" tabla="product" funcion="/getData">
                    <thead>
                        <th>Editar</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Fecha Comp.</th>
                        <th>Fecha cadu.</th>
                        <th>Eliminar</th>
                    </thead>          
                    <tbody>

                    </tbody>    
                </table>
            </div>
        
        
        </div>

    </div>

</div>