# WF App

Marketplace Application to E-commerce media content.


## Installation

Clone the repo:

```sh
git clone https://github.com/rasce88/wf.git wf
cd src/wf
```

Build Up Docker Container and Images:
```sh
# Install Docker Desktop App

# Locate the path of the docker-compose.yml File and Build the Docker Container
cd src/wf
docker-compose up -d --build
docker-compose up -d --build --force-recreate (only for Rebuild)

## Enter to wf_app_container ##
docker exec -it wf_app_container bash
```

Install PHP dependencies:
```sh
cd /var/www
composer install
```

Install NPM dependencies:

```sh
npm install && npm run dev
```

Build assets:

```sh
npm run dev
```

Setup Environment File configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```


To run the tests:
```
phpunit
```


![Alt text](http://gerzahim.com/img/port_starfreight.png "Welcome Fun")


## Deploying to Cpanel with any SFTP (SCP Client)

Overwrite Folder/Files
- src/public (file by file) Don't touch .htaccess
- src/resources
- src/app
- src/routes

- unzip node_modules
- unzip vendor

- UPDATE new variable on .ENV
- IMPORT .sql
