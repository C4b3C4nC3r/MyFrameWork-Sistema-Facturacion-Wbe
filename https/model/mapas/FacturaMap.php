<?php

//MAPA DE FACTURAMAP PARA EL USO DEL DATATBLES DINAMICO

class FacturaMap {

    public $factura_id;
    public $kf_cliente_id;
    public $factura_fecha;
    public $factura_subtotal;
    public $factura_iva;
    public $factura_descuento;
    public $factura_efectivo;
    public $factura_cambio;
    public $factura_total;

    /**
    *OTROS ELEMENTOS DEL MAPA
    **/
    public $deleted_at;
    //GETS
    public function getFactura_id(){
        return $this->factura_id;
    }
    public function getFactura_name(){
        return $this->factura_name;
    }
    public function getFactura_col(){
        return $this->factura_col;
    }
    public function getDeleted_at(){
        return $this->deleted_at;
    }
    //SETS
    public function setFactura_id($setValue){
        $this->factura_id = $setValue;
    }
    public function setFactura_name(string $setValue){
        $this->factura_name = $setValue;
    }
    public function setFactura_col(string $setValue){
        $this->factura_col = $setValue;
    }
    public function setDeleted_at($setValue){
        $this->deleted_at = $setValue;
    }
    

}


?>