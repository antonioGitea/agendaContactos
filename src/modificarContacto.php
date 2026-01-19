<?php
    require_once 'conexion.php';
    require_once 'utils.php';
    require_once 'modelos/Contacto.php';

    //Comprobamos que el acceso al script sea mediante el metodo POST
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{

            //Validamos y limpiamos la entrada si es válida
            if(validarNumero($_POST['id']) && validarCadena($_POST['name']) && validarEmail($_POST['email']) && validarNumero($_POST['phone'])){
                $nombre = limpiarEntrada($_POST['name']);
                $email = limpiarEntrada($_POST['email']);
                $tlf = limpiarEntrada($_POST['phone']);
                
                //Creamos un objeto del que recogeremos los nuevos atributos que queremos modificar al usuario ya almacenado que recogemos por ID
                $nuevoCon = new Contacto($nombre,$email,$tlf);
                $nuevoCon->modificar($pdo,$_POST['id']);
            }
            else{
                if(!validarNumero($_POST['id']))
                    echo "El ID introducido no es válido" . "<br>";
                if(!validarCadena($_POST['name']))
                    echo "El nombre introducido no es válido" . "<br>";
                if(!validarEmail($_POST['email']))
                    echo "El email introducido no es válido" . "<br>";
                if(!validarNumero($_POST['phone']))
                    echo "El número de teléfono no es válido" . "<br>";
            }


        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }finally{
            $pdo = null;
            $modificar = null;
        }
    }
?>