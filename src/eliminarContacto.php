<?php
    require_once 'conexion.php';
    require_once 'utils.php';
    require_once 'modelos/Contacto.php';
    
    //Comprobamos que el acceso al script sea mediante el metodo POST
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            //Validamos y limpiamos la entrada si es válida
            if(validarNumero($_POST['id'])){
                //Llamamos a la función estática de la clase contacto y eliminamos mendiante el ID de entrada
                Contacto::eliminar($pdo,$_POST['id']);
            }
            else{
                if(!validarNumero($_POST['id']))
                    echo "El ID introducido no es válido" . "<br>";
            }

        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }finally{
            $pdo = null;
            $modificar = null;
        }
    }
?>