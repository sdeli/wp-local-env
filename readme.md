# WP LOCAL SETUP
- The setup is built upon the official [wordpress image](https://hub.docker.com/_/wordpres) and its adviced docker-compose.yml file,
which is extended by the official [phpmyadmin image](https://hub.docker.com/r/phpmyadmin/phpmyadmin/). 

## The doc describes
 1. How you can start a clean/empty local instance
 2. How you can create a local clone of a production/staging wp install
 3. Commands to manage wp instance

## You will need:
- You will need docker and docker compose installed or docker desktop.
- For creating a local clone of a wp install you will need the following values and they need to match the 'docker-compose.yml' file
  - [MYSQL_DATABASE]
  - [MYSQL_USER]
  - [MYSQL_PASSWORD]
- composer for running scripts and docker managing commands

## Good to know
- Wordpress files are stored in the ./wp folder
- Mysql database is stored in the ./mysql folder
- This project uses composer so if you dont have composer installed globally run:
```sh
curl -sS https://getcomposer.org/installer | php
php composer.phar install
mv composer.phar /usr/local/bin/composer
```
- this project uses https://wpackagist.org/ to manage packages
  
## Create a clean/empty local instance
- Make sure there is no such installation already
  - delete wp folder content
  - if you have mysql folder delete it
  - check if there is no same containers already running
- Create a ./docker-compose.yml from ./docker-compose.example
- Add the values for the env variables where you see `user should fill out`.
- Spin up wordpress
```sh
# Before runnning the command go sure nothing is listening on port 80 and 8080.
composer up
```
- You can interact now with phpmyadmin at http://localhost:8080 and with wordpress at http://localhost
## Create a local clone of a production/staging wp install

### 1. Basic Preparations**
- Make sure there is no such installation already
  - delete wp folder content
  - if you have mysql folder delete it
  - check if there is no same containers already running
- Create a ./docker-compose.yml from ./docker-compose.example
- Add the values for the env variables in ./docker-compose.yml, where you see `user should fill out`.

### 3. Prepare project files
- Copy the production/staging wp installs wp-content/plugins, wp-content/themes, wp-content/uploads folders files into the ./wp/wp-content folder.
- At this point you can install dependecies via composer if you have any 
```sh
composer install
```
- **Disbale all caching plugins on the production/staging before exporting the db.**
- Export the db via phpmyadmin or however you can, as a result you should have a [file-name].sql file.
- Move the [file-name].sql file to the ./assets folder
- Exchange the original url to http://localhost in the ./assets/[file-name].sql file by running:
```sh
# example: composer replace -- ./assets/client4478dbtynn.sql oceancsempebolt.hu
composer replace -- ./assets/[file-name].sql [domain-without-www-and-http]
# it will create a backup at first, then will do these kinds of url exchanges:
# 'domain-name.com' to 'localhost'
# https://domain-name.com to http://localhost
# http://domain-name.com to http://localhost
# http://www.domain-name.com to http://localhost
# https://www.domain-name.com to http://localhost
```
- you may need to add this line to you [file-name].sql file:
```sh
USE `[MYSQL_DATABASE]`;
```

### 4. Spin up the clone
```sh
composer up
```
- Add these lines to wp-config just out of security
```php
define('WP_HOME','http://localhost');
define('WP_SITEURL','http://localhost');
define( 'WP_DEBUG', true );
```
- import the ./assets/[file-name].sql file:
```sh
# find the mysql containers id
composer ls

# attach/log into the container
docker exec -it [container id] /bin/bash

# log into mysql
mysql -u root -p
# password will be: "password"

# in mysql run the sql file
source ./assets/[file-name].sql
```

### 5. Clone is running**
At this point the living clone should be reachable at http://localhost and phpmyadmin at http://localhost:8080
**But you might need to import theme settings**
  - For flatsome theme you need to go to admin dashboard/flatsome/backup and import, then backup the settings and import it into the clone
- And you may need to add these lines to wp-config, if website loading is really slow and you see wp-cron in the wordpress logs:
```php
define('DISABLE_WP_CRON', true);
```

## Important Commands
```sh
# list all containers
composer ls

# start running containers
composer up

# stop running containers
composer down

# restart all containers
composer restart

# purge all running containers
composer purge

# attach/log into a container
docker exec -it [container-id] /bin/bash
```