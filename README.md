#API REST para Portafolio Personal
Este proyecto implementa una API RESTful para gestionar proyectos de portafolio localmente, diseñada para probar los principales métodos HTTP: GET, POST, PUT, PATCH, DELETE, HEAD y OPTIONS.

##Requisitos Técnicos
XAMPP (versión 8.1+ recomendada)

Postman (para pruebas de API)

PHP (8.0+ incluido en XAMPP)

MySQL (incluido en XAMPP)

###Configuración Inicial
Clonar el repositorio:

bash
git clone [URL_DEL_REPOSITORIO]
cd portafolio-api
Importar la base de datos:

Iniciar XAMPP y activar los servicios Apache y MySQL

Acceder a phpMyAdmin (http://localhost/phpmyadmin)

Crear una nueva base de datos llamada portafolio

Importar el archivo SQL incluido en el proyecto

Configurar Postman:

Importar la colección de ejemplos (si está disponible)

O configurar manualmente siguiendo los ejemplos abajo

Endpoints Disponibles
1. Obtener Proyectos (GET)
URL: http://localhost/portafolio/api/proyectos.php

Parámetro	Tipo	Descripción
id	int	(Opcional) ID de proyecto específico
Ejemplo de respuesta:

json
[
    {
        "id": 1,
        "titulo": "Sitio Web Personal",
        "descripcion": "Portafolio profesional",
        "imagen": "web.jpg",
        "enlace": "https://ejemplo.com",
        "fecha_creacion": "2023-10-15"
    }
]
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
Campos obligatorios: titulo, descripcion

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
Nota: PUT requiere todos los campos del proyecto.

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
