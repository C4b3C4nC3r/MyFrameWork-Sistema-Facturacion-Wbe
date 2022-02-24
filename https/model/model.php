<?php
    class Models{
        /**
         * 
         * REQ : COLUMNAS_REQUERIDAS, NOMBRE_TABLA, COLUMNAS_VALORES, FECHA_ELIMINADO
         * 
         */
        function __construct() {
     
            $this->conexion = new  Conexion();
        }
     
        public function sqlSeleccionar(array $datos)
        {
            $sql = "SELECT ";           
            $columnas = ($datos['columnas_requeridas'] == null)?'* ':$datos['columnas_requeridas'];
            $from_where = " FROM ".$datos['nombre_tabla']." WHERE `deleted_at` IS NULL" ;
            $sentencia = $sql .$columnas .$from_where;
            return $this->conexion->conexionMysqli()->query($sentencia);
            
        }
        public function sqlSeleccionarTodo(array $datos)
        {
            $sql = "SELECT ";
            $columnas = ($datos['columnas_requeridas'] == null)?'* ':$datos['columnas_requeridas'];
            $from_where = " FROM ".$datos['nombre_tabla'];
            $sentencia = $sql .$columnas .$from_where;
            return $this->conexion->conexionMysqli()->query($sentencia);
            
        }

        public function sqlSeleccionarPorId(array $datos)
        {
            $sql = "SELECT ";
            $columnas = ($datos['columnas_requeridas'] == null)?'* ':$datos['columnas_requeridas'];
            $from_where = " FROM ".$datos['nombre_tabla'] ." WHERE ".$datos['nombre_tabla']."id = ".$datos['id'] ;
            $sentencia = $sql .$columnas .$from_where;
            return $this->conexion->conexionMysqli()->query($sentencia);
            
        }
        public function sqlInsertar(array $datos)
        {
            $sql = "INSERT INTO ".$datos['nombre_tabla'];
            //(``,)Values()
            $columnas ="(";
            $claves = array_keys($datos['columnas_valores']); //hace un array de llaves
            $valores = array_values($datos['columnas_valores']); //hace un array de valores
            $values = "VALUES (";

            for ($i=0; $i <= count($claves)-1 ; $i++) {
                $columnas = ($i == count($claves)-1) ? $columnas." `".$claves[$i]."`)" : $columnas." `".$claves[$i]."`," ;
                $values = ($i == count($valores)-1) ? $values." '".$valores[$i]."')" : $values." '".$valores[$i]."'," ;
            }
            //terminar (``,``..)            
            $sentencia = $sql .$columnas .$values;
            return $this->conexion->conexionMysqli()->query($sentencia);
        
        }
        public function sqlActualizar(array $datos)
        {
            $sql = "UPDATE `".$datos['nombre_tabla']."` ";
            $set = "SET ";
            $claves = array_keys($datos['columnas_valores']); //hace un array de llaves
            $valores = array_values($datos['columnas_valores']); //hace un array de valores
            for ($i=0; $i <= count($claves)-1 ; $i++) {
                $set = ($i == count($valores)-1) ? $set." `".$claves[$i]."` = ".$valores[$i] : $set." `".$claves[$i]."` = ".$valores[$i]."," ;
            }
            $where = " WHERE ".$datos['nombre_tabla']."id = ".$datos['id'];
            $sentencia = $sql .$set .$where;
            return $this->conexion->conexionMysqli()->query($sentencia);

        
        }
        public function sqlEliminarLogicamente(array $datos)
        {
            $sql = "UPDATE `".$datos['nombre_tabla']."` SET `delete_at` = ".$datos['fecha_eliminado']."WHERE `".$datos['nombre_tabla']."id` = ".$datos['id'];
            $sentencia = $sql;
            return $this->conexion->conexionMysqli()->query($sentencia);

        }
        public function sqlEliminarFisicamente(array $datos)
        {
            $sql = "DELETE FROM ".$datos['nombre_tabla']." WHERE ".$datos['nombre_tabla']."id = ".$datos['id'];
            $sentencia = $sql;
            return $this->conexion->conexionMysqli()->query($sentencia);
        }
    }


?>