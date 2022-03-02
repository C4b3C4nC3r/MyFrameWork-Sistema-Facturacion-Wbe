<div class="container px-4">

    <div class="row gx-5">
        <div class="col">
            <form funcion="/setData" tabla="cliente" id="0" accion="Registrar"> 
                <div class="mb-3 text-center">
                    <h4>
                        Nuevo Cliente <i class="bi bi-cart-plus"></i>
                    </h4>
                </div>
                
                <!-- ANDADIR UN LOGO O IMAGEN -->

                <!-- CLIENTE_NAME -->
                <div class="form-floating mb-3">
                <input required name="cliente_name" type="text" class="form-control" id="cliente_name" placeholder="Ej. Enrique Stevan">
                <label for="cliente_name">Nombres</label>
                </div>

                <div class="form-floating mb-3">
                <input required name="cliente_lastname" type="text" class="form-control" id="cliente_lastname" placeholder="Ej. Moran Vera">
                <label for="cliente_lastname">Apellidos</label>
                </div>

                <div class="form-floating mb-3">
                <input required name="cliente_dni" type="text" class="form-control" id="cliente_dni" placeholder="Ej. 120-------7">
                <label for="cliente_dni">Numero de Identidad</label>
                </div>

                <div class="form-floating mb-3">
                <input required name="cliente_email" type="text" class="form-control" id="cliente_email" placeholder="Ej. ejemplo@example.com">
                <label for="cliente_email">Correo Electronico</label>
                </div>

                <div class="form-floating mb-3">
                <input required name="cliente_telf" type="text" class="form-control" id="cliente_telf" placeholder="Ej. 593999----">
                <label for="cliente_telf">Telefono o Celular de Contacto</label>
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
                    Registro de Cliente <i class="bi bi-card-list"></i>
                </h4>
            </div>
            <div id="response">
                
            </div>  
            <!-- Tabla -->
            <div class="table-responsive">
                <table class="table" id="tbllistado" tabla="cliente" funcion="/getData">
                    <thead>
                        <th>Editar</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Eliminar</th>
                    </thead>          
                    <tbody>

                    </tbody>    
                </table>
            </div>
        
        
        </div>

    </div>

</div>