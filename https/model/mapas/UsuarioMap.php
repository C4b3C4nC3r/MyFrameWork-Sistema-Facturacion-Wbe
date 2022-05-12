<?php

//MAPA DE USUARIOMAP PARA EL USO DEL DATATBLES DINAMICO

class UsuarioMap {

    public $usuario_id;
    public $usuario_name;
    public $usuario_col;
    /**
    *OTROS ELEMENTOS DEL MAPA
    **/
    public $deleted_at;
    //GETS
    public function getUsuario_id(){
        return $this->usuario_id;
    }
    public function getUsuario_name(){
        return $this->usuario_name;
    }
    public function getUsuario_col(){
        return $this->usuario_col;
    }
    public function getDeleted_at(){
        return $this->deleted_at;
    }
    //SETS
    public function setUsuario_id($setValue){
        $this->usuario_id = $setValue;
    }
    public function setUsuario_name(string $setValue){
        $this->usuario_name = $setValue;
    }
    public function setUsuario_col(string $setValue){
        $this->usuario_col = $setValue;
    }
    public function setDeleted_at($setValue){
        $this->deleted_at = $setValue;
    }
    

}


?>