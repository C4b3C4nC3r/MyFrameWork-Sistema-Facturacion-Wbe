<?php

require $_ENV["LOGIN_RUTA_HEADER"];


if(file_exists($_ENV["NAVBAR_JSON"])){

    $file_json = file_get_contents($_ENV['NAVBAR_JSON']);
    $json = json_decode($file_json,true);
    //echo var_dump($json);

}
$logo_nocturno = $json['logo-matutino'];


?>
<div class="text-center">
  
  <div class="form-floating  mb-3">
    <!-- IMAGEN O LOG EMPRESA -->
    <img src="<?php echo $logo_nocturno?>" class="rounded" alt="..." width="30%">
    
  </div>
  <div class="container col-6">
    
      <div class="response">
          <h3>Entrando a Cuenta</h3 >
          <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        <hr>          
      </div>
      <div id="form">
        <form funcion="home/confirm" tabla="usuario" id="0" accion="Ingresar">
          <div class="form-floating mb-3">
            <input type="text" name="usuario_name" class="form-control" id="usuario_name" id="floatingInput" required placeholder="usuario123">
            <label for="floatingInput">Usuario</label>
          </div>
          <div class="form-floating  mb-3">
            <input type="password" name="usuario_password" id="usuario_password" class="form-control" id="floatingPassword" required placeholder="Password">
            <label for="floatingPassword">Clave</label>
          </div>
          <div class="form-floating mb-3">
            <button class="btn btn-primary" type="submit">Ingresar</button>
            <button class="btn btn-secondary" type="reset">Limpiar</button>
          </div>


        </form>
      </div>
      
  </div>
  
</div>




<?php

require $_ENV["DEFAULT_RUTA_FOOTER"];


?>