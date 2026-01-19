Agenda Contactos Toni:
    Proyecto CRUD con Acceso a BDD, trabaja mediante una API REST para gestionar las operaciones.

Funcionalidades:
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


Requisitos previos:
    PHP >= 8.0
    MySQL
    Servidor Caddy
    Git >= 2.52.017

