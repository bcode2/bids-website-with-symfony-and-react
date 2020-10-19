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
* 1-Create a folder
* 2-Clone the repository https://github.com/bcode2/bids-website-with-symfony-and-react.git
* go to the docker folder and execute this command  docker-compose up 
*Once all containers get running execute the following command to seed the database and create the vendor folder

# 0---Entramos en el contenedor 
docker-compose exec bids_php7 bash
# 1---Nos posicionamos en la carpeta del proyecto

# 2---Actualizamos  la carpeta vendor  y todas  las dependencias de php
composer update

# 3---Actualizamos  la carpeta node_vendor necesaria para que nuestro componente en React funcione
yarn install

# 3---Forzamos la compilacion/mimificación de nuestros archivos js. Ennuestro caso no es necesario ya que los archivos compilados ya están incluidos
yarn encore dev

#Creamos la  BBDD esto no es necesario porque  el scrip del docker la crea en caso  contrario  ejecútalo  antes que el resto de los pasos
# php bin/console doctrine:database:create

#Creamos nuestras  tablas
php bin/console doctrine:schema:update --force

#Ejecutamos  los fixtures, rellenando  la  BBDD con datos ficticios
php bin/console doctrine:fixtures:load
