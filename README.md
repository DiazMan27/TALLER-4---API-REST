# API REST para Portafolio Personal
Este proyecto implementa una API RESTful para gestionar proyectos de portafolio localmente, diseñada para probar los principales métodos HTTP: GET, POST, PUT, PATCH, DELETE, HEAD y OPTIONS.

## Requisitos Técnicos
XAMPP (versión 8.1+ recomendada)

Postman (para pruebas de API)

PHP (8.0+ incluido en XAMPP)

MySQL (incluido en XAMPP)

### Configuración Inicial
Clonar el repositorio:

bash
git clone [(https://github.com/DiazMan27/TALLER-4---API-REST.git]
cd portafolio-api

dejar carpeta en /xammp/htdocs.
## Importar la base de datos:

Iniciar XAMPP y activar los servicios Apache y MySQL
Acceder a phpMyAdmin (http://localhost/phpmyadmin)
Crear una nueva base de datos llamada "portafolio2"
Importar el archivo SQL incluido en el proyecto

Configurar Postman:

Endpoints Disponibles
1. Obtener Proyectos (GET)
URL: http://localhost/portafolio/api/proyectos.php

2. Crear Proyecto (POST)
URL: http://localhost/portafolio/api/proyectos.php

Body (JSON):
json
{
    "titulo": "Nuevo Proyecto",
    "descripcion": "Descripción detallada",
    "imagen": "proyecto.jpg",
    "enlace": "https://github.com/mi-usuario/proyecto"
}

3. Actualizar Proyecto (PUT)
URL: http://localhost/portafolio/api/proyectos.php?id=[ID]

Body (JSON):
json
{
    "titulo": "Título actualizado",
    "descripcion": "Nueva descripción",
    "imagen": "nueva-imagen.jpg",
    "enlace": "https://nuevo-enlace.com"
}

4. Actualización Parcial (PATCH)
URL: http://localhost/portafolio/api/proyectos.php?id=[ID]

Ejemplo:
json
{
    "descripcion": "Solo actualizo este campo"
}

5. Eliminar Proyecto (DELETE)
URL: http://localhost/portafolio/api/proyectos.php?id=[ID]

Respuesta exitosa:
json
{
    "status": "success",
    "message": "Proyecto eliminado"
}

6. HEAD
   HEAD http://localhost/portafolio/api/proyectos.php?id=1
mensaje “200 OK” que nos señala que el proyecto con id=1 existe

8. OPTIONS
   OPTIONS http://localhost/portafolio/api/proyectos.php
Nos indicara los metodos permitidos
