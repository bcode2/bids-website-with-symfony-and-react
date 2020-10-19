# interview-code-test
Required project  for a software developer position

This project is part of the selection process as fullstack developer 2020 
* TECHNOLOGIES
 * SYMFONY 4.4;
 * DOCKER-COMPOSE
 * MYSQL 
 * BOOTSTRAP
 * REACT (React-material, Axios)
 *
 *A live example in http://projects.bcode.es/bids

INSTRUCTIONS
# 1---Create una carpeta de trabajo

# 2---Clonamos el repositorio 
 https://github.com/bcode2/bids-website-with-symfony-and-react.git
 
# 3---Nos posicionamos en la rama  develop 
*Once all containers get running execute the following command to seed the database and create the vendor folder

# 4---Creamos/levantamos nuestros contenedores
docker-compose up

# 5---Entramos en el contenedor 
docker-compose exec bids_php7 bash

# 6---Nos posicionamos en la carpeta del proyecto

# 7---Actualizamos  la carpeta vendor  y todas  las dependencias de php
composer update

# 8---Actualizamos  la carpeta node_vendor necesaria para que nuestro componente en React funcione
yarn install

# 9---Forzamos la compilacion/mimificación de nuestros archivos js. En nuestro caso no es necesario ya que los archivos compilados ya están incluidos
yarn encore dev

# 10---Creamos la  BBDD esto no es necesario porque  el script del docker la crea en caso  contrario  ejecútalo  antes que el resto de los pasos siguientes
# php bin/console doctrine:database:create

# 11---Creamos nuestras  tablas
php bin/console doctrine:schema:update --force

# 12---Ejecutamos  los fixtures, rellenando  la  BBDD con datos ficticios
php bin/console doctrine:fixtures:load

# 13---Abrimos la dirección web. Es necesario agregar /asset/ porque no la configure como ruta raiz (/)
http://127.0.0.1:5555/public/asset/list
