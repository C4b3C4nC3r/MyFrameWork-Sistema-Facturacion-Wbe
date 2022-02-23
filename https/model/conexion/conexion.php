<?php
/*
 *CLASE DE CONEXION 
 */

class Conexion {
    /*ELEMENTOS PRIVADOS DE LA CLASE */    
    private $conexion;
    private $base_datos_alojamiento;
    private $base_datos_usuario;
    private $base_datos_clave;
    private $base_datos_caracteres;
    private $base_datos_nombre;
    //constructor
    function __construct() {   

    }
    //funcion que se conecta a la basede datos y retorna, 
    public function conexionMySqli()
    {
        //usamos los elementos, rellenando estos elementos
        $this->base_datos_alojamiento = $_ENV['BASE_DATOS_ALOJAMIENTO'];
        $this->base_datos_usuario = $_ENV['BASE_DATOS_USUARIO'];
        $this->base_datos_clave = $_ENV['BASE_DATOS_CLAVE'];
        $this->base_datos_caracteres = $_ENV['BASE_DATOS_CARACTERES'];
        $this->base_datos_nombre = $_ENV['BASE_DATOS_NOMBRE'];
        //hacemos un instancia, y le damoslos elementos
        $this->conexion = new mysqli($this->base_datos_alojamiento,$this->base_datos_usuario,$this->base_datos_clave,$this->base_datos_nombre);
        /*
         *usamosla funcion mysql_query(que recibe instancia de mysqli, y una sentencia SQL) 
        */ 
        mysqli_query($this->conexion,'SET NAMES"'.$this->base_datos_caracteres.'"');
        //caso que alla un error
        if (mysqli_connect_errno()) {
            print_r( "Fallo conexion de la base de datos:".$this->base_datos_nombre." %s\n",mysqli_connect_error()) ;
            exit(); //salimos
        }
        //retornamos la instancia de conexion :)
        return $this->conexion;
    }
}

?>