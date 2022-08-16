# pokemon_app_symfony

This is a complete stack for running Symfony 6.1 (latest version), PHP8.1, nginx and Sqlite for database using docker-compose tool.

Installation



First, clone this repository:
$ git clone git@github.com:dali/pokemon_app_symfony.git


Make sure you adjust the sqlite database in .env file

 DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"

Then, run:

docker-compose up -d build


docker-compose exec php /bin/bash


composer install

symfony console cache:clear

symfony console doctrine:database:create

symfony console doctrine:migrations:migrate

symfony console doctrine:fixtures:load


You are done, you can visit the  pokemon application on the following URL: http://127.0.0.1:8080/pokemon 