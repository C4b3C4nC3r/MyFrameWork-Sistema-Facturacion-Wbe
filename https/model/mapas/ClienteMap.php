<?php

//MAPA DE CLIENTEMAP PARA EL USO DEL DATATBLES DINAMICO

class ClienteMap {

    public $cliente_id;
    public $cliente_name;
    public $cliente_lastname;
    public $cliente_dni;
    public $cliente_email;
    public $cliente_telf;
    /**
    *OTROS ELEMENTOS DEL MAPA
    **/
    public $deleted_at;
    
    //GETS
    public function getCliente_id(){
        return $this->cliente_id;
    }
    public function getCliente_name(){
        return $this->cliente_name;
    }
    public function getCliente_lastname(){
        return $this->cliente_lastname;
    }
    public function getCliente_dni(){
        return $this->cliente_dni;
    }
    public function getCliente_email(){
        return $this->cliente_email;
    }
    public function getCliente_telf(){
        return $this->cliente_telf;
    }

    public function getDeleted_at(){
        return $this->deleted_at;
    }
    //SETS
    public function setCliente_id($setValue){
        $this->cliente_id = $setValue;
    }
    public function setCliente_name(string $setValue){
        $this->cliente_name = $setValue;
    }
    public function setCliente_lastname(string $setValue){
        $this->cliente_lastname = $setValue;
    }
    public function setCliente_dni($setValue){
        $this->cliente_dni = $setValue;
    }
    public function setCliente_email(string $setValue){
        $this->cliente_email = $setValue;
    }
    public function setCliente_telf(string $setValue){
        $this->cliente_telf = $setValue;
    }

    public function setDeleted_at($setValue){
        $this->deleted_at = $setValue;
    }
    

}


?>