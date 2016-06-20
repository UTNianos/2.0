# Utnianos 2.0

[![Build Status](https://travis-ci.org/UTNianos/2.0.svg?branch=master)](https://travis-ci.org/UTNianos/2.0)


#### Seteando un ambiente de desarrollo

**Tecnologias utilizadas para desarrollar:**
 
- PHP(> 5.5.9)
    - [Composer](https://getcomposer.org/doc/00-intro.md)
    - [PHPUnit](https://phpunit.de/) (via composer) 
    - (Opcional) [PHPMD](http://phpmd.org/download/index.html) analisis estatico del codigo

    
#### Inicializacion


```sh
# Primero, pulleamos el repositorio
git clone git@github.com:UTNianos/2.0.git
cd 2.0

#instalamos las dependencias del backend con composer
composer install

# copiamos la configuracion de ejemplo 
#y editamos los parametros de nuestra maquina
cp .env.example .env
#editar .env y reemplazar los datos de la conexion a la base de datos
#clave para la encripcion
php artisan key:generate
#ahora hay que correr las migraciones para crear la estructura de la base de datos
php artisan migrate

phpunit

php artisan serve --host=127.0.0.1

```
una vez hecho esto el sitio deberia ser visible en http://localhost:3000
por un lado esta el servidor de php y por el otro el webpack dev server, que usamos para generar el js y demas assets del frontend
