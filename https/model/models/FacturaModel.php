<?php

    /**
     *
     *
     *CLASSNAME FACTURAMODEL
     *
    */

    class FacturaModel extends Models{
        
        function __construct() {
            parent::__construct();
        }
        
        function insertar(array $datos)
        {
            
            if($datos["nombre_tabla"] == "factura"){
                //proceso de facturacion traslado de lo temporal al detalle_fcatura que es fijo
                $detalle_factura_datos = [];
                $factura_id =  $this->sqlInsertarWithGetId($datos);
                //sentencia para buscar el temporal...
                $sql = "select sistemafacturacion.temporal.temporal_cantidad * sistemafacturacion.product.product_price as temporal_valor_total, product.product_price as temporal_valor_unitario,temporal.temporal_tabla_id,temporal.temporal_cantidad
                from sistemafacturacion.product, sistemafacturacion.temporal
                where sistemafacturacion.product.product_id = sistemafacturacion.temporal.temporal_tabla_id
                and sistemafacturacion.temporal.deleted_at is null";
                
                $det_temp = $this->sqlPersonal($sql);
                
                $detalle_factura = 
                [
                    "kf_factura_id"=>$factura_id,
                    "kf_producto_id"=>null,
                    "detalle_factura_cantidad"=>null,
                    "detalle_factura_valor_unitario"=>null,
                    "detalle_factura_total"=>null
                ];
                while($row = mysqli_fetch_array($det_temp)){
    
                    $detalle_factura["kf_producto_id"] = $row["temporal_tabla_id"];
                    $detalle_factura["detalle_factura_cantidad"] = $row["temporal_cantidad"];
                    $detalle_factura["detalle_factura_valor_unitario"] = $row["temporal_valor_unitario"];
                    $detalle_factura["detalle_factura_total"] = $row["temporal_valor_total"];
    
                    array_push($detalle_factura_datos,$detalle_factura);
                }
    
                $confirm = false;
                foreach ($detalle_factura_datos as $key => $detalle) {
    
                    $confirm = ($this->sqlInsertar(["nombre_tabla"=>"detalle_factura","columnas_valores"=>$detalle]))?true:false;
                }
    
                //vaciamos el temporal :) segun nuestra session
                $kf_usuario_id = "1";
    
                $sql = "DELETE FROM `temporal` WHERE kf_usuario_id = '".$kf_usuario_id."'";
                
                $confirm = $this->sqlPersonal($sql);
    
                return $confirm;

    
            }else{
                return $this->sqlInsertar($datos);
            }
            

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
        function seleccionarByLike(array $datos)
        {
            return $this->sqlSeleccionarPorLike($datos);
        }

        //funcion personalizada

        function seleccionPersonalizada(string $sql)
        {
            return $this->sqlPersonal($sql);
            
        }



    }

?>