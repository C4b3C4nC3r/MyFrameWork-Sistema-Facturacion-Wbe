<?php

    /*AQUI ES DONDE VA ARRANZAR UNA CLASE */
    namespace AppInicialization;


    class AppInicialization{
        //Elemntos
        public $url;
        protected $control;
        protected $model;
        protected $mapa;
        protected $trim;
        protected $explode;
        protected $instancia;     
        //constructor
        public function __construct() {


            $this->setUrl((isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : null);
        
            if(is_null($this->url)){
                die("Error de Variables del servidor, REQUEST_URI, NO EXISTE");
            }
        
            $this->setTrim($this->getUrl());
            $this->setExplode((empty($this->getTrim())) ? "home" : $this->getTrim() );
            //buscaran archivos
            $this->setControl(ucfirst($this->getExplode()[0]));
            $this->setModel(ucfirst($this->getExplode()[0]));
            $this->setMapa(ucfirst($this->getExplode()[0]));
            $this->defectoRuta();
            //echo var_dump($this->getExplode());
            //echo $this->getControl();
            return false;
        }
        //url
        protected function setUrl($newUrl)
        {
            $this->url = $newUrl; 
        }
        protected function getUrl()
        {
            //retorna REQUEST_URI
            return $this->url;
        }
        //url
        protected function setTrim($newTrim)
        {
            $this->trim = trim($newTrim,"/"); 
            
        }
        protected function getTrim()
        {
            //retorna los caracteres
            return $this->trim;
        }
        //explode
        protected function setExplode($newExplode)
        {
            $this->explode = explode("/",$newExplode); 
        }
        protected function getExplode()
        {
            //retorna el array
            return $this->explode;
        }
        //control
        protected function setControl($newControl)
        {
            $this->control = (file_exists($_ENV['DEFAULT_RUTA_CONTROL'].$newControl.$_ENV['CONVENCION_CONTROL']))?$newControl:'Error';
        }
        protected function getControl()
        {
            //retorna el nombre del archivo del control
            return $_ENV['DEFAULT_RUTA_CONTROL'].$this->control.$_ENV['CONVENCION_CONTROL'];
        }
        //model
        protected function setModel($newModel)
        {
            $this->model = (file_exists($_ENV['DEFAULT_RUTA_MODEL'].$newModel.$_ENV['CONVENCION_MODEL']))?$newModel:'Error';
        }
        protected function getModel()
        {
            //retorna el nombre del archivo del modelo
            return $_ENV['DEFAULT_RUTA_MODEL'].$this->model.$_ENV['CONVENCION_MODEL'];
        }
        //mapa
        protected function setMapa($newMapa)
        {
            $this->mapa = (file_exists($_ENV['DEFAULT_RUTA_MAPA'].$newMapa.$_ENV['CONVENCION_MAPA']))?$newMapa:'Error';
        }
        protected function getMapa()
        {
            //retorna el nombre del archivo del modelo
            return $_ENV['DEFAULT_RUTA_MAPA'].$this->mapa.$_ENV['CONVENCION_MAPA'];
        }
        //funciones

        function defectoRuta()
        {
            $controll = $this->control."Control";
            require_once $this->getControl();
            $this->instancia = new $controll;
            $this->instancia->getModel($this->getModel(),$this->model."Model");
            $this->instancia->getMap($this->getMapa(),$this->mapa."Map");
            $len_parametros = sizeof($this->explode);
            if ($len_parametros>1) {
                if(method_exists($this->instancia,$this->explode[1])){
                    if ($len_parametros>2) {
                        $params = [];
                        for ($i=2; $i < $len_parametros; $i++) { 
                            array_push($params,$this->explode[$i]);
                        }
                        $this->instancia->{$this->explode[1]}($params);
                    } else {
                        
                        $this->instancia->{$this->explode[1]}();
                    }   
                }else{
                    $this->instancia->getView();
                }
            } else {
                $this->instancia->getView();
            }
        }
    }
?>


