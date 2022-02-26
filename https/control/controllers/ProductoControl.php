<?php
    /**
    *
    * CLASSNAME PRODUCTOCONTROL
    *
    */
    class ProductoControl extends Controller{
        
        function __construct() {
            parent::__construct();
        }
        
        function getView()
        {
            $this->view->renderView("producto"); 
        }
        
        function setData()
        {
            $this->instanciaModelo->insertar($_POST);
        }
        
        function getData()
        {
            $response = $this->instanciaModelo->seleccionar($_POST);
            if(is_object($response)){
                echo $this->getDataTable($response);
            }else{
                echo $response;
            }
        }
        
        function getDataForEdit($parametro = null)
        {
            echo $parametro[0];
        
        }
        
        function setDataUpdate()
        {
            $this->instanciaModelo->actualizar($_POST);
        }
        
        function trashData()
        {
            $this->instanciaModelo->eliminar($_POST);
        }
    }