<?php
namespace controller;

use PINPON\model\Producto as ModelProducto;
use PINPON\model\Utils as ModelUtils;

include('..\model\Producto.php');
include('..\model\Utils.php');

session_start();

//Si la sesión está iniciada y hay usuario lo mandamos a la web principal, sino lo redireccionamos al LogIn

//Forzamos que vvaya al listado fingiendo que estamos logados
$_SESSION['user'] = "pedro";

if (isset($_SESSION['user'])) {
    //Nos conectamos a BD
    $pdo = ModelUtils::conectar();

    //Cargamos los datos de los productos
    $datosProducto = ModelProducto::getProductos($pdo);
    include('..\view\MostrarProductos.php');
} else {
    // include('view/Login.php');
}

?>