<?php
    /**
    *
    * CLASSNAME FACTURACONTROL
    *
    */


    class FacturaControl extends Controller{
        
        function __construct() {
            parent::__construct();
        
        }
                
        function getView()
        {
            $this->view->renderView("factura"); 
        }
        
        function setData()
        {

            //formato 2022-04-14 20:20:00
            if($_POST["nombre_tabla"] == "factura"){
                $_POST["columnas_valores"]["factura_fecha"] = date("Y-m-d H-i-s");
            }
            //echo json_encode($_POST);
            //al recibir el id de factura :)
            echo ($this->instanciaModelo->insertar($_POST))?true:false;
            
        }
        
        function getData()
        {
            $map = $this->setMap("../https/model/mapas/TemporalMap.php","TemporalMap");
            //$response = $this->instanciaModelo->seleccionar($_POST);

            $sql = "select sistemafacturacion.temporal.temporal_id as temporal_id,
            sistemafacturacion.temporal.temporal_cantidad as cantidad, 
            sistemafacturacion.product.product_name as producto,
            sistemafacturacion.product.product_price as precio,
            sistemafacturacion.temporal.temporal_cantidad * sistemafacturacion.product.product_price as valor_total
            from sistemafacturacion.product, sistemafacturacion.temporal
            where sistemafacturacion.product.product_id = sistemafacturacion.temporal.temporal_tabla_id
            and sistemafacturacion.temporal.deleted_at is null;";
            $response = $this->instanciaModelo->seleccionPersonalizada($sql);
            if(is_object($response)){
                echo $this->getDataTable($response,$map);
            }else{
                echo $response;
            }
        }
        
        function getDataForEdit($parametro = null)
        {
            echo json_encode($this->instanciaModelo->seleccionarPorId($_POST));
        }
        
        function setDataUpdate($post = null)
        {
            echo ($this->instanciaModelo->actualizar(is_null($post)?$_POST:$post))?true:false;
        }
        
        function trashData($post = null)
        {
            echo ($this->instanciaModelo->eliminar(is_null($post)?$_POST:$post))?true:false;
        }
        //funcion para busqueda

        function getByLike()
        {
            $response = $this->instanciaModelo->seleccionarByLike($_POST);
            if(is_object($response)){
                echo $this->getDivBuscador($response);
            }else{
                echo $response;
            }
        }

        //funcoon para obtener el subtotal
        function getSubtotal()
        {

            $sql= "
            select sistemafacturacion.temporal.temporal_cantidad * sistemafacturacion.product.product_price as subtotal_det
            from sistemafacturacion.product, sistemafacturacion.temporal
            where sistemafacturacion.product.product_id = sistemafacturacion.temporal.temporal_tabla_id
            and sistemafacturacion.temporal.deleted_at is null;
            ";
            echo json_encode(mysqli_fetch_all($this->instanciaModelo->seleccionPersonalizada($sql)));

        }


        /**
         * 
         * Funcones personzalizadas
         * 
         * DEVOLUCION -> VISTA
         * DEVOLUCIONDATA->REGISTROS->(SEE, FECHA, CLIENTE,TOTAL,DEVOLUCION)
         * * SUSPENDER -> VISTA
         * SUSPENDERDATA->REGISTROS->(SEE, FECHA, CLIENTE,TOTAL,SUSPENCION)
         * 
         */

        public function registros()
        {
            $this->view->renderView("factura-registro"); 
            
        }

        function registrosData(){
            
            $sql = "select factura.factura_id,factura.factura_fecha,concat(cliente.cliente_lastname,' ',cliente.cliente_name) kf_cliente_id,factura_total,factura.deleted_at from factura,cliente
            where factura.kf_cliente_id = cliente.cliente_id;";
            $map = (object)["factura_id"=>null,"factura_fecha"=>null,"kf_cliente_id"=>null,"factura_total"=>null];
 
            $response = $this->instanciaModelo->seleccionPersonalizada($sql);
            
            
            if(is_object($response)){
                echo $this->getDataTable($response,$map,"show&unabled");
            }else{
                echo $response;
            }
            
        }


        public function registrosdetalle()
        {
            $map = $this->setMap("../https/model/mapas/DetalleFacturaMap.php","DetalleFacturaMap");
            $sql ="select detalle_factura_id,product_name,detalle_factura_cantidad,detalle_factura_valor_unitario,detalle_factura_total  from detalle_factura, product where kf_factura_id = '".$_POST["kf_factura_id"]."' and detalle_factura.kf_producto_id = product.product_id ";
            $response = $this->instanciaModelo->seleccionPersonalizada($sql);

            if(is_object($response)){
                echo $this->getDataTable($response,$map,"edit");
            }else{
                echo $response;
            }
        }

        public function registrostrash()
        {
            echo $this->trashData($_POST);
        }
        public function registrosuntrash()
        {
            echo $this->instanciaModelo->reutilizarRegistro($_POST);
        }
    }