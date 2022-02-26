<?php

//MAPA DE HOMEMAP PARA EL USO DEL DATATBLES DINAMICO

class HomeMap {

    protected $home_id;
    protected $home_name;
    protected $home_col;
    /**
    *OTROS ELEMENTOS DEL MAPA
    **/
    protected $deleted_at;
    //GETS
    public function getHome_id(){
        return $this->home_id;
    }
    public function getHome_name(){
        return $this->home_name;
    }
    public function getHome_col(){
        return $this->home_col;
    }
    public function getDeleted_at(){
        return $this->deleted_at;
    }
    //SETS
    public function setHome_id($setValue){
        $this->home_id = $setValue;
    }
    public function setHome_name(string $setValue){
        $this->home_name = $setValue;
    }
    public function setHome_col(string $setValue){
        $this->home_col = $setValue;
    }
    public function setDeleted_at($setValue){
        $this->deleted_at = $setValue;
    }
    

}


?>