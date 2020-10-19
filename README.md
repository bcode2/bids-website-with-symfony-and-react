# eactivos-interview-code-test
Required project for EACTIVOS company as software developer

This project is part of the eactivos selection process as fullstack developer 2020 
* TECHNOLOGIES
 * SYMFONY 4.4;
 * DOCKER-COMPOSE
 * MYSQL 
 * BOOTSTRAP
 * REACT (React-material, Axios)
 *
 *A live example in http://eactivos-test-code.bcode.es/

INSTRUCTIONS
* 1-Create a folder
* 2-Clone the repository https://github.com/bcode2/eactivos-interview-code-test.git
* go to the docker folder and execute this command  docker-compose up 
*Once all containers get running execute the following command to seed the database and create the vendor folder

* docker-compose exec eactivos_php7 composer update
* docker-compose exec eactivos_php7 php bin/console doctrine:database:create
* docker-compose exec eactivos_php7 php bin/console doctrine:schema:update --force
* docker-compose exec eactivos_php7 php bin/console doctrine:fixtures:load







