<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DESCRIPPCION</th>
                    <th scope="col">PESO</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">TAMAÑO</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>

                </tr>
            </thead>
            <tbody>

                <?php
                //Nombre, descripcion, peso, precio, tamano
                //Recorremos todos los regitros de la base de datos
                for ($i = 0; $i < count($datosProducto); $i++) {
                    //Para cada registro de la Base de Datos hay que crear una dila de la tabla
                    print("<tr>\n");
                    //Recorremos todos los datos de esta fila
                    for ($j = 0; $j < count($datosProducto[$i]) / 2; $j++) {
                        print("<td>" . $datosProducto[$i][$j] . "</td>");
                    }

                    //Botón para modificar el producto
                    print("<form action= ModificarDatosController.php method=POST>\n");
                    print("<input type='hidden' name='idProducto' value='" . $datosProducto[$i]['idProductos'] . "'>");
                    print("<td><button type=submit>Modificar</button></td>");
                    print("</form>");

                    //Botón para eliminar el producto
                    print("<form action= EliminarDatosController.php method=POST>\n");
                    print("<input type='hidden' name='idProducto' value='" . $datosProducto[$i]['idProductos'] . "'>");
                    print("<td><button type=submit>Eliminar</button></td>");
                    print("</form>");

                    print("</tr>\n");
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>