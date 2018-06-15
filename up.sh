#!/bin/sh
git pull
composer install
./bin/console doctrine:mi:mi --no-interaction
./bin/console cache:clear --env=prod
./bin/console cache:clear --env=dev
./bin/console assets:install
chmod -R a+w var
chown -R www-data:www-data var
