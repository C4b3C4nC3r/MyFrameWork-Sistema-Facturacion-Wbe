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
            $response = $this->instanciaModelo->seleccionar($_POST);
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
            echo json_encode($this->instanciaModelo->seleccionarByLike($_POST));
        }
    }