# Dependencies 

## Install dependencies
./composer install

## Add dependency
./composer require `name`

# Tests

## Run a unit test

./vendor/bin/phpunit --bootstrap src/autoload.php tests/`ClassName`.php

## Run each unit test

./vendor/bin/phpunit --bootstrap src/autoload.php tests

## Run with configuration

./vendor/bin/phpunit

# Database

## Drop

./vendor/bin/doctrine orm:schema-tool:drop --force

## Create

./vendor/bin/doctrine orm:schema-tool:create
