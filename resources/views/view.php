<?php

class View{

    function __construct() {

    }

    public function renderView(string $view)
    {
        $file_json = file_get_contents($_ENV['ROUTER_JSON']);
        $json = json_decode($file_json,true);
        if(file_exists($json[$view])){
            $this->visualizar = $json[$view];
            require $_ENV["PLANTILLA"];
        }
    }


}


?>