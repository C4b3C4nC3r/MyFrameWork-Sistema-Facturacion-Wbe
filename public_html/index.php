
<?php


/**
 * REQUERIMIENTOS DEL SISTEMA WEB
 * UBICACION : SISTEMAWEB/PUBLIC_HTML/INDEX.PHP
 * CONVENCION : NO DEBE ESTAR LLENO DE CODIGO :) 
 */
require_once "../vendor/autoload.php";

include "../config/Aplicacion.php";
require_once "../resources/views/view.php";

require_once "../https/control/controller.php";
require_once "../https/model/conexion/conexion.php";
require_once "../https/model/model.php";

use \AppInicialization\AppInicialization;


$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$app = new AppInicialization;


?>
