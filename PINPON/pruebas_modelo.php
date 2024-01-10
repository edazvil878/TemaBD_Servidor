<?php
//cargo la clase utils

use PINPON\model\Producto;
use PINPON\model\Utils;

require_once("model\Utils.php");
require_once("model\Producto.php");

//Creamos una conexion con BD
$pdo = Utils::conectar();

$producto = Producto::getProductos($pdo);

var_dump($producto);

//nombre, descripcion, peso, precio, tamano where idProductos
$prod_mod = ['nombre' => 'Raqueta Rosa', 'idProductos' => 1];

//Producto::updateProducto($pdo,$prod_mod);

//Producto::delProducto($pdo,8);

$prod_nuevo = ['nombre' => 'Raqueta DanielB', 'descripcion' => 'La raqueta de Dani', 'peso' => 8, 'precio' => 23, 'tamano' => 23];

Producto::insertProducto($pdo, $prod_nuevo);
?>