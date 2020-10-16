# eactivos-interview-code-test
Required project for EACTIVOS company as software developer

This project is part of the eactivos selection process as fullstack developer 2020 
* TECHNOLOGIES
 * SYMFONY 4.4;
 * DOCKER-COMPOSE
 * MYSQL 
 * BOOTSTRAP
 * REACT
 *
 *A live example in http://proyects.bcode.es/eactivos

In many cases the different commands and online references used through out the project may be consulted in the comments of the corresponding commit

INSTRUCTIONS
* 1-Create a folder
* 2-Clone the repository 
* https://github.com/bcode2/eactivos-interview-code-test.git
* go to the docker folder and execute this command
*  docker-compose up 
*Once all containers get running execute the following command to seed the database and create the vendor folder

* docker-compose exec eactivos_apache composer update
* docker-compose exec eactivos_apache php bin/console doctrine:database:create
* docker-compose exec eactivos_apache php bin/console doctrine:schema:update --force
* docker-compose exec eactivos_apache php bin/console doctrine:fixtures:load





