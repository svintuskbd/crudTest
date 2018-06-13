#!/bin/sh
git pull
composer install
./bin/console doctrine:mi:mi --no-interaction
./bin/console cache:clear --env=prod
./bin/console-admin cache:clear --env=prod
./bin/console-api cache:clear --env=prod
./bin/console-frontend cache:clear --env=prod
./bin/console-frontend assets:install
sudo chmod -R a+w var
sudo chown -R www-data:www-data var
