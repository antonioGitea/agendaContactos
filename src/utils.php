<?php
    /**
         * Validación un campo numérico
         * 
         * Valida que el campo de entrada esté declarado, no sea una cadena vacía y que sea numérico
         * 
         * @return bool En caso de que cumpla todas las validaciones devolverá true, de lo contrario false
    */
    function validarNumero($entrada) {
        $salida = true;
        if(!is_numeric($entrada) || !isset($entrada) || trim($entrada) === ""){
            $salida = false;
        }
        return $salida;
    }


    /**
         * Validación un campo de texto
         * 
         * Valida que el campo de entrada esté declarado, no sea una cadena vacía y que no sea numérico
         * 
         * @return bool En caso de que cumpla todas las validaciones devolverá true, de lo contrario false
    */
    function validarCadena($entrada) {
        $salida = true;
        if(is_numeric($entrada) || !isset($entrada) || trim($entrada) === ""){
            $salida = false;
        }
        return $salida;
    }

    /**
         * Validación un campo de email
         * 
         * Valida que el campo de entrada esté declarado como, no sea una cadena vacía y que sea un formato válido de email
         * 
         * @return bool En caso de que cumpla todas las validaciones devolverá true, de lo contrario false
    */
    function validarEmail($email) {
        $salida = true;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !is_string($email) || trim($email) === "") {
            $salida = false;
        }
        return $salida;
    }

    /**
         * Limpieza de carácteres de html y espacios del parámetro de entrada
         * 
         * Limpia la cadena pasada por parámetro con los metodos "htmlspecialchars" para carácteres html y "trim" para espacios en blanco
         * 
         * @return string El parámetro pasado por entrada limpio
    */
    function limpiarEntrada($entrada){
        return htmlspecialchars(trim($entrada));
    }


    
    function formatearRespuesta($datos, int $codigo) {
        http_response_code($codigo);
        //no escapar unicode
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    }

    function obtenerDatosPeticion() {
        //lee la petición completa HTTP, el body enviado por el cliente en json
        $cuerpo = file_get_contents("php://input");
        //convierte json a array 
        return json_decode($cuerpo, true) ?? [];
    }

?>