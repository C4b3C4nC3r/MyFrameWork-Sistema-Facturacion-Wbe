<?php

//MAPA DE TEMPORALMAP PARA EL USO DEL DATATBLES DINAMICO

class TemporalMap {

    public $temporal_id;
    public $temporal_name;
    public $temporal_tabla_cantidad;
    public $temporal_tabla_id;
    public $temporal_tabla_name;
    public $kf_usuario_id;
    /**
    *OTROS ELEMENTOS DEL MAPA
    **/
    public $deleted_at;
    //GETS
    public function getTemporal_id(){
        return $this->temporal_id;
    }
    public function getTemporal_name(){
        return $this->temporal_name;
    }
    public function getTemporal_col(){
        return $this->temporal_col;
    }
    public function getDeleted_at(){
        return $this->deleted_at;
    }
    //SETS
    public function setTemporal_id($setValue){
        $this->temporal_id = $setValue;
    }
    public function setTemporal_name(string $setValue){
        $this->temporal_name = $setValue;
    }
    public function setTemporal_col(string $setValue){
        $this->temporal_col = $setValue;
    }
    public function setDeleted_at($setValue){
        $this->deleted_at = $setValue;
    }
    

}


?>