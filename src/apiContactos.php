<?php
    header("Content-Type: application/json; charset=utf-8");

    require_once "conexion.php";
    require_once "modelos/Contacto.php";
    require_once "utils.php";

    $metodo = $_SERVER["REQUEST_METHOD"];
    $id = $_GET['id'] ?? null;


    switch($metodo) {
        /**
         * @method GET
         * Obtiene un contacto específico por ID o lista todos los contactos.
         * @return void Envía una respuesta JSON con el contacto especifico buscado por ID o la lista completa.
        */
        case 'GET':
            {
                if ($id) {
                    $contacto = Contacto::obtenerContacto($pdo, $id);
                    if (!$contacto) {
                        formatearRespuesta(["error" => "Contacto no encontrado"], 404);
                    } else {
                        formatearRespuesta($contacto, 200);
                    }
                } else {
                    formatearRespuesta(Contacto::listar($pdo), 200);
                }
                break;
            }


        /**
         * @method POST
         * Crea un nuevo recurso Contacto en la base de datos.
         * @param array $contactoPeticion Datos recibidos (name, email, phone).
         * @return void Envía código 201 en caso de que se haya insertado correctamente a la BDD o 400 por datos incompletos.
        */
        case 'POST':
            {
                $contactoPeticion = obtenerDatosPeticion();
                if (empty($contactoPeticion["name"]) || empty($contactoPeticion["phone"]) || empty($contactoPeticion["email"])) {
                    formatearRespuesta(["error" => "No se han informado los datos del contacto correctamente"], 400);
                } else {
                    $contacto = new Contacto($contactoPeticion["name"], $contactoPeticion["email"], $contactoPeticion["phone"]);
                    $contacto->insertar($pdo);
                    formatearRespuesta(["mensaje" => "Contacto creado", "id" => $contacto->id], 201);
                }
                break;
            }


        /**
         * @method PUT
         * Actualiza un contacto existente identificado por ID.
         * @requires int $id Identificador del contacto.
         * @return void Envía código 200 (Dependiendo de si se ha modificado o no devolvera un mensaje diferente)si se encuentra el contacto o 404 si no existe.
        */
        case 'PUT':
            {
                if (!$id){
                    formatearRespuesta(["error" => "No se ha informado el ID del Contacto"], 400);
                } 
                else {
                    $contactoInformado = obtenerDatosPeticion();
                    if (empty($contactoInformado["name"]) || empty($contactoInformado["phone"]) || empty($contactoInformado["email"])) {
                        formatearRespuesta(["error" => "No se han informado los datos del contacto correctamente"], 400);
                    } else {
                        $contacto = Contacto::obtenerContacto($pdo, $id);
                        if (!$contacto) {
                            formatearRespuesta(["error" => "El contacto no se encuentra Registrado"], 404);
                        } else {
                            // Asignación de nuevos valores al objeto
                            $contacto->name = $contactoInformado["name"];
                            $contacto->email = $contactoInformado["email"];
                            $contacto->phone = $contactoInformado["phone"];

                            if ($contacto->modificar($pdo)) {
                                formatearRespuesta(["mensaje" => "Contacto modificado"], 200);
                            } else {
                                formatearRespuesta(["mensaje" => "No se ha modificado el contacto"], 200);
                            }
                        }
                    }
                }
                break;
            }


        /**
         * @method DELETE
         * Elimina un contacto de la base de datos por su ID.
         * @return void Envía código 200 (Dependiendo de si se ha eliminado o no devolvera un mensaje diferente)si se encuentra el contacto o 404 si no existe.
        */
        case 'DELETE':
            {
                if (!$id){
                    formatearRespuesta(["error" => "Falta el parámetro ID"], 400);
                }
                else {
                    $contacto = Contacto::obtenerContacto($pdo, $id);
                    if (!$contacto) {
                        formatearRespuesta(["error" => "Contacto no existe"], 404);
                    } else {
                        if ($contacto->eliminar($pdo, $id)) {
                            formatearRespuesta(["mensaje" => "Contacto eliminado"], 200);
                        } else {
                            formatearRespuesta(["mensaje" => "No se ha eliminado el contacto"], 200);
                        }
                    }
                }
                break;
            }
            

        /**
         * Caso por defecto en caso de que el metodo de entrada no este implementado
        */
        default:
            formatearRespuesta(["error" => "Método no permitido"], 405);
            break;
    }
?>