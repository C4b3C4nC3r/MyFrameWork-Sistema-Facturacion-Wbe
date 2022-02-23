<?php

    require $_ENV["DEFAULT_RUTA_HEADER"];


    require (isset($this->visualizar)) ? $this->visualizar  : "errores/error404.php" ;


    require $_ENV["DEFAULT_RUTA_FOOTER"];

?>



