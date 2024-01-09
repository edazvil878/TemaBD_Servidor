<?php 
namespace PINPON\model;
use PDOException;

class Producto {


/**
 * Devuelve un array asociativo con todos los datos
 * de la tabla productos
 */
public static function getProductos($pdo)
{

    try {
        //Realizamos una query
    $query = "SELECT * FROM productos";

    $resultado = $pdo->query($query);

    //FetchAll nos saca todos los registros de la query
    //El fetchall no se puede utilizar mas de una vez
    $resulSet = $resultado->fetchAll();

        
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    } 
    //Devolvemos los datos de la query
    return $resulSet;
}

}


?>