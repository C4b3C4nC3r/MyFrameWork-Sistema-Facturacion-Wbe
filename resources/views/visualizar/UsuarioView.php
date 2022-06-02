<div class="container px-4">

    <div class="row gx-5">
        <div class="col">
            <form funcion="usuario/setData" tabla="usuario" id="0" accion="Registrar">
                <div class="mb-3 text-center">
                    <h4>
                        Nuevo Usuario <i class="bi bi-cart-plus"></i>
                    </h4>
                </div>
                
                <!-- ANDADIR UN LOGO O IMAGEN -->

                <!-- USUARIO_NAME -->
                <div class="form-floating mb-3">
                <input required name="usuario_name" type="text" class="form-control" id="usuario_name" placeholder="Ej: BigCola peq. de ">
                <label for="usuario_name">Nombre Usuario</label>
                </div>
               <!-- USUARIO_TITULO -->
                <div class="form-floating mb-3">
                <input required name="usuario_titulo" type="text" class="form-control" id="usuario_titulo" placeholder="Ej: BigCola peq. de ">
                <label for="usuario_titulo">Titulo Usuario</label>
                </div>
                <!-- PASSWORD IS DEFAULT USERNAME+YEARS+NAME_SYSTEM -->
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
                    Registro de Usuario <i class="bi bi-card-list"></i>
                </h4>
            </div>
            <div id="response">
                
            </div>  
            <!-- Tabla -->
            <div class="table-responsive">
                <table class="table" col="usuario_id,usuario_name, usuario_titulo,deleted_at" id="tbllistado" tabla="usuario" funcion="/getData">
                    <thead>
                        <th>Editar</th>
                        <th>Usuario</th>
                        <th>Titulo</th>
                        <th>Eliminar</th>
                    </thead>          
                    <tbody>

                    </tbody>    
                </table>
            </div>
        
        
        </div>

    </div>

</div>