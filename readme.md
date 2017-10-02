# Utnianos 2.0

[![Build Status](https://travis-ci.org/UTNianos/2.0.svg?branch=master)](https://travis-ci.org/UTNianos/2.0) 
[![codecov](https://codecov.io/gh/UTNianos/2.0/branch/master/graph/badge.svg)](https://codecov.io/gh/UTNianos/2.0)

#### Seteando un ambiente de desarrollo

**Tecnologias utilizadas para desarrollar:**
 
- PHP(> 5.5.9)
    - [Composer](https://getcomposer.org/doc/00-intro.md)
    - [PHPUnit](https://phpunit.de/) (via composer) 
    - (Opcional) [PHPMD](http://phpmd.org/download/index.html) analisis estatico del codigo

    
#### Inicializacion


```sh

# Descargar prerequisitos
sudo apt-get install php5 mysql-server

#Bajar composer y phpunit
wget https://getcomposer.org/installer
wget https://phar.phpunit.de/phpunit.phar

# Instalar composer y mover composer a un directorio
# que este dentro del path.
php installer
chmod +x installer
mv composer.phar /usr/local/bin/composer

# Instalar PHPUnit
chmod +x phpunit.phar
sudo mv phpunit.phar /usr/local/bin/phpunit

# Arrancar el servicio de base de datos
sudo service mysql start

# Crear base de datos
mysql
CREATE DATABASE homestead;

# Clonar repositorio
git clone https://github.com/UTNianos/2.0.git
cd 2.0

# Instalar dependencias
composer install


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

una vez hecho esto el sitio deberia ser visible en http://localhost:8000
por un lado esta el servidor de php y por el otro el webpack dev server, que usamos para generar el js y demas assets del frontend
