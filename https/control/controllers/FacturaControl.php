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
            and sistemafacturacion.temporal.deleted_at is null;
            
            ";
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
        
        function setDataUpdate()
        {
            echo ($this->instanciaModelo->actualizar($_POST))? true : false;
        }
        
        function trashData()
        {
            echo ($this->instanciaModelo->eliminar($_POST))?true:false;
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
    }