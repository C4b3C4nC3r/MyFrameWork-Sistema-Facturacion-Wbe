<?php
require_once "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require "https/model/conexion/conexion.php";
require "https/model/model.php";


$conexion = new Conexion();

$conexion->conexionMySqli();

/*
$query = $conexion->conexionMySqli()->query("SELECT * FROM `product`");

while($row = $query->fetch_all()){
    echo var_dump($row);
}

 * 
 * 
 */

$detalle_factura_datos = [];

$detalle_factura = 
[
    "kf_factura_id"=>"10",
    "kf_producto_id"=>null,
    "detalle_factura_cantidad"=>null,
    "detalle_factura_valor_unitario"=>null,
    "detalle_factura_total"=>null
];

$sql = "select sistemafacturacion.temporal.temporal_cantidad * sistemafacturacion.product.product_price as temporal_valor_total, product.product_price as temporal_valor_unitario,temporal.temporal_tabla_id,temporal.temporal_cantidad
from sistemafacturacion.product, sistemafacturacion.temporal
where sistemafacturacion.product.product_id = sistemafacturacion.temporal.temporal_tabla_id
and sistemafacturacion.temporal.deleted_at is null";

$query = $conexion->conexionMySqli()->query($sql);

while($row = mysqli_fetch_array($query)){
    $detalle_factura["kf_producto_id"] = $row["temporal_tabla_id"];
    $detalle_factura["detalle_factura_cantidad"] = $row["temporal_cantidad"];
    $detalle_factura["detalle_factura_valor_unitario"] = $row["temporal_valor_unitario"];
    $detalle_factura["detalle_factura_total"] = $row["temporal_valor_total"];

    array_push($detalle_factura_datos,$detalle_factura);
}

//creador de insert
$model = new Models();
//echo var_dump($detalle_factura_datos);


foreach ($detalle_factura_datos as $key => $detalle) {
  
    //echo var_dump($detalle)."<br>";
    $model->sqlInsertar(["nombre_tabla"=>"detalle_factura","columnas_valores"=>$detalle]);

    echo mysqli_errno($conexion->conexionMySqli());


}

?>

