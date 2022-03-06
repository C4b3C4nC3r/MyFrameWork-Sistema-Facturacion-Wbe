<?php
class Controller {
    
    //protected $btn_select;
    //protected $btn_delete;
    protected $instanciaModelo;
    protected $instanciaMapa;
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

    //model
    public function getMap(string $ubic,string $mapa)
    {
        require $ubic;
        $this->instanciaMapa = new $mapa();
    }
    public function setMap(string $ubic,string $mapa)
    {
        require $ubic;
        return $this->instanciaMapa = new $mapa();
    }

    public function getDataTable(object $request,object $map = null)
    {

        $elementos = $this->__columnaObject($this->instanciaMapa);
        $elemento = $elementos[0]; //siempre sera el id
        $this->instanciaMapa = (is_null($map))?$this->instanciaMapa:$map;
        $id = null;
        $datos = Array();
        while ($fila = $request->fetch_object()) {       
            
            $id = $fila->$elemento;
            $fila->$elemento = $this->createBtnSelect($id);    
            $fila->deleted_at = $this->createBtnDelete($id);
            
            $datos [] = array_values((array)$fila);
        }

        $resultado = array(
            "sEcho" => 1,
            "iTotalRecords"=>count($datos),
            "iTotalDisplayRecords"=>count($datos),
            "aaData"=>$datos
        );
        return json_encode($resultado);
    }
    protected function createBtnSelect($valor)
    {
        $btn = "
            <button onclick='darDatos(true,/getDataForEdit/,".$valor.")' class='btn btn-primary seeData' type='button'>
                <i class='bi bi-pencil-square'></i>
            </button>
        ";

        return $btn;
    }
    protected function createBtnDelete($valor)
    {
        $btn = "
            <button onclick='eliminarDato(true,/trashData/,".$valor.")' class='btn btn-danger delData' type='button'>
                <i class='bi bi-trash'></i>
            </button>
        ";
        return $btn;   
    }

    function __columnaObject(object $mapa)
    {
        //retornaremos los nombres de las columnas
        $col = array_keys((array)$mapa);
        return $col;
    }
}



?>