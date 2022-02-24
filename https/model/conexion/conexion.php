<?php
/*
 *CLASE DE CONEXION 
 */

class Conexion {
    /*ELEMENTOS PRIVADOS DE LA CLASE */    
    protected $conexion;
    protected $base_datos_alojamiento;
    protected $base_datos_usuario;
    protected $base_datos_clave;
    protected $base_datos_caracteres;
    protected $base_datos_nombre;
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

    public function conexionPDO()
    {
        try{

            $connection = "mysql:host=" . $this->base_datos_alojamiento . ";dbname=" . $this->base_datos_nombre . ";charset=" . $this->base_datos_caracteres;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->base_datos_usuario, $this->base_datos_clave, $options);
 
            return $pdo;
 
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }
}


?>