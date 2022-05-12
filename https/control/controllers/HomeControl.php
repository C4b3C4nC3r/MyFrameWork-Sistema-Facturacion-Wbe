<?php

    class HomeControl extends Controller 
    {
        function __construct() {
            parent::__construct();
        }
        public function getView()
        {
            //$this->instanciaModelo->hello();
            $this->view->renderView("home"); 
        }
        public function confirm()
        {

            $response = $this->instanciaModelo->consultarUsuario($_POST);
            if(is_object($response)){
                $this->getSessionUser($response);
                echo 2;
            }else{
                echo $response;
            }
        }

        public function destroysession()
        {
            //session_start();
            session_unset();
            session_destroy();
            $this->view->user = null;
            header("Location: /");
            //return true;
        }
    }
    
    


?>