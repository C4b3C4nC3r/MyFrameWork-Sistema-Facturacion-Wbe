<?php

class View{

    /**
     * 
     * USER = 
     * [
     *  NAME
     *  STATUS
     *  ROL
     *  PERMISES
     *  IMAGE
     * ]
     * 
     */
    public $user = null;

    function __construct() {
        session_start();
        $this->user = $_SESSION["user"];
    }

    public function renderView(string $view)
    {        
        $file_json = file_get_contents($_ENV['ROUTER_JSON']);
        $json = json_decode($file_json,true);
        if(file_exists($json[$view])){
            //cuando se ejecute la aplicacion, se llama plantilla
            $this->visualizar = $json[$view];
            
            require !is_null($this->user)?$_ENV["PLANTILLA"]:$_ENV["LOGIN"];
        }

    }


}


?>