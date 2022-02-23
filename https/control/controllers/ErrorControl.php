<?php

    class ErrorControl extends Controller 
    {
        function __construct() {
            parent::__construct();
        }
        public function getView()
        {
            //$this->instanciaModelo->hello();
            $this->view->renderView("error404"); 
        }

    }
    
    


?>