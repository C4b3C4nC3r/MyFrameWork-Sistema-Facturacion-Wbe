<?php
require_once "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require "https/model/conexion/conexion.php";

$conexion = new Conexion();

$conexion->conexionMySqli();

$query = $conexion->conexionMySqli()->query("SELECT * FROM `product`");

while($row = $query->fetch_all()){
    echo var_dump($row);
}



?>

