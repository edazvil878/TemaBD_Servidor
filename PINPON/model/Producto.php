<?php

namespace PINPON\model;

use PDOException;


/**
 * El modelo va a realizar las operaciones básicas de cualquier app CRUD
 * CRUD (Create Read Update Delete)
 */
class Producto
{

    //POR HACER
    public static function getProductodPag($pdo, $num_pag, $num_prod, $orden, $filtro)
    {

        /**
         * Ejemplo de query compleja
         * 
         * select * from productos where [filtros] order by [orden] limit [num_prod] start [num_pag*num_prod]
         * 
         * select * from productos where precio between 30 and 80 order by precio desc limit 10 start [(4-1)*10+1]
         * 
         */


    }


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

    /**
     * La funcion borra el producto con el id_producto que recibimos
     */
    public static function delProducto($pdo, $id_producto)
    {
        try {
            //Borramos todos los productos con nombre Pala bullpadel 2
            $query = "DELETE from productos where idProductos=:id";

            //Prepararmos la ejecucion de la sentencia (statement stmt)
            $stmt = $pdo->prepare($query);

            //Asociamos el valor del parametro idproducto a la posicion de :id
            $stmt->bindValue(':id', $id_producto);

            $stmt->execute();

            $filas_afectadas = $stmt->rowCount();

            return $filas_afectadas;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        } finally {
            $pdo = null;
        }
    }

    public static function updateProducto($pdo, $producto)
    {

        try {
            //Query para modificar 
            $query = "UPDATE productos set ";

            //Si no nos meten nada para modificar devolvemos error
            if (count($producto) == 0)
                return -1;

            if (isset($producto['nombre']))
                $query = $query . " nombre=:nombre";

            if (isset($producto['descripcion'])) {
                //Si la cadena de la query tiene mas caracteres de la inicial, implica que antes hay un campo 
                //Modificado y tengo que poner la ,
                if (strlen($query) > 20)
                    $query = $query . ',';

                $query = $query . " descripcion=:descripcion";
            }

            if (isset($producto['peso'])) {
                //Si la cadena de la query tiene mas caracteres de la inicial, implica que antes hay un campo 
                //Modificado y tengo que poner la ,
                if (strlen($query) > 20)
                    $query = $query . ',';

                $query = $query . " peso=:peso";
            }

            if (isset($producto['precio'])) {
                //Si la cadena de la query tiene mas caracteres de la inicial, implica que antes hay un campo 
                //Modificado y tengo que poner la ,
                if (strlen($query) > 20)
                    $query = $query . ',';

                $query = $query . " precio=:precio";
            }

            if (isset($producto['tamano'])) {
                //Si la cadena de la query tiene mas caracteres de la inicial, implica que antes hay un campo 
                //Modificado y tengo que poner la ,
                if (strlen($query) > 20)
                    $query = $query . ',';

                $query = $query . " tamano=:tamano";
            }

            if (isset($producto['idProductos'])) {

                $query = $query . " where idProductos=:id";
            }

            //nombre, descripcion, peso, precio, tamano where idProductos
            //Depuracion cutre mostramos la query
            echo $query . "<br/>";

            $stmt = $pdo->prepare($query);

            //Asociamos a los campos de la query los valores

            if (isset($producto['nombre']))
                $stmt->bindValue(':nombre', $producto['nombre']);

            if (isset($producto['descripcion']))
                $stmt->bindValue(':descripcion', $producto['descripcion']);

            if (isset($producto['peso']))
                $stmt->bindValue(':peso', $producto['peso']);

            if (isset($producto['precio']))
                $stmt->bindValue(':precio', $producto['precio']);

            if (isset($producto['tamano']))
                $stmt->bindValue(':tamano', $producto['tamano']);

            if (isset($producto['idProductos']))
                $stmt->bindValue(':id', $producto['idProductos']);



            //Ejecutamos la query
            $stmt->execute();

            //Sacamos la cantidad de filas afectadas
            $filas_afectadas = $stmt->rowCount();

            return $filas_afectadas;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            return -1;
        } finally {
            $pdo = null;
        }
    }

    public static function insertProducto($pdo, $producto)
    {

        try {
            //HACEMOS UN EJEMPLO DE INSERT
            //En lugar de un valor que nos llega inseguro ponemos siempre ?
            //asi evitamos la inyeccion sql
            $query = "INSERT INTO productos  (nombre,descripcion,peso,precio,tamano)  VALUES (:nombre,:descripcion,:precio,:peso,:tamano)";

            //De esta forma hay que preparar primero la sentencia
            $stmt = $pdo->prepare($query);

            //Asignamos el valor en el lugar de la :variable

            $stmt->bindValue(':nombre', $producto['nombre']);
            $stmt->bindValue(':descripcion', $producto['descripcion']);
            $stmt->bindValue(':precio', $producto['precio']);
            $stmt->bindValue(':peso', $producto['peso']);
            $stmt->bindValue(':tamano', $producto['tamano']);

            //Ejecutamos la query
            $stmt->execute();
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            return -1;
        } finally {
            $pdo = null;
        }
    }
}
