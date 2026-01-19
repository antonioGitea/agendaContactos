# Agenda Contactos Toni:
    Proyecto CRUD con Acceso a BDD, trabaja mediante una API REST para gestionar las operaciones.

## Funcionalidades:
    Al trabajar mediante un despliegue de forma local usaremos localhost para realizar las peticiones, aunque no es la forma correcta.

    LISTAR (GENERAL):
        curl -X GET http://localhost/contactos.php

        RESPUESTA:
            [
                {
                    "id": 1,
                    "name": "Ana García",
                    "email": "ana@example.com",
                    "phone": "600123456"
                },
                {
                    "id": 2,
                    "name": "Carlos López",
                    "email": "carlos@example.com",
                    "phone": "600987654"
                }
            ]

    LISTAR (CONTACTO ÚNICO):
        curl -X GET http://localhost/contactos.php?id=5

        RESPUESTA:
            {
                "id": 5,
                "name": "Lucía Fernández",
                "email": "lucia@example.com",
                "phone": "654321098"
            }   


## Requisitos previos:
    PHP >= 8.0
    MySQL
    Servidor Caddy
    Git >= 2.52.017

## Instalacion:
    ### 1 - Configurar Caddyfile:
        :80 {
            root * /var/www/html
            php_fastcgi php:9000
            file_server
        }

    ### 2 - Configurar Docker Compose:
        services:
            caddy:
                image: caddy:2-alpine
                ports:
                - "80:80"
                volumes:
                - ./Caddyfile:/etc/caddy/Caddyfile
                - ./src:/var/www/html
                depends_on:
                - php

            php:
                build: ./php
                volumes:
                - ./src:/var/www/html

            db:
                image: mysql:8.0
                environment:
                MYSQL_ROOT_PASSWORD: root
                MYSQL_DATABASE: agenda
                MYSQL_USER: root
                MYSQL_PASSWORD: root
                volumes:
                - db_data:/var/lib/mysql

            volumes:
            db_data:

    ### 3 - Construir Docker File:
        docker compose up -d --build


## Estructura del Proyecto:
    /agendaContactos
        | -- php/
                | -- Dockerfile
        | -- src/
                | -- .phpdoc/
                        |-- build/
                        |-- cache/
                | -- modelos/
                        |-- Contacto.php
                | -- vistas/
                        |-- formCrear.html
                        |-- formEliminar.html
                        |-- formModificar.html
                | -- apiContatos.php
                | -- conexion.php
                | -- crearContacto.php
                | -- eliminarContacto.php
                | -- index.php
                | -- indexBueno.php
                | -- modificarContacto.php
        | -- Caddyfile
        | -- docker-compose.yml
        | -- README.md

## Acceso y Credenciales:
    DB_HOST ="proyecto_agenda_tonisanchez-db-1";
    DB_NAME ="agenda";
    DB_USER ="root";
    DB_PASS ="root";

## Contribucion: