<?php

    /**
     *
     *
     *CLASSNAME CLIENTEMODEL
     *
    */

    class ClienteModel extends Models{
        
        function __construct() {
            parent::__construct();
        }
        
        function insertar(array $datos)
        {
            return $this->sqlInsertar($datos);            
        }

        function actualizar(array $datos)
        {
            return $this->sqlActualizar($datos);
        }

        function eliminar(array $datos)
        {
            return $this->sqlEliminarLogicamente($datos);
        }

        function destruir(array $datos)
        {
            return $this->sqlEliminarFisicamente($datos);
        }

        function seleccionarPorId(array $datos)
        {
            return $this->sqlSeleccionarPorId($datos);
        }

        function seleccionarTodo(array $datos)
        {
            return $this->sqlSeleccionarTodo($datos);
        }

        function seleccionar(array $datos)
        {
            return $this->sqlSeleccionar($datos);
        }

    }

?>