# eactivos-interview-code-test
Required project for EACTIVOS company as software developer

This project is part  of the eactivos selection process as  fullstack developer 2020 
* TECHNOLOGIES
 * SYMFONY 4;
 * DOCKER-COMPOSE
 * MYSQL 
 * BOOTSTRAP
 * REACT
 * BOOTSTRAP
 *
 *A live example  in http://proyects.bcode.es/eactivos

In many  cases the  different  commands and  online   references  used  through out the project may be consulted  in the  comments of the corresponding commit

INSTRUCTIONS
* 1-Create a folder
* 2-Clone the repository 
* https://github.com/bcode2/simple-e-commerce-with-symfony.git)
* go to  the docker folder   and  execute this command
*      docker-compose up 
*Once  all containers  get  running execute the  following command to  seed  the  database and create the vendor  folder

* docker-compose exec eactivos_apache composer update
* docker-compose exec eactivos_apache php bin/console doctrine:database:create
* docker-compose exec eactivos_apache php bin/console doctrine:schema:update --force
* docker-compose exec eactivos_apache php bin/console doctrine:fixtures:load


TODO LIST:
* Remove   from the  random   products that appears in the cart those  that the  user  have already included (Thanks Juan por the tip)
* Clean   all  inline CSS. Yeaaa I know  it is a bad  practice but...... time  is time
* Currently  the   shopping cart  is managed  in the server side. Implement it in the  front side and asynchronously  save it in the database
* Remove  some  dePrecated  errors  coming from   old libraries
* Allow user to upload a  real product image
* Show the  amount  of  product   in the  uppper   right  corner
* Create  a  new  docker  image  based in alpine. The current one was created  with  ubunto.
![alt_text](https://github.com/bcode2/simple-e-commerce-with-symfony/blob/master/project.png)

