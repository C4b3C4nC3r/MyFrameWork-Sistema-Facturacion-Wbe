<?php

//MAPA DE ERRORMAP PARA EL USO DEL DATATBLES DINAMICO

class ErrorMap {

    public $error_id;
    public $error_name;
    public $error_col;
    /**
    *OTROS ELEMENTOS DEL MAPA
    **/
    public $deleted_at;
    //GETS
    public function getError_id(){
        return $this->error_id;
    }
    public function getError_name(){
        return $this->error_name;
    }
    public function getError_col(){
        return $this->error_col;
    }
    public function getDeleted_at(){
        return $this->deleted_at;
    }
    //SETS
    public function setError_id($setValue){
        $this->error_id = $setValue;
    }
    public function setError_name(string $setValue){
        $this->error_name = $setValue;
    }
    public function setError_col(string $setValue){
        $this->error_col = $setValue;
    }
    public function setDeleted_at($setValue){
        $this->deleted_at = $setValue;
    }
    

}


?>