<?php

//MAPA DE PRODUCTOMAP PARA EL USO DEL DATATBLES DINAMICO

class ProductoMap {

    public $product_id;
    public $product_name;
    public $product_col;
    /**
    *OTROS ELEMENTOS DEL MAPA
    **/
    public $deleted_at;
    //GETS
    public function getProduct_id(){
        return $this->product_id;
    }
    public function getProduct_name(){
        return $this->product_name;
    }
    public function getProduct_col(){
        return $this->product_col;
    }
    public function getDeleted_at(){
        return $this->deleted_at;
    }
    //SETS
    public function setProduct_id($setValue){
        $this->product_id = $setValue;
    }
    public function setProduct_name(string $setValue){
        $this->product_name = $setValue;
    }
    public function setProduct_col(string $setValue){
        $this->product_col = $setValue;
    }
    public function setDeleted_at($setValue){
        $this->deleted_at = $setValue;
    }
    

}


?>