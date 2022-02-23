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
            $this->modelo->insertar($_POST);
        }
        
        function getData()
        {
            $response = $this->modelo->seleccionar($_POST);
            if(is_object($response)){
                $this->getDataTable($response);
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
            $this->modelo->actualizar($_POST);
        }
        
        function trashData()
        {
            $this->modelo->eliminar($_POST);
        }
    }