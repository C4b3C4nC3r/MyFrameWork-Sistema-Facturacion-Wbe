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

    }
    
    


?>