# TALLER 4 - API REST

Este es un portafolio personal adaptado para ser usado para probar metodos como: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS.
Es un proyeto echo localmente usando XAMPP y POSTMAN
A continuación estan las indicaciones para ejecutarlo en su equipo

1) hacer un gitclone del proyecto
2) installar xampp y postman
3) importar base de datos en phpmyadmin ( base de datos en los archivos )
4) iniciar xampp con APACHE y MYSQL (Click en admin para ver la BDD)
5) iniciar postman y comenzar a probar los metodos

## GET
GET http://localhost/portafolio/api/proyectos.php?id=1
configurar id segun los proyectos en la BDD
## POST
POST http://localhost/portafolio/api/proyectos.php
Body (raw JSON):
{
    "titulo": "Nuevo Proyecto",
    "descripcion": "Descripción del nuevo proyecto",
    "imagen": "img/proyecto7.png",
    "enlace": "https://github.com/usuario/proyecto7"
}
## PUT
PUT http://localhost/portafolio/api/proyectos.php?id=1
Body (raw JSON):
{
    "titulo": "Proyecto 1 Actualizado",
    "descripcion": "Nueva descripción",
    "imagen": "img/proyecto1-actualizado.png",
    "enlace": "https://github.com/usuario/proyecto1-actualizado"
}
## PATCH
   PATCH http://localhost/portafolio/api/proyectos.php?id=2
Body (raw JSON):
{
    "descripcion": "Solo actualizo la descripción"
}
## DELETE
   DELETE http://localhost/portafolio/api/proyectos.php?id=3
## HEAD
   HEAD http://localhost/portafolio/api/proyectos.php?id=1
## OPTIONS
   OPTIONS http://localhost/portafolio/api/proyectos.php
   

