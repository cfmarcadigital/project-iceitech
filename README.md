<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Version Project

- Version: 1.0.1
- PHP: 8.2.0
- Laravel: 9.48.0

## Project Laravel ICEITech

El proyecto fue elaborado para el nuevo sitio web de ICEITech.

Se implementó el backend con API's para el consumo desde el frontend.

Se implementó el panel administrativo para el control de usuarios, cursos, docentes, etc.

- [Site Developer](http://icei.tech/backendtest).
- [Site Production](http://icei.tech/backend).

## Deploy Project

Comprimir todo el proyecto a excepcion de la carpeta "public" y "vendor" en un archivo zip y subirlo y descomprimirlo em el subdominio correspondiente.

En la carpeta publica del alojamiento subir la carpeta "public" del proyecto.

Configurar el archivo .env

APP_ENV=production
APP_DEBUG=false

DB_DATABASE=<basedatos>
DB_USERNAME=<nombreusuario>
DB_PASSWORD=<contraseña>

Actualizar el archivo index.php

    require __DIR__.'/../../subdominio/vendor/autoload.php';
    $app = require_once __DIR__.'/../../subdominio/bootstrap/app.php';

En la terminal ingresar a la carpeta del subdominio y ejecutar los comandos:

- composer update
- php artisan key:generate
- php artisan storage:link
- php artisan migrate
- php artisan passport:install

## Factory and Seeder

Para sembrar datos con las fábricas, ejecutar el comando:

- php artisan db:seed DatabaseSeeder
