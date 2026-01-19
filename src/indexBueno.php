<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            require_once 'conexion.php';
            require_once 'modelos/Contacto.php';

            //Recogemos la lista asociativa que devuelve la función estática listar de la clase Contacto
            $listaContactos = Contacto::listar($pdo);

            if($listaContactos){
                //Mostramos por pantalla mediante un foreach
                foreach($listaContactos as $contacto) {
                    echo "ID: " . $contacto['id'] . "<br>";
                    echo "NAME: " . $contacto['name'] . "<br>";
                    echo "EMAIL: " . $contacto['email'] . "<br>";  
                    echo "PHONE: " . $contacto['phone'] . "<br>";
                    echo "------------------------<br>";    
                }
            }else{
                echo "No hay contactos creados";
            }
        ?>

        <a href="/vistas/formCrear.html">Volver al formulario para Agregar</a><br>
        <a href="/vistas/formModificar.html">Volver al formulario para Modificar</a><br>
        <a href="/vistas/formEliminar.html">Volver al formulario para Eliminar</a><br>
    </body>
    </html>