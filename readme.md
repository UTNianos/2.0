# Utnianos 2.0



#### Seteando un ambiente de desarrollo

**Tecnologias utilizadas para desarrollar:**
 
- PHP(> 5.5.9)
    - [Composer](https://getcomposer.org/doc/00-intro.md)
    - [PHPUnit](https://phpunit.de/) (via composer) 
    - (Opcional) [PHPMD](http://phpmd.org/download/index.html) analisis estatico del codigo
    
- NodeJS (para el frontend)
    - [Bower](http://bower.io/#install-bower)
    
    
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

#ahora hay que correr las migraciones para crear la estructura de la base de datos
php artisan migrate

#Frontend
npm install
#instalamos las dependencias
bower install

#generamos el css y el javascript
gulp


#con esto deberia estar todo seteado. testeamos y ponemos a correr el servidor
phpunit
php artisan key:generate
php artisan serve

```
una vez hecho esto el sitio deberia ser visible en http://localhost:8000
