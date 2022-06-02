<?php
    /**
    *
    * CLASSNAME USUARIOCONTROL
    *
    */


    class UsuarioControl extends Controller{
        
        function __construct() {
            parent::__construct();
        }
          
        function getView()
        {
            $this->view->renderView("usuario"); 
        }
        
        function setData()
        {
            //darle una contrasena por defecto EJ: admin_2022?tuempresa
            (!isset($_POST["columnas_valores"]["usuario_password"]))?$_POST["columnas_valores"]["usuario_password"] = $this->getPasswordDefault($_POST["columnas_valores"]["usuario_name"],date("Y"),"SistemaFacturacion"):null;


            echo ($this->instanciaModelo->insertar($_POST))?true:false;
        }
        
        //va en mapa pero por temas de desarrollo progresivo lo ejamos aqui...

        public function getPasswordDefault($user_name,$year,$companyname)
        {
            return $user_name."_".$year."?".$companyname;
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
    }