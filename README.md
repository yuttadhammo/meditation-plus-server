# README #

## Installation ##

* Install ruby
* Install compass
* Install composer
* Go into app's root folder
* Copy `app/config/parameters.yml.dist` to `app/config/parameters.yml` and configure your paths and database
* Run `php composer.phar install` (or wherever you have installed composer.phar)
* Run `php app/console doctrine:schema:update --force`
* Run `php app/console server:run`
* Browse to `localhost:8000`