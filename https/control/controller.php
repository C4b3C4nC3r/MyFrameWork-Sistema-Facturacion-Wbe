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

    public function getDataTable(object $request,object $map = null, string $btn = null)
    {
        $elementos = $this->__columnaObject((is_null($map))?$this->instanciaMapa:$map);
        $elemento = $elementos[0]; //siempre sera el id
        $id = null;
        $datos = Array();
        
        while ($fila = $request->fetch_object()) {       
            
            $id = $fila->$elemento;
            $fila->$elemento = $this->createBtnSelect($id);    
            $fila->deleted_at = $this->createBtnDelete($id);

            if(!is_null($btn)){
                //por medio del casos, vamos a llenar el objeto
                switch ($btn) {
                    case 'show&unabled':
                        $fila->$elemento = $this->seeBtnView($id);    
                        $fila->deleted_at = $this->changeBtnStatus($id);
                    break;
                    case 'show&select&unabled':
                        $fila->$elemento = $this->seeBtnView($id);    
                        $fila->$elemento = $this->createBtnSelect($id);    
                        $fila->deleted_at = $this->changeBtnStatus($id);
                    break;
                    case 'show':
                        $fila->$elemento = $this->seeBtnView($id);    
                    break;
                    case 'deleted':
                        $fila->deleted_at = $this->createBtnDelete($id);
                    break;
                    default:
                        $fila->$elemento = $this->createBtnSelect($id);    
                        $fila->deleted_at = $this->createBtnDelete($id);
                    break;
                }
            }


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

    public function getDivBuscador(object $request,object $map = null)
    {
        $datos = Array();
        while ($fila = $request->fetch_object()) {       
            
            $datos [] = array_values((array)$fila);
        }

        return json_encode($datos);
    
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
    protected function seeBtnView($valor)
    {
        $btn = "
            <button onclick='mostrarDatos(true,/getDataDetalle/,".$valor.")' class='btn btn-primary showData' type='button'>
                <i class='bi bi-list-check'></i>
            </button>
        ";

        return $btn;
    }
    protected function changeBtnStatus($valor)
    {
        $btn = "
            <button onclick='cambiarEstado(true,/trashData/,".$valor.")' class='btn btn-danger disaData' type='button'>
                <i class='bi bi-hand-thumbs-down'></i>
            </button>
        ";

        return $btn;
    }

}



?>