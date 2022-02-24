<?php
class Controller {
    
    public $instanciaModelo;
    function __construct() {
        //vista instancia    
        $this->view = new View();
    } 
    //model
    public function getModel(string $ubic,string $modelo)
    {
        require $ubic;
        $this->instanciaModelo = new $modelo();
    }
    public function getDataTable(object $request)
    {
        $datos = Array();
            //estructura iterativa
        while ($fila = $request->fetch_object()) {
            $datos [] = array_values((array)$fila);
        }
            //para el datatable
        $resultado = array(
            "sEcho" => 1,
            "iTotalRecords"=>count($datos),
            "iTotalDisplayRecords"=>count($datos),
            "aaData"=>$datos
        );
        return json_encode($resultado);
    }
    

}



?>