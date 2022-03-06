<?php

//MAPA DE DETALLEFACTURAMAP PARA EL USO DEL DATATBLES DINAMICO

class DetalleFacturaMap {

    public $detalle_factura_id;
    public $kf_factura_id;
    public $kf_producto_id;
    public $detalle_factura_cantidad;
    public $detalle_factura_valor_unitario;
    public $detalle_factura_total;
    
    /**
    *OTROS ELEMENTOS DEL MAPA
    **/
    public $deleted_at;
    //GETS
    public function getDetalleFactura_id(){
        return $this->detalle_factura_id;
    }
    public function getDetalleFactura_name(){
        return $this->detallefactura_name;
    }
    public function getDetalleFactura_col(){
        return $this->detallefactura_col;
    }
    public function getDeleted_at(){
        return $this->deleted_at;
    }
    //SETS
    public function setDetalleFactura_id($setValue){
        $this->detalle_factura_id = $setValue;
    }
    public function setDetalleFactura_name(string $setValue){
        $this->detallefactura_name = $setValue;
    }
    public function setDetalleFactura_col(string $setValue){
        $this->detallefactura_col = $setValue;
    }
    public function setDeleted_at($setValue){
        $this->deleted_at = $setValue;
    }
    

}


?>