<?php
namespace controller;

use PINPON\model\Producto as ModelProducto;
use PINPON\model\Utils as ModelUtils;

include('..\model\Producto.php');
include('..\model\Utils.php');

session_start();

$_SESSION['user'] = "pedro";

if (isset($_SESSION['user'])) {
    //Si el usuario esta logado eliminamos el producto
    //Si no está conectado a la BD nos conectamos
    if (!isset($pdo)) {
        $pdo = ModelUtils::conectar();
    }

    //Cargamos el id del producto a eliminar
    $idProd = $_POST['idProducto'];

    //Eliminamos el producto
    //Habria que comprobar que se ha borrado y que idProd es numerico no nulo
    ModelProducto::delProducto($pdo, $idProd);

    //Cargamos los datos de los productos
    $datosProducto = ModelProducto::getProductos($pdo);
    include('..\view\MostrarProductos.php');

}


?>