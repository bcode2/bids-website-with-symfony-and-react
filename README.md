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
* 2-Clone the repository https://github.com/bcode2/eactivos-interview-code-test.git
* go to the docker folder and execute this command  docker-compose up 
*Once all containers get running execute the following command to seed the database and create the vendor folder

* docker-compose exec eactivos_php7 composer update
* docker-compose exec eactivos_php7 php bin/console doctrine:database:create
* docker-compose exec eactivos_php7 php bin/console doctrine:schema:update --force
* docker-compose exec eactivos_php7 php bin/console doctrine:fixtures:load







