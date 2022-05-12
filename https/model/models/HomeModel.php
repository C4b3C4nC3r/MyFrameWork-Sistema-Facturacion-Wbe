<?php
class HomeModel extends Models{
    function __construct() {
        parent::__construct();
    }

    public function consultarUsuario(array $datos)
    {
        return $this->sqlSeleccionarPorWhere($datos);
    }

}


?>